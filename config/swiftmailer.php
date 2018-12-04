<?php
return [
    // Renderer settings
    'swiftmailer' => [
        'enable' => false,
        'transport_type' => 'smtp', //smtp or sendmail
        'smtp'    =>[
            'auth_mode'=> '',
            'username'=> '',
            'password'=> '',
            'host'=> '',
            'port'=> '',
        ],
        'sendmail' => [
            'command' => '/usr/sbin/sendmail -bs'
        ]
    ],
];
?>