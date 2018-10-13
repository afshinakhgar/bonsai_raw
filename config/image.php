<?php 
return [
    'image' => [
        'library'     => 'gd',
        'secretKey' => 'afshina',
        'temp' =>  'uploads/temp',
        'upload_path' =>  '/uploads/',
        'quality'     => 100,
        'user_profile' => [
            'dimensions' => [
                'm' => [400,250,70],
                'l'  => [800,600,80],
                'thumb'  => [250, 250,80,true],
           ],
        ],

        'minquality' => 200 // kamtar az in width va height nemigirim
    ]
];
?>
