<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileImageController extends Controller
{
    public function doUpdload(Request $request){
        if ($request->hasFile('filesTest')) {
            $file = $request->filesTest;
            if($file->getClientOriginalExtension() == "jpg" || $file->getClientOriginalExtension() == 'png'
                ||$file->getClientOriginalExtension() == "JPG" || $file->getClientOriginalExtension() == "JPG"){
                $file->move('upload', $file->getClientOriginalName());
                $notification = array(
                    'message' => 'Member created successfully!',
                    'alert-type' => 'success'
                );
                return redirect('/admin/user')->with($notification);
            }else{
                dd($file);
            }

        }
    }
}
