<?php

namespace App\Http\Controllers;

use App\LinkImage;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
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

    public function uploadMoreImage(Request $request){
        if($request->hasFile('filesTest')){
            try {
                $str_id = '';
                foreach ($request->filesTest as $key => $value) {
                    $extension = $value->getClientOriginalExtension();
                    $filename = "userImage" . time() . $key . '.' . $extension;
                    $path = public_path("upload");

                    $url = "/upload/" . $filename;
                    $usersImage = public_path($url);

                    $upload_success = $value->move($path, $filename);

                    $insert_link = DB::table('link_images')->insertGetId([
                        'link_image' => $url,
                    ]);

                    $str_id = $str_id . ',' . $insert_link;
                }
                $insert_link = DB::table('link_image_wait_add_products')->insertGetId([
                    'link_wait' => substr($str_id, 1, strlen($str_id) - 1),
                ]);
            }
        catch (QueryException $ex){
                $notification = array(
                    'message' => 'File Ảnh Nhập Bị Lỗi, Cần Nhập Lại',
                    'alert-type' => 'error'
                );
                return Redirect::back()->with($notification);
            }
        $notification = array(
            'message' => 'Nhập file thành công!',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Cần thêm file trước khi tải lên!',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
    }
}
