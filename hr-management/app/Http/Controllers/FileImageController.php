<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class FileImageController extends Controller
{
    public function doUpdload(Request $request){
        if($request -> ajax()){
            $data = $request->file('file');
            $extension = $data->getClientOriginalExtension();
            $filename = "userImage".time().'.'.$extension;

            $path = public_path("upload");

            $usersImage = public_path("\upload\{$filename}");

            $upload_success = $data->move($path,$filename);

            return response()->json([
                'success' => 'done',
                'valueimg' => $path,
                'link'=> $data
            ]);
        }else{
            return 1;
        }
    }
}
