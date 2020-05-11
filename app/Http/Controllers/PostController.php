<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Yaml\Yaml;

function from10to62($dec)
{
    $dict = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $result = '';
    do {
        $result = $dict[$dec % 62] . $result;
        $dec = intval($dec / 62);
    } while ($dec != 0);
    return $result;
}

class PostController extends Controller
{
    public function list()
    {
        $conf = Yaml::parseFile(base_path() . "/conf.yaml");
        if (session()->get('admin')) {
            $posts = DB::table('posts')
                ->orderBy('time', 'desc')
                ->paginate($conf['paginate']);
            return view('admin.posts')->with(['name' => $conf['name'], 'posts' => $posts]);
        } else {
            return redirect()->to('/admin');
        }
    }
    public function new()
    {
        if (session()->get('admin')) {
            $count = DB::table('posts')->count();
            $sid = from10to62(10000000000 + $count);
            DB::table('posts')->insert(['sid' => $sid]);
            return redirect()->to("/admin/posts/$sid");
        } else {
            return redirect()->to('/admin');
        }
    }
    public function edit($sid)
    {
        if (session()->get('admin')) {
            $post = DB::table('posts')->where(['sid' => $sid])->first();
            return view('admin.post')->with(['post' => $post]);
        } else {
            return redirect()->to('/admin');
        }
    }
    public function save(Request $request)
    {
        if (session()->get('admin')) {

            $title = $request->input('title');
            $text = $request->input('text');
            $slug = $request->input('slug');
            $time = $request->input('time');
            $sid = $request->input('sid');

            if ($slug == "") {
                $slug = $sid;
            }

            DB::table('posts')->where(['sid' => $sid])
                ->update([
                    'title' => $title,
                    'text' => $text,
                    'slug' => $slug,
                    'time' => $time,
                ]);
            return response()->json(['err' => false, 'msg' => 'saved']);
        } else {
            return response()->json(['err' => true, 'msg' => 'session']);
        }
    }
    public function del(Request $request)
    {
        if (session()->get('admin')) {
            $sid = $request->input('sid');
            DB::table('posts')->where(['sid' => $sid])
                ->delete();
            return response()->json(['err' => false, 'msg' => 'deleted']);
        } else {
            return response()->json(['err' => true, 'msg' => 'session']);
        }
    }
}
