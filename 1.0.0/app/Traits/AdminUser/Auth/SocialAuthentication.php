<?php

namespace App\Traits\AdminUser\Auth;

use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers as IlluminateAuthenticatesUsers;
use Socialite;
use AdminUser;

trait SocialAuthentication
{
    use IlluminateAuthenticatesUsers, Common {
         Common::guard insteadof IlluminateAuthenticatesUsers;
    }

    //use IlluminateAuthenticatesUsers;

    /**
     * Redirect the user to the provider authentication page.
     *
     * @return Response
     */
    function redirectToProvider($provider)
    {
        $this->setCallbackUrl($provider);
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @return Response
     */
    function handleProviderCallback($provider)
    {
        $this->setCallbackUrl($provider);
        $guard = $this->getGuard();
        $user = Socialite::driver($provider)->user();
        $model = $this->getAuthModel();
        $data  = [
            'name'      => $user->getName(),
            'email'     => $user->getEmail(),
            'status'    => 'Active',
            'password'  => bcrypt(str_random(8)),
            'api_token' => str_random(60),
        ];
        $user = $model::whereEmail($data['email'])->first();

        if (!is_null($user)) {
            AdminUser::login($user, false, $guard);
        } else {
            $user = $model::create($data);
            AdminUser::login($user, false, $guard);
        }
        return redirect($this->redirectTo);
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function setCallbackUrl($provider)
    {
        $guard = $this->getGuardRoute();
        $currentUrl = config("services.{$provider}.redirect");
        $newUrl = str_replace('/user/', "/$guard/", $currentUrl);
        config(["services.{$provider}.redirect" => $newUrl]);
    }
}
