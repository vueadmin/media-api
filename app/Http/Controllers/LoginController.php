<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function login() {
        return [
            'code' => 200,
            'data' => [
                'token' => 'admin-token'
            ]
        ];
    }

    public function userInfo() {
        return [
            'code' => 200,
            'data' => [
                'avatar' => 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif',
                'introduction' => 'I am a super administrator',
                'name' => 'Super Admin',
                'roles' => [
                    'admin'
                ]
            ]
        ];
    }

    public function jwttoken(Request $request) {
        return [
            'code' => 200,
            'data' => 'keikeizhang'
        ];
    }
}
