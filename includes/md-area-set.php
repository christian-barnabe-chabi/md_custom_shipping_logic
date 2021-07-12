<?php

/**
  06:00AM to 15:59 && order > 7000 => Free
  16:00 -> will be delivered on the next day (same free_delivery_conditions)
  Express (same day): > 16:00 - 18:30 && order > 7000 + express_tax
*/
require_once('SimpleXLSX.php');

$area = [];
$cities = [];
const AREA_SHEET_NO = 1;
const ZONE_SHEET_NO = 0;
$delivery_excel_file = WP_PLUGIN_DIR.'/md-shipping-logic/includes/delivery.xlsx';
if ( $xlsx = SimpleXLSX::parse($delivery_excel_file) ) {

  $area_sheet = $xlsx->rows(AREA_SHEET_NO);
  for($i=1; $i < count($area_sheet); $i++) {
    $row = $area_sheet[$i];
    if(empty($row[0])) continue;
    [
    $city,
    $zone,
    $zone_name,
    $enabled,
    $limit_time,
    $tax,
    $free_delivery,
    $free_delivery_condition,
    $express_delivery,
    $express_delivery_tax,
    $express_delivery_limit_time,
    ] = $row;
    
    $area[$city][$zone] = [
      "zone_name" => str_replace("'", "-", $zone_name),
      "enabled" => $enabled,
      "limit_time" =>     $limit_time,
      "tax" =>     $tax,
      "free_delivery" =>     $free_delivery,
      "free_delivery_condition" =>     $free_delivery_condition,
      "express_delivery" =>     $express_delivery,
      "express_delivery_tax" =>     $express_delivery_tax,
      "express_delivery_limit_time" =>     $express_delivery_limit_time,
    ];
  }

  $cities_sheet = $xlsx->rows(ZONE_SHEET_NO);
  for($i=1; $i < count($cities_sheet); $i++) {
    $row = $cities_sheet[$i];
    if(empty($row[0])) continue;
    [
      $country,
      $city,
      $city_name,
      $enabled,
      $limit_time,
      $tax,
      $free_delivery,
      $free_delivery_condition,
      $express_delivery,
      $express_delivery_tax,
      $express_delivery_limit_time,
    ] = $row;
    
    $cities[$country][$city]["name"] = str_replace("'", "-", $city_name);
    $cities[$country][$city]["default"] = [
      "enabled" => $enabled,
      "limit_time" =>     $limit_time,
      "tax" =>     $tax,
      "free_delivery" =>     $free_delivery,
      "free_delivery_condition" =>     $free_delivery_condition,
      "express_delivery" =>     $express_delivery,
      "express_delivery_tax" =>     $express_delivery_tax,
      "express_delivery_limit_time" =>     $express_delivery_limit_time,
    ];
  }

} else {
	echo SimpleXLSX::parseError();
}

?>