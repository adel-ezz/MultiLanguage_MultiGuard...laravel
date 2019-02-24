<?php

namespace App\Http\Controllers\API;

use App\Department;
use App\Http\Middleware\Admin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    //
    use BaseApiController;

    ///=====================Login============================//
    function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::guard('admin')->attempt((['email' => request('email'), 'password' => request('password')]))) {
            $user = \App\Admin::where('email', $request->email)->first();
            $token = $user->createToken('MyApp')->accessToken;
            $data = ['user' => $user, 'token' => $token];
            return $this->apiResponse($data);
        } else {
            return $this->apiResponse('', 'خطأ فى البريد الإلكترونى أو فى كلمة المرور', 401);
        }
    }

    ///===============department====================//
    function department($id)
    {

        $department = Department::find($id);
        if ($department) {
            $data = $department->select('id')->
            with(array('translations' => function ($query) {
                $query->select('id', 'language', 'content', 'translatable_id');
            }))->with(array('users' => function ($query) {
                $query->select('name', 'email', 'department_id');
            }))->first()->toArray();

            return $this->apiResponse($data, '', 200);
        } else {
            return $this->apiResponse('', 'Not Found', 401);
        }
    }

    ///===============department====================//
    function user($id)
    {

        $user = User::find($id);

        if ($user) {
            $data = $user->select('id', 'name', 'email', 'department_id')->with(array('department' => function ($query) {
                $query->with(array('translations' => function ($query2) {
                    $query2->select('id', 'language', 'content', 'translatable_id');
                }));
            }))->first()->toArray();
            return $this->apiResponse($data, '', 200);
        } else {
            return $this->apiResponse('', 'Not Found', 401);
        }
    }

}
