<?php return array (
  'fideloper/proxy' => 
  array (
    'providers' => 
    array (
      0 => 'Fideloper\\Proxy\\TrustedProxyServiceProvider',
    ),
  ),
  'hesto/multi-auth' => 
  array (
    'providers' => 
    array (
      0 => 'Hesto\\MultiAuth\\MultiAuthServiceProvider',
    ),
  ),
  'intervention/image' => 
  array (
    'providers' => 
    array (
      0 => 'Intervention\\Image\\ImageServiceProvider',
    ),
    'aliases' => 
    array (
      'Image' => 'Intervention\\Image\\Facades\\Image',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'mews/captcha' => 
  array (
    'providers' => 
    array (
      0 => 'Mews\\Captcha\\CaptchaServiceProvider',
    ),
    'aliases' => 
    array (
      'Captcha' => 'Mews\\Captcha\\Facades\\Captcha',
    ),
  ),
);