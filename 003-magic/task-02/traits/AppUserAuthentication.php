<?php

trait AppUserAuthentication
{
    private $appLogin = 'app_user';
    private $appPassword = 'app_pass';

    public function authenticate($login, $password)
    {
        if ($login === $this->appLogin && $password === $this->appPassword) {
            return 'Пользователь авторизован как пользователь приложения.';
        }

        return null;
    }
}
