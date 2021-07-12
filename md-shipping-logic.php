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
    <label for="md_extra_address">Select an city for delivery <span style="color:red">*</span></label>
    <select class="ui fluid search dropdown" id="city_of_delivery" name="md_city_of_delivery" required>
      $city_select_field_options
    </select>
  </div>
  EOT;

  
  $area_select_options = [];

  $area_select_field_options = "<option value=''>".__( 'Select an area for delivery', )."</option>";

  echo <<<EOT
  <div style="margin-bottom: 10px;" id="area_of_delivery_container">
    <label for="md_extra_address">Select an area for delivery <span style="color:red">*</span></label>
    <select class="ui fluid search dropdown" id="area_of_delivery" name="md_area_of_delivery" required>
      $area_select_field_options
    </select>
  </div>
  EOT;

  echo <<<EOT
  <div style="margin-bottom: 10px" id="md_extra_address_container">
    <label for="md_extra_address">Additional address Information <span style="color:red">*</span></label>
    <input type="text" id="md_extra_address" class="iu input">
  </div>
  EOT;
  
  echo <<<EOT
  <div style="margin-bottom: 10px;">
    <div class="ui checkbox" id="express_delivery_field_container">
      <input type="checkbox" id="express_delivery_field">
      <label for="express_delivery_field">Express delivery</label>
    </div>
  </div>
  EOT;

  echo <<<EOT
  <div style="margin-bottom: 10px" id="md_delivery_message_container">
    <p id="md_delivery_message"></p>
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
        const area_of_delivery_container = $('#area_of_delivery_container');
        const area_of_delivery = $('#area_of_delivery');
        const city_of_delivery = $('#city_of_delivery');
        const md_delivery_area_data = $('#md_delivery_area_data');
        const md_delivery_cities_data = $('#md_delivery_cities_data');
        const md_delivery_tax_fee = $("#md_delivery_tax_fee");
        const express_delivery_field_container = $("#express_delivery_field_container");
        const express_delivery_field = $("#express_delivery_field");
        const md_delivery_tax = $("#md_delivery_tax");
        const md_extra_address_container = $("#md_extra_address_container");
        const md_extra_address = $("#md_extra_address");

        // apply classes
        city_of_delivery.addClass('ui fluid dropdown');
        area_of_delivery.addClass('ui fluid dropdown');

        md_extra_address_container.fadeOut();
        express_delivery_field_container.fadeOut();

        const deliveryAreaData = JSON.parse(md_delivery_area_data.val());
        const deliveryCitiesData = JSON.parse(md_delivery_cities_data.val());
        let selectedCityHasAreas = false;
        let city;

        city_of_delivery.on('change', (event)=>{
          express_delivery_field.prop("checked", false);
          city = city_of_delivery.val();
          selectedCityHasAreas = deliveryAreaData.hasOwnProperty(city);
          if(selectedCityHasAreas) {
            areasOfSelectedCity = deliveryAreaData[city];
            dataOfSelectedArea = null;
            md_extra_address_container.fadeOut();
          } else {
            areasOfSelectedCity = null;
            dataOfSelectedArea = deliveryCitiesData[city].default || null;

            // specific rules for libreville
            if(city.toLowerCase() == "libreville") {
              md_extra_address_container.fadeIn();
            }
          }
          calculateDeliveryTax(dataOfSelectedArea);

          if(!areasOfSelectedCity) {
            // area_of_delivery.parent().fadeOut();
            area_of_delivery_container.fadeOut();
            area_of_delivery.empty();
          } else {
            area_of_delivery_container.fadeIn();
            fillAreaOfDelivery(areasOfSelectedCity, area_of_delivery);
          }
        });

        $(document).on('click', '#place_order', (event) => {
          if(city_of_delivery.val() == '') {
            event.preventDefault();
          } else if(md_delivery_tax.val() == -1) {
            event.preventDefault();
          } else if( (!selectedCityHasAreas && md_extra_address.val() == '' && city.toLowerCase() == "libreville") ) {
            event.preventDefault();
          }
          else {
            if(deliveryAreaData.hasOwnProperty(city_of_delivery.val()) && area_of_delivery.val() == '') {
              event.preventDefault();
            }
          }
        });

        area_of_delivery.on('change', (event) => {
          express_delivery_field.prop("checked", false);
          const area = area_of_delivery.val();
          dataOfSelectedArea = areasOfSelectedCity[area] || null;
          calculateDeliveryTax(dataOfSelectedArea);
        });
        
        express_delivery_field.on('change', (event)=>{
          calculateDeliveryTax(dataOfSelectedArea);
        });


        // with dropdown
        $('.ui.dropdown#area_of_delivery').dropdown({forceSelection: false,});
        $('.ui.dropdown#city_of_delivery').dropdown({forceSelection: false,});
        if(areasOfSelectedCity === null) {
          // area_of_delivery.parent().fadeOut();
          area_of_delivery_container.fadeOut();
        }

      });

      function calculateDeliveryTax(dataOfSelectedArea) {
        mdWipeMessage();
        const orderTotal = {$order_total};
        const express_delivery_field_container = $("#express_delivery_field_container");
        const express_delivery_field = $("#express_delivery_field");
        const md_delivery_tax_fee = $("#md_delivery_tax_fee"); 
        const md_delivery_tax = $("#md_delivery_tax");

        if(dataOfSelectedArea == null) {
          express_delivery_field_container.fadeOut();
        } else {

          let delivery_fee = dataOfSelectedArea.tax;
          const deliveryTempDate = new Date();
          const currentDate = new Date();
          Object.freeze(currentDate);
          const regex = /(\d{1,2}):(\d{1,2})/gm;
          const matches = regex.exec(dataOfSelectedArea.limit_time);
          const hasReachedMinimumPriceCondition = orderTotal >= dataOfSelectedArea.free_delivery_condition;
          const userWinsFreeDelivery = (dataOfSelectedArea.free_delivery == true || dataOfSelectedArea.free_delivery == 'true') && hasReachedMinimumPriceCondition;
          const deliveryEnabled = dataOfSelectedArea.enabled == true || dataOfSelectedArea.enabled == 'true';
          const hasExpressDelivery = dataOfSelectedArea.express_delivery == true || dataOfSelectedArea.express_delivery == 'true';

          // delivery enabled if enabled is false and order is greater than delivery condition
          if(deliveryEnabled == false) {
            if(hasReachedMinimumPriceCondition == false) {
              md_delivery_tax.val(-1);
              mdUpdateCheckout();

              mdShowMessagePrepend("Nous ne livrons pas dans les quartiers éloignés les commandes en dessous de 7000. Pour être livré ajoutez des articles à votre commandes ou modifiez le quartier de réception", "red");

              return;
            }
          }
          

          if(matches) {
            const [,hours, minutes,,,,] = matches;
            deliveryTempDate.setHours(hours, minutes, 0, 0);
            const isInTime = currentDate < deliveryTempDate;

            if(userWinsFreeDelivery && isInTime) { // free delvery
              delivery_fee = 0;
              mdShowMessage("Youpi! Free delivery");
            } else {

              if(userWinsFreeDelivery) { // can get delivery for free next day
                mdShowMessage("You can get delivery for free next delivery day");
              }

              // next delivery date
              // if next day is sunday => day off 
              nextDeliveryDate = new Date();
              nextDeliveryDate.setHours(0, 0, 0);
              if(currentDate.toDateString().substr(0, 3).toLocaleLowerCase() == 'sat') {
                // 86400000 => 01 days
                nextDeliveryDate.setTime(nextDeliveryDate.getTime()+2*86400000);
                mdShowMessage("you'll be delivered on next monday")
              } else {
                nextDeliveryDate.setTime(nextDeliveryDate.getTime()+86400000);
              }
              mdShowMessage("next deliveray Date: "+ nextDeliveryDate.toDateString());


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
              const expressDeliveryIsEnabledAndHasTaxSet = hasExpressDelivery && dataOfSelectedArea.express_delivery_tax;
              if(expressDeliveryIsEnabledAndHasTaxSet && isInExpressDeliveryTime && hasReachedMinimumPriceCondition) { 
                express_delivery_field_container.fadeIn();

                if(express_delivery_field.prop('checked')) {
                  setDeliveryTaxFees(dataOfSelectedArea.express_delivery_tax);
                  return;
                }
              }
            }

          } else {
            delivery_fee = 0;
          }

          setDeliveryTaxFees(delivery_fee);
        }

      }

      function setDeliveryTaxFees(delivery_fee) {
        const md_delivery_tax = $("#md_delivery_tax");
        md_delivery_tax.val(delivery_fee);
        mdShowMessagePrepend(`Delivery tax: \${delivery_fee}`, "orange");
        mdUpdateCheckout();
      }

      function mdUpdateCheckout() {
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

      
      function mdShowMessage(message, color="black") {
        const md_delivery_message_container = $('#md_delivery_message_container');
        const mdDeliveryMessage = $(`<p style='color:\${color}'>\${message}</p>`);

        md_delivery_message_container.append(mdDeliveryMessage);

        md_delivery_message_container.fadeIn();
      }
      
      function mdShowMessagePrepend(message, color="black") {
        const md_delivery_message_container = $('#md_delivery_message_container');
        const mdDeliveryMessage = $(`<p style='color:\${color}'>\${message}</p>`);
        md_delivery_message_container.prepend(mdDeliveryMessage);
        md_delivery_message_container.fadeIn();
      }

      function mdWipeMessage() {
        const md_delivery_message_container = $('#md_delivery_message_container');
        md_delivery_message_container.empty();
      }

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

//     if(isset( $_SESSION['md_cart_mapped'])) {
//       echo "<pre>". var_export($_SESSION['md_cart_mapped'], true) ."<pre>";
//     }
//     // Check if set, if its not set add an error.
//     if ( ! $_POST['md_delivery_tax'] ) {
//       wc_add_notice( __( 'Please enter something into this new shiny field.' ), 'error' );
//     } else {
//       wc_add_notice( __( 'md_delivery_tax set. Youpi' ), 'error' );
//     }
// }


?>
