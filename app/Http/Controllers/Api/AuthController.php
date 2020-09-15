<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        try{
            $http = new \GuzzleHttp\Client();

            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' =>  config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password,
                    'scope' => '',
                ],
            ]);

            return json_decode((string) $response->getBody(), true);

        }catch (\Guzzlehttp\Exception\BadResponseException $e){
            if ($e->getCode()==400){
                return response()->json('invalid username or password', $e->getCode());
            }else if ($e->getCode()==401){
                return response()->json('incorrect username or password', $e->getCode());
            }
            return response()->json('something went wrong on server', $e->getCode());
        }

    }

    public function register(UserRequest $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->password = Hash::make($request->password);

        try {
            $user->save();
//            $user->image()->create(['link' => $request->image]);
            $client = new Client();
            $response = $client->request('POST', url("/api/login"), [
                'form_params' => [
                    'username' => $request->email,
                    'password' => $request->password,
                ]
            ]);
            return json_decode((string) $response->getBody(), true);
        } catch (\Exception $e) {
            return $this->sendError($e);
        }

    }

    public function logout(){
        auth()->user()->tokens->each(function ($token, $key){
            $token->delete();
        });
        return response()->json('logged out successfully');

    }

}
