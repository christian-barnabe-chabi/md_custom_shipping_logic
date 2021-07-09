<?php

/**
  06:00AM to 15:59 && order > 7000 => Free
  16:00 -> will be delivered on the next day (same free_delivery_conditions)
  Express (same day): > 16:00 - 18:30 && order > 7000 + express_tax
*/

$area = [
  "dakar" => [
    // free delivery
    "Almadies" => [
      "enabled" => true,
      "limit_time" => "16:00PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Ngor" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Yoff" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Yoff-virage" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "grand yoff " => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "sicap liberté" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Guele tapee " => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "colobane " => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Point E" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Medina" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Fass" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Grand Dakar" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Fann Amitie" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Mermoz" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 3000,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Sacre Cœur" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Patte D oie" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Plateau" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Hlm /parcelle" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],

    // never free
    "parcelle unite1 in 7" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Guediaway" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Pikine" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Hann marinas" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Bel air" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Dalifort" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Camberene" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "thiaroye" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "keur Mbaye fall" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Mbao" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Keur Massar" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Rufisque" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],

  ],

  "abidjan" => [
    // free on morning
    "youpougon" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Koumassi" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Riviera" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Faya"=> [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Plateau" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Angre" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Marcory" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Treicheville" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Port Bouet" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],

    // never free
    "Port bouet Anani" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Youpougon PK17" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Bassam" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Abobo PK 18" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "ABOBO belle ville " => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Bingerville" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Agnama" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],
    "Vridi cité" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "free_delivery_condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
      "express_delivery_limit_time" => "18:00",
    ],


  ]
];

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