
<?php
return [
  'swiftmailer' => [
      'enabled' => true,
      'allowed_transport_type' => ['smtp', 'sendmail'],
      'transport_type'=>'smtp',
      'smtp'=> [
          'auth_mode'=> [
              'username' => '',
              'password' => '',
              'host' => '',
              'port' => '',
              'encryption' => '',
          ]
      ],
      'sendmail' => [
          'command'=> ''
      ]
  ]
];
