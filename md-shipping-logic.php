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
  $delivery_data = json_encode($area);
  $delivery_cities = json_encode($select_options);
  echo "<input type='hidden' value='{$delivery_data}' id='md_delivery_area_data'>";
  echo "<input type='hidden' value='{$delivery_cities}' id='md_delivery_cities_data'>";

  $city_select_field_options = "<option value=''>".__( 'Select a city for delivery' )."</option>";
  foreach ($select_options as $value => $cityData) {
    $city_select_field_options .= "<option value='{$value}'>{$cityData['name']}</option>";;
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

  
  $area_select_options = [];

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
  <div style="margin-bottom: 10px;">
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
        const md_delivery_cities_data = $('#md_delivery_cities_data');
        const md_delivery_tax_fee_container = $("#md_delivery_tax_fee_container");
        const md_delivery_tax_fee = $("#md_delivery_tax_fee");

        // apply classes
        city_of_delivery.addClass('ui fluid dropdown');
        area_of_delivery.addClass('ui fluid dropdown');

        md_delivery_tax_fee_container.fadeOut();

        const deliveryAreaData = JSON.parse(md_delivery_area_data.val());
        const deliveryCitiesData = JSON.parse(md_delivery_cities_data.val());


        city_of_delivery.on('change', (event)=>{
          const city = city_of_delivery.val();
          if(deliveryAreaData.hasOwnProperty(city)) {
            areasOfSelectedCity = deliveryAreaData[city];
            dataOfSelectedArea = null;
          } else {
            areasOfSelectedCity = null;
            dataOfSelectedArea = deliveryCitiesData[city].default || null;
          }
          calculateDeliveryTax(dataOfSelectedArea, md_delivery_tax_fee, md_delivery_tax_fee_container);

          if(!areasOfSelectedCity) {
            area_of_delivery.parent().fadeOut();
            area_of_delivery.empty();
          } else {
            area_of_delivery.parent().fadeIn();
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
          dataOfSelectedArea = areasOfSelectedCity[area] || null;
          calculateDeliveryTax(dataOfSelectedArea, md_delivery_tax_fee, md_delivery_tax_fee_container);
        });

        // with dropdown
        $('.ui.dropdown#area_of_delivery').dropdown({forceSelection: false,});
        $('.ui.dropdown#city_of_delivery').dropdown({forceSelection: false,});
        if(areasOfSelectedCity === null) {
          area_of_delivery.parent().fadeOut();
        }

      });

      function calculateDeliveryTax(dataOfSelectedArea, md_delivery_tax_fee, md_delivery_tax_fee_container) {
        if(dataOfSelectedArea == null) {
          md_delivery_tax_fee_container.fadeOut();
        } else {
          let delivery_fee = dataOfSelectedArea.tax;
          const deliveryTempDate = new Date();
          const currentDate = new Date();
          Object.freeze(currentDate);
          const regex = /(\d{1,2}):(\d{1,2})/gm;
          const matches = regex.exec(dataOfSelectedArea.limit_time);

          if(matches) {
            const [,hours, minutes,,,,] = matches;
            deliveryTempDate.setHours(hours, minutes, 0, 0);

            if((currentDate < deliveryTempDate) && dataOfSelectedArea.free_delivery) { // free delvery
              delivery_fee = 0;
              console.log("Youpi! Free delivery");
            } else { // 
              console.log(dataOfSelectedArea);
            }

          } else {
            delivery_fee = 0;
          }
          
          md_delivery_tax_fee.text(delivery_fee || 0);
          md_delivery_tax_fee_container.fadeIn();
        }
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
