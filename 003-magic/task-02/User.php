<?php

class User
{
    use AppUserAuthentication, MobileUserAuthentication {
        AppUserAuthentication::authenticate insteadof MobileUserAuthentication;
        MobileUserAuthentication::authenticate as authenticateMobile;
    }

    public function login($login, $password)
    {
        $appResult = $this->authenticate($login, $password);

        if ($appResult !== null) {
            return $appResult;
        }

        $mobileResult = $this->authenticateMobile($login, $password);

        if ($mobileResult !== null) {
            return $mobileResult;
        }

        return 'Неверный логин или пароль.';
    }
}
