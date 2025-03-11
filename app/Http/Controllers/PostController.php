<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //


    public function vistaIndex(Request $request){
        $autor_id=$request->autor_id;
        return view("post.index",["autor_id" =>$autor_id]);
    }

    public function postId(Request $request){

        // dd($request->id);
        $post_id=$request->post_id;
        $autor_id=$request->autor_id;
        // dump($request);
        // die($request);
        return view("post.post_id",
        [
            "autor_id" => $autor_id,
            "post_id" => $post_id,
        ]
        );
    }

    public function crearPostView(Request $request){
        $autor_id=$request->autor_id;

        return view("post.crear_post",

        [
            "autor_id" => $autor_id,
        ]
        );
    }



    public function crearPost(Request $request){
        // dd($_POST);
        // dd($request->titulo);

        return redirect()->route("autor.index",["autor_id", $request->titulo]);
        return new JsonResponse([
            "status_code" => "200",
            "mensaje" => "UwU",
            "detalle" => [],
        ],200);
    }

}
