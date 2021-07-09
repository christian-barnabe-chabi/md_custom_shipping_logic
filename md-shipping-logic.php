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

  if(!is_checkout()) return;

  require_once 'includes/md-area-set.php';

  $select_options = $cities[$_SESSION['md_location']['slug']];
  $delivery_data = json_encode($area);
  $delivery_cities = json_encode($select_options);
  echo "<input type='hidden' value='{$delivery_data}' id='md_delivery_area_data'>";
  echo "<input type='hidden' value='{$delivery_cities}' id='md_delivery_cities_data'>";
  echo "<input type='hidden' value=0 id='md_delivery_tax' name='md_delivery_tax'>";

  $city_select_field_options = "<option value=''>".__( 'Select a city for delivery' )."</option>";
  foreach ($select_options as $value => $cityData) {
    $city_select_field_options .= "<option value='{$value}'>{$cityData['name']}</option>";;
  }
  
  echo <<<EOT
  <div style="margin-bottom: 15px">
    <select class="ui fluid search dropdown" id="city_of_delivery" name="md_city_of_delivery" required>
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

  // woocommerce_form_field( 'md_area_of_delivery', array(
  //     'type'          => 'hidden',
  // ),);
  
  // woocommerce_form_field( 'md_final_delivery_tax', array(
  //     'type'          => 'hidden',
  // ),);

  $area_select_field_options = "<option value=''>".__( 'Select an area for delivery', )."</option>";
  foreach ($area_select_options as $value => $text) {
    $area_select_field_options .= "<option value='{$value}'>{$text}</option>";
  }

  echo <<<EOT
  <div style="margin-bottom: 10px;">
    <select class="ui fluid search dropdown" id="area_of_delivery" name="md_area_of_delivery" required>
      $area_select_field_options
    </select>
  </div>
  EOT;
  
  echo <<<EOT
  <div style="margin-bottom: 10px;">
    <div class="ui checkbox" id="express_delivery_field_container">
      <input type="checkbox" id="express_delivery_field">
      <label>Express delivery</label>
    </div>
  </div>
  EOT;

  echo <<<EOT
  <div style="margin-bottom: 10px" id="md_delivery_tax_fee_container">
    <p>Delivery Tax: <span id="md_delivery_tax_fee">2000</span></p>
  </div>
  EOT;

}

