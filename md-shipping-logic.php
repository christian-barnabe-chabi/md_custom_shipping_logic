<?php

// /**
// * Plugin Name: Maria Doll Shipping Logic
// * Plugin URI: https://www.rayongeek.com
// * Description: This plugin adds some custom shipping taxes at checkout in woocommerce
// * Version: 1.0
// * Author: Christian Barnabe
// * Author URI: https://www.rayongeek.com
// **/
if (!defined('ABSPATH')) exit;
session_start();

//* Add select field to the checkout page

add_action('woocommerce_before_order_notes', 'md_add_area_checkout_field');
function md_add_area_checkout_field( $checkout ) {

  require_once 'includes/md-area-set.php';

  $select_options = $cities[$_SESSION['md_location']['slug']];

  $city_select_field_options = "<option value=''>".__( 'Select a city for delivery' )."</option>";
  foreach ($select_options as $value => $text) {
    $city_select_field_options .= "<option value='{$value}'>{$text}</option>";;
  }
  
  echo <<<EOT
  <div style="margin-bottom: 15px">
    <select class="ui fluid search dropdown" id="city_of_delivery" name="city_of_delivery" required>
      $city_select_field_options
    </select>
  </div>
  EOT;

  // echo '<h3>'.__('Area Delivery').'</h3>';
  // woocommerce_form_field( 'city_of_delivery', array(
  //     'type'          => 'select',
  //     'class'         => array('ui fluid search dropdown' ),
  //     'label'         => __( 'Delivery options' ),
  //     'options'       => $select_options
  // ),);

  

  $delivery_data = json_encode($area);
  $area_select_options = [];
  echo "<input type='hidden' value='{$delivery_data}' id='md_delivery_area_data'>";

  // woocommerce_form_field( 'area_of_delivery', array(
  //     'type'          => 'select',
  //     'class'         => array( 'md_select', 'ui fluid search dropdown', ),
  //     'label'         => __( 'Delivery options' ),
  //     'options'       => $area_select_options
  // ),);

  $area_select_field_options = "<option value=''>".__( 'Select an area for delivery', )."</option>";
  foreach ($area_select_options as $value => $text) {
    $area_select_field_options .= "<option value='{$value}'>{$text}</option>";
  }

  echo <<<EOT
  <div style="margin-bottom: 10px">
    <select class="ui fluid search dropdown" id="area_of_delivery" name="area_of_delivery" required>
      $area_select_field_options
    </select>
  </div>
  EOT;

  echo <<<EOT
  <div style="margin-bottom: 10px" id="md_delivery_tax_fee_container">
    <p>Delivery Tax: <span id="md_delivery_tax_fee">2000</span></p>
  </div>
  EOT;

  md_delivery_area_mapper_script();

}

function md_delivery_area_mapper_script() {
  echo <<<EOT
    <script>
    
      $(document).ready(() => {

        let areasOfSelectedCity = null;
        let dateOfSelectedArea = null;
        const area_of_delivery = $('#area_of_delivery');
        const city_of_delivery = $('#city_of_delivery');
        const md_delivery_area_data = $('#md_delivery_area_data');
        const md_delivery_tax_fee_container = $("#md_delivery_tax_fee_container");
        const md_delivery_tax_fee = $("#md_delivery_tax_fee");

        // apply classes
        city_of_delivery.addClass('ui fluid dropdown');
        area_of_delivery.addClass('ui fluid dropdown');

        md_delivery_tax_fee_container.hide();

        const deliveryAreaData = JSON.parse(md_delivery_area_data.val());

        city_of_delivery.on('change', (event)=>{
          const city = city_of_delivery.val();
          if(deliveryAreaData.hasOwnProperty(city)) {
            areasOfSelectedCity = deliveryAreaData[city];
          } else {
            areasOfSelectedCity = null;
          }

          if(!areasOfSelectedCity) {
            area_of_delivery.parent().hide();
            area_of_delivery.empty();
          } else {
            area_of_delivery.parent().show();
            fillAreaOfDelivery(areasOfSelectedCity, area_of_delivery);
          }
        });

        $(document).on('click', '#place_order', (event) => {
          if(city_of_delivery.val() == '') {
            event.preventDefault();
          } else {
            if(deliveryAreaData.hasOwnProperty(city_of_delivery.val()) && area_of_delivery.val() == '') {
              event.preventDefault();
            }
          }
        });

        area_of_delivery.on('change', (event) => {
          const area = area_of_delivery.val();
          if(areasOfSelectedCity.hasOwnProperty(area)) {
            dateOfSelectedArea = areasOfSelectedCity[area];
            calculateDeliveryTax(dateOfSelectedArea, md_delivery_tax_fee, md_delivery_tax_fee_container);
          }
        });

        // with dropdown
        $('.ui.dropdown#area_of_delivery').dropdown({forceSelection: false,});
        $('.ui.dropdown#city_of_delivery').dropdown({forceSelection: false,});
        if(areasOfSelectedCity === null) {
          area_of_delivery.parent().hide();
        }

      });

      function calculateDeliveryTax(dateOfSelectedArea, md_delivery_tax_fee, md_delivery_tax_fee_container) {
        md_delivery_tax_fee.text(dateOfSelectedArea.tax);
        md_delivery_tax_fee_container.show();
      }

      function fillAreaOfDelivery(areasOfSelectedCity, area_of_delivery) {
        let options = "<option value=''>Select an area for delivery</option>";
        options += "<option value='other'>Autre</option>";
        for(let area in areasOfSelectedCity) {
          options += "<option value='"+area+"'>"+area+"</option>";
        }
        area_of_delivery.html(options);
      }
    </script>
  EOT;
}

?>
