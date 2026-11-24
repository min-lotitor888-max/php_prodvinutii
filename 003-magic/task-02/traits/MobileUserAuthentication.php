<?php

trait MobileUserAuthentication
{
    private $mobileLogin = 'mobile_user';
    private $mobilePassword = 'mobile_pass';

    public function authenticate($login, $password)
    {
        if ($login === $this->mobileLogin && $password === $this->mobilePassword) {
            return 'Пользователь авторизован как пользователь мобильного приложения.';
        }

        return null;
    }
}