add_action( 'wp_footer', 'md_delivery_area_mapper_script', 50 );
function md_delivery_area_mapper_script() {
  if(!is_checkout()) return;
  $order_total = WC()->cart->get_cart_contents_total();

  if ( is_checkout() ){

    
  }
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
        const express_delivery_field_container = $("#express_delivery_field_container");
        const express_delivery_field = $("#express_delivery_field");

        // apply classes
        city_of_delivery.addClass('ui fluid dropdown');
        area_of_delivery.addClass('ui fluid dropdown');

        md_delivery_tax_fee_container.fadeOut();
        express_delivery_field_container.fadeOut();

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
          calculateDeliveryTax(dataOfSelectedArea);

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
          calculateDeliveryTax(dataOfSelectedArea);
        });


        // with dropdown
        $('.ui.dropdown#area_of_delivery').dropdown({forceSelection: false,});
        $('.ui.dropdown#city_of_delivery').dropdown({forceSelection: false,});
        if(areasOfSelectedCity === null) {
          area_of_delivery.parent().fadeOut();
        }

      });

      function calculateDeliveryTax(dataOfSelectedArea) {

        const orderTotal = {$order_total};
        const express_delivery_field_container = $("#express_delivery_field_container");
        const express_delivery_field = $("#express_delivery_field");
        const md_delivery_tax_fee_container = $("#md_delivery_tax_fee_container");
        const md_delivery_tax_fee = $("#md_delivery_tax_fee");

        if(dataOfSelectedArea == null) {
          md_delivery_tax_fee_container.fadeOut();
          express_delivery_field_container.fadeOut();
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

            const hasReachedMinimumPriceCondition = orderTotal >= dataOfSelectedArea.free_delivery_condition;
            const hasFreeDelivery = dataOfSelectedArea.free_delivery && hasReachedMinimumPriceCondition;
            const isInTime = currentDate < deliveryTempDate;

            if(hasFreeDelivery && isInTime) { // free delvery
              delivery_fee = 0;
              console.log("Youpi! Free delivery");
            } else {

              if(hasFreeDelivery) { // can get delivery for free next day
                console.log("You can get delivery for free next delivery day");
              }

              // next delivery date
              // if next week day is sunday => day off 
              nextDeliveryDate = new Date();
              nextDeliveryDate.setHours(0, 0, 0);
              if(currentDate.toDateString().substr(0, 3).toLocaleLowerCase() == 'sat') {
                // 86400000
                nextDeliveryDate.setTime(nextDeliveryDate.getTime()+2*86400000);
                console.log("you'll be delivered on monday")
              } else {
                nextDeliveryDate.setTime(nextDeliveryDate.getTime()+86400000);
              }
              console.log("next deliveray Date: "+ nextDeliveryDate.toDateString());


              const regex2 = /(\d{1,2}):(\d{1,2})/gm;
              const expressDeliveryTempDate = new Date();
              const expressDeliveryLimitTimeRegexMatch = regex2.exec(dataOfSelectedArea.express_delivery_limit_time);
              let isInExpressDeliveryTime = false;
              if(expressDeliveryLimitTimeRegexMatch) {
                const [,expressDeliveryHours, expressDeliveryMinutes,,,,] = expressDeliveryLimitTimeRegexMatch;
                expressDeliveryTempDate.setHours(expressDeliveryHours, expressDeliveryMinutes, 0, 0);
                isInExpressDeliveryTime = currentDate < expressDeliveryTempDate;
              }


              // can anyway get delivered if express_enabled
              const expressDeliveryIsEnabledAndHasTaxSet = dataOfSelectedArea.express_delivery && dataOfSelectedArea.express_delivery_tax;
              if(expressDeliveryIsEnabledAndHasTaxSet && isInExpressDeliveryTime && hasReachedMinimumPriceCondition) { 
                express_delivery_field_container.fadeIn();

                express_delivery_field.on('change', (event)=>{
                  if(express_delivery_field.prop('checked')) {
                    setDeliveryTaxFees(dataOfSelectedArea.express_delivery_tax);
                  } else {
                    setDeliveryTaxFees(delivery_fee);
                  }
                })
              }
            }

          } else {
            delivery_fee = 0;
          }
          
          // md_delivery_tax_fee.text(delivery_fee || 0);
          // md_delivery_tax_fee_container.fadeIn();
          setDeliveryTaxFees(delivery_fee);
        }

      }

      function setDeliveryTaxFees(delivery_fee) {

        const md_delivery_tax_fee_container = $("#md_delivery_tax_fee_container");
        const md_delivery_tax_fee = $("#md_delivery_tax_fee");
        const md_delivery_tax = $("#md_delivery_tax");

        md_delivery_tax.val(delivery_fee);
        md_delivery_tax_fee.text(delivery_fee || 0);
        md_delivery_tax_fee_container.fadeIn();

        jQuery(document.body).trigger("update_checkout");
      }
      
      function fillAreaOfDelivery(areasOfSelectedCity, area_of_delivery) {
        let options = "<option value=''>Select an area for delivery</option>";
        options += "<option value='other'>Autre</option>";
        for(let area in areasOfSelectedCity) {
          options += "<option value='"+area+"'>"+areasOfSelectedCity[area].zone_name+"</option>";
        }
        area_of_delivery.html(options);
      }

      $('body').on('updated_checkout', function(){
        // Just for testing (To be removed)
        console.log('"updated_checkout" event, restore selected option value: ');
    });
    </script>
  EOT;
}

add_action('woocommerce_cart_calculate_fees', function() {
	if (is_admin() && !defined('DOING_AJAX')) {
		return;
	}
  
  if ( isset( $_POST['post_data'] ) ) {
    parse_str( $_POST['post_data'], $post_data );
  } else {
    $post_data = $_POST; // fallback for final checkout (non-ajax)
  }

  $md_delivery_tax = $post_data['md_delivery_tax'] ?? null;

	if ($md_delivery_tax) {
		WC()->cart->add_fee(__('Delivery Fee', 'txtdomain'), $md_delivery_tax);
	} else {
		WC()->cart->add_fee(__('Delivery Fee', 'txtdomain'), 0);
  }
});

// add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');
// function my_custom_checkout_field_process() {
//     // Check if set, if its not set add an error.
//     if ( ! $_POST['md_delivery_tax'] ) {
//       wc_add_notice( __( 'Please enter something into this new shiny field.' ), 'error' );
//     } else {
//       wc_add_notice( __( 'md_delivery_tax set. Youpi' ), 'error' );
//     }
// }


?>
