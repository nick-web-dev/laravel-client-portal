<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider(){
        return Socialite::driver('azureadb2c')->redirect();
    }

    public function handleProviderCallback(){
        //get the user from azure
        $azureUser = Socialite::driver('azureadb2c')->user();

        //dd($azureUser);

        //dd($azureUser->user['user_scopes_portal']);

        //create a new user in our database
        /*$user = User::updateOrCreate([
            'provider_id' => $azureUser->id,
        ], [
            'name' => $azureUser->user['name'],
            'email' => $azureUser->user['signInName'],
            'provider_name' => 'azure',
            'provider_token' => $azureUser->token,
            'provider_refresh_token' => $azureUser->refreshToken,
            'dundas_logon_token_id' => $azureUser->user['dundas_logon_token_id'],
            'dundas_dashboard_id' => $azureUser->user['dundas_dashboard_id'],
            'dundas_reports_id' => $azureUser->user['dundas_reports_id'],
            'user_scopes_portal' => serialize($azureUser->user['user_scopes_portal']),
        ]);*/

        //log user in
        //Auth::login($user);

        //redirect to dashboard
        return redirect('/');


    }
    public static function consumeToken($state, $id_token){
        $state = (csrf_token() == $state);

        if( $state ){
            $auth_server = env('AZURE_PROVIDER');
        }

        // dump("csrf state: $state");
        $token = explode('.', $id_token);

        list($head, $payload) = array_map(function($value){
            return json_decode(base64_decode($value), true);
        }, $token);
        $signature = $token[2];

        $claims = array_intersect_key($payload, [
            "signInName" => '',
            "name" => '',
            "given_name" => '',
            "family_name" => '',
            "account_id" => '',
            "account_type" => '',
            "account_name" => '',
            "user_scopes_portal" => '',
        ]);

        // dump( $head, $payload, $signature, $claims );

        //
        // RSASHA256(
        //     base64UrlEncode(header) + "." +
        //     base64UrlEncode(payload),
        //     'PUBLIC KEY',
        //     'RSA PRIVATE KEY'
        // )

        $rush_api = resolve('App\Services\Rushmore');
        $rush_api->setUser( $claims );

        // dd( $rush_api->getData('account-dashboard') );
    }

    public function logout(){
        // CURL https://owdb2c.b2clogin.com/owdb2c.onmicrosoft.com/b2c_1a_logout_dev/oauth2/v2.0/authorize?response_type=id_token&scope=openid%20profile&client_id=35a32da3-8792-439f-894d-29b110c66455&redirect_uri={{ urlencode('http://localhost:6420/') }}&state={{ csrf_token() }}&response_mode=query
        $rush_api = resolve('App\Services\Rushmore');
        $rush_api->logout();
        return redirect()->route('home');
    }
}
