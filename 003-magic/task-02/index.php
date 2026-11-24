<?php

require __DIR__ . '/traits/AppUserAuthentication.php';
require __DIR__ . '/traits/MobileUserAuthentication.php';
require __DIR__ . '/User.php';

$user = new User();

echo $user->login('app_user', 'app_pass'), "\n";
echo $user->login('mobile_user', 'mobile_pass'), "\n";
echo $user->login('wrong', 'wrong'), "\n";
