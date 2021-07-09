<?php

/**
  06:00AM to 15:59 && order > 7000 => Free
  16:00 -> will be delivered on the next day (same conditions)
  Express (same day): > 16:00 - 18:30 && order > 7000 + express_tax
*/

$area = [
  "dakar" => [
    // free delivery
    "Almadies" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Ngor" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Yoff" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Yoff-virage" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "grand yoff " => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "sicap liberté" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Guele tapee " => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "colobane " => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Point E" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Medina" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Fass" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Grand Dakar" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Fann Amitie" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Mermoz" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Sacre Cœur" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Patte D oie" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Plateau" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Hlm /parcelle" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],

    // never free
    "parcelle unite1 in 7" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Guediaway" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Pikine" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Hann marinas" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Bel air" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Dalifort" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Camberene" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "thiaroye" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "keur Mbaye fall" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Mbao" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Keur Massar" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Rufisque" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],

  ],

  "abidjan" => [
    // free on morning
    "youpougon" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Koumassi" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Riviera" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Faya"=> [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Plateau" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Angre" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Marcory" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Treicheville" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Port Bouet" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],

    // never free
    "Port bouet Anani" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Youpougon PK17" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Bassam" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Abobo PK 18" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "ABOBO belle ville " => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Bingerville" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Agnama" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
    ],
    "Vridi cité" => [
      "enabled" => true,
      "limit_time" => "11:59PM",
      "tax" => 1500,
      "free_delivery" => true,
      "condition" => "7000",
      "express_delivery" => true,
      "express_delivery_tax" => 3000,
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
        "condition" => "7000",
        "express_delivery" => true,
        "express_delivery_tax" => 3000,
      ]
    ],
    "thies"       => [
      "name" => "Thies",
      "default" => [
        "enabled" => true,
        "limit_time" => "11:59PM",
        "tax" => 3500,
        "free_delivery" => true,
        "condition" => "7000",
        "express_delivery" => true,
        "express_delivery_tax" => 3000,
      ]
    ],
    "saly"        =>  [
      "name" => "Saly", 
      "default" => [
        "enabled" => true,
        "limit_time" => "11:59PM",
        "tax" => 1500,
        "free_delivery" => true,
        "condition" => "7000",
        "express_delivery" => true,
        "express_delivery_tax" => 3000,
      ]
    ],
    "mbour"       => [
      "name" => "Mbour",
      "default" => [
        "enabled" => true,
        "limit_time" => "11:59PM",
        "tax" => 1500,
        "free_delivery" => true,
        "condition" => "7000",
        "express_delivery" => true,
        "express_delivery_tax" => 3000,
      ]
    ],
    "saint louis" => [
      "name" => "Saint louis",
      "default" => [
        "enabled" => true,
        "limit_time" => "11:59PM",
        "tax" => 1500,
        "free_delivery" => true,
        "condition" => "7000",
        "express_delivery" => true,
        "express_delivery_tax" => 3000,
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