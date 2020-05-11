<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Yaml\Yaml;

class ViewController extends Controller
{
    public function home()
    {
        $conf  = Yaml::parseFile(base_path()."/conf.yaml");
        $pages = DB::table('pages')
            ->orderBy('id', 'desc')
            ->get();
        $posts = DB::table('posts')
            ->orderBy('time', 'desc')
            ->paginate($conf['paginate']);
        return view('view.view')->with(['name' => $conf['name'], 'posts' => $posts, 'pages' => $pages]);
    }
    public function post($slug)
    {
        $conf  = Yaml::parseFile(base_path()."/conf.yaml");
        $pages = DB::table('pages')
            ->orderBy('id', 'desc')
            ->get();
        $post = DB::table('posts')
            ->where(['slug'=>$slug])
            ->first();
        return view('view.post')->with(['name' => $conf['name'], 'post' => $post, 'pages' => $pages]);
    }
    public function page($slug)
    {
        $conf  = Yaml::parseFile(base_path()."/conf.yaml");
        $pages = DB::table('pages')
            ->orderBy('id', 'desc')
            ->get();
        $post = DB::table('pages')
            ->where(['slug'=>$slug])
            ->first();
        return view('view.page')->with(['name' => $conf['name'], 'post' => $post, 'pages' => $pages]);
    }
}
