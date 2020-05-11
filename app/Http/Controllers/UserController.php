<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Yaml\Yaml;

class UserController extends Controller
{
    public function home()
    {
        if (session()->get('blog_name')) {
            return redirect()->to('/posts');
        } else {
            return view('guest');
        }
    }
    public function page_signin()
    {
        return view('signin');
    }
    public function page_resetpasswd()
    {
        return view('resetpasswd');
    }
    public function page_logout()
    {
        session()->flush();
        return redirect()->to('/');
    }

    public function api_signin(Request $request)
    {
        $conf  = Yaml::parseFile(base_path()."/conf.yaml");
        $admin_email = $request->input('admin_email');
        $md5_passwd = $request->input('md5_passwd');
        if ($admin_email == $conf['admin_email'] and $md5_passwd == $conf['md5_passwd']) {
            session()->put('admin', true);
            return response()->json(['err' => false, 'admin' => true]);
        }else{
            return response()->json(['err' => true, 'err_type' => 'alert', 'err_msg' => '登陆失败']);
        }
    }
}
