<?php

 namespace App\Http\Controllers;

 use App\Models\User;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Overtrue\LaravelSaml\Saml;

 class SsoController extends Controller
 {
     // Sesuaikan dengan aplikasi Anda
     private $afterLoginRoute = 'dashboard';
     private $afterLogoutRoute = 'home';

     public function login() {
         if (Auth::check()) {
             return redirect()->route($this->afterLoginRoute);
         }

         return Saml::redirect();
     }

     public function acs(Request $request)
     {
         // Overtrue\LaravelSaml\SamlUser
         $samlUser = Saml::getAuthenticatedUser();

         $parsedAttributes = $this->parseSamlAttributes($samlUser->getAttributes());

         // Jika sudah ada user, maka data diupdate, jika belum ada, maka buat user
         $user = User::updateOrCreate(
             [
                 'email' => $parsedAttributes['email'],
             ],
             [
                 'name' => $parsedAttributes['nama'],
                 'phone' => $this->formatPhoneNumber($parsedAttributes['no_hp']),
                 'email_verified_at' => now(),
                 'password' => Hash::make(random_int(1000000, 99999999)),
                 'phone_verified_at' => now(),
             ]
         );

         // Jika user ditemukan, maka loginkan user
         if ($user != null) {
             Auth::login($user);

             // Redirect ke halaman dashboard
             return redirect()->route($this->afterLoginRoute);
         }

         abort(401, 'User authentication failed.');
     }

     public function logout(Request $request)
     {
         return Saml::redirectToLogout();
     }

     public function sls(Request $request)
     {
         $auth = Saml::handleLogoutRequest();

         Auth::logout();

         return redirect()->route($this->afterLogoutRoute);
     }

     public function metadata(Request $request)
     {
         if ($request->has('download')) {
             return Saml::getMetadataXMLAsStreamResponse();
         }

         return Saml::getMetadataXML();
     }

     /**
      * Convert SAML attributes (which is a 2 dimensional array) to a 1 dimensional array
      * @param  array  $samlAttributes
      * @return array
      */
     private function parseSamlAttributes(array $samlAttributes) : array {
         $result = [];

         foreach ($samlAttributes as $key => $value) {
             $result[$key] = $value[0];
         }

         return $result;
     }

     private function formatPhoneNumber(string $phone)
     {
         $phone = ltrim($phone, " +");
         if (substr($phone, 0, 1) === '0') {
             $phone = '62' . substr($phone, 1);
         }
         if (in_array(substr($phone, 0, 2), ['81', '82', '83', '85', '88', '89'])) {
             $phone = '62' . $phone;
         }
         return $phone;
     }
 }
