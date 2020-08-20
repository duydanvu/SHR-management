<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class FileImageController extends Controller
{
    public function doUpdload(Request $request){
        if($request -> ajax()){
            $data = $request->file('file');
            $extension = $data->getClientOriginalExtension();
            $filename = "userImage".time().'.'.$extension;

            $path = public_path("upload");

            $url = "/upload/".$filename;
            $usersImage = public_path($url);

            $upload_success = $data->move($path,$filename);

            return response()->json([
                'success' => 'done',
                'valueimg' => $path,
                'link'=> $data,
                'url'=> '<input id="url_image" name="url_image" value="'.$url.'" hidden/>',
            ]);
        }else{
            return 1;
        }
    }
}
