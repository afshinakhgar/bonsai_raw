<?php 
return [
    'image' => [
        'library'     => 'gd',
        'secretKey' => 'afshina',
        'upload_path' =>  '/uploads/',
        'quality'     => 100,
        'user_photo' => [
            'dimensions' => [
                'm' => [400,250,70],
                'l'  => [800,600,80],
                'thumb'  => [250, 250,80,true],
           ],
        ],
        'category_photo' => [
            'dimensions' => [
                'm' => [400,250,70],
                'l'  => [800,600,80],
                'thumb'  => [250, 250,80,true],
                's'  => [150, 80,80],
           ],
        ],
        'cafe_menu_cover' => [
            'dimensions' => [
                'm' => [400,250,70],
                'l'  => [800,600,80],
                'thumb'  => [250, 250,80,true],
           ],
        ],
        'cafe_menu_photo' => [
            'dimensions' => [
                'm' => [400,250,70],
                'l'  => [800,600,80],
                'thumb'  => [250, 250,80,true],
                's'  => [150, 80,80],
           ],
        ],
        'cafe_menu_item_photo' => [
            'dimensions' => [
                'm' => [400,250,70],
                'thumb'  => [250, 250,80,true],
           ],
        ],
        'minquality' => 200 // kamtar az in width va height nemigirim
    ]
];
?>