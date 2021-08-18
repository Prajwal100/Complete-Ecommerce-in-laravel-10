<?php

  namespace App\Support;

  use PragmaRX\Google2FALaravel\Exceptions\InvalidSecretKey;
  use PragmaRX\Google2FALaravel\Support\Authenticator;

  class Google2FAAuthenticator extends Authenticator
  {
    protected function canPassWithoutCheckingOTP(): bool
    {
      if ($this->getUser()->loginSecurity == null) {
        return true;
      }
      return
          !$this->getUser()->loginSecurity->google2fa_enable ||
          !$this->isEnabled() ||
          $this->noUserIsAuthenticated() ||
          $this->twoFactorAuthStillValid();
    }

    protected function getGoogle2FASecretKey()
    {
      $secret = $this->getUser()->loginSecurity->{$this->config('otp_secret_column')};

      if (empty($secret)) {
        throw new InvalidSecretKey('Secret key cannot be empty.');
      }

      return $secret;
    }

  }