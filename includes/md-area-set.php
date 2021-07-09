<?php

/**
  06:00AM to 15:59 && order > 7000 => Free
  16:00 -> will be delivered on the next day (same free_delivery_conditions)
  Express (same day): > 16:00 - 18:30 && order > 7000 + express_tax
*/
require_once('SimpleXLSX.php');

$area = [];
$delivery_excel_file = WP_PLUGIN_DIR.'/md-shipping-logic/includes/delivery.xlsx';
if ( $xlsx = SimpleXLSX::parse($delivery_excel_file) ) {

  $rows = $xlsx->rows();
  for($i=1; $i < count($rows); $i++) {
    $row = $rows[$i];
    if($row == 0) continue;
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
      "zone_name" => $zone_name,
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


$cities = [
  "sn" => [
    "dakar"       => [
      "name" => "Dakar", 
      "default" => [
        "enabled" => true,
        "limit_time" => "11:59PM",
        "tax" => 1500,
        "free_delivery" => true,
        "free_delivery_condition" => "7000",
        "express_delivery" => true,
        "express_delivery_tax" => 3000,
        "express_delivery_limit_time" => "18:00",
      ]
    ],
    "thies"       => [
      "name" => "Thies",
      "default" => [
        "enabled" => true,
        "limit_time" => "11:59PM",
        "tax" => 3500,
        "free_delivery" => true,
        "free_delivery_condition" => "7000",
        "express_delivery" => true,
        "express_delivery_tax" => 3000,
        "express_delivery_limit_time" => "18:00",
      ]
    ],
    "saly"        =>  [
      "name" => "Saly", 
      "default" => [
        "enabled" => true,
        "limit_time" => "11:59PM",
        "tax" => 1500,
        "free_delivery" => true,
        "free_delivery_condition" => "7000",
        "express_delivery" => true,
        "express_delivery_tax" => 3000,
        "express_delivery_limit_time" => "18:00",
      ]
    ],
    "mbour"       => [
      "name" => "Mbour",
      "default" => [
        "enabled" => true,
        "limit_time" => "11:59PM",
        "tax" => 1500,
        "free_delivery" => true,
        "free_delivery_condition" => "7000",
        "express_delivery" => true,
        "express_delivery_tax" => 3000,
        "express_delivery_limit_time" => "18:00",
      ]
    ],
    "saint louis" => [
      "name" => "Saint louis",
      "default" => [
        "enabled" => true,
        "limit_time" => "11:59PM",
        "tax" => 1500,
        "free_delivery" => true,
        "free_delivery_condition" => "7000",
        "express_delivery" => true,
        "express_delivery_tax" => 3000,
        "express_delivery_limit_time" => "18:00",
      ]
    ],
  ],

  "ga" => [
    "name" => "Gabon",
  ],

  "gh" => [
    "name" => "Ghana",
  ],

  "ci" => [
    "abidjan"     => "Abidjan",
    "adiame"      => "Adiame",
    "remblais"    => "Remblais ",
    "bietry"      => "bietry",
    "cite CICOGI" => "Cite CICOGI",
    "rIVIERA 3"   => "RIVIERA 3",
    "autres"      => "Autres",

  ],
];

?>