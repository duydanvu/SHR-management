<?php

namespace App\Http\Controllers;

use App\Area;
use App\User;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class AreaController extends Controller
{
    public function listArea(){

        $area = Area::leftJoin('stores','area.id','=','stores.area_id')
                        ->select('area.id','area.area_name','area.area_description', DB::raw('COUNT(stores.area_id) AS sum'))
                        -> addSelect(DB::raw("'0' as GDV"))
                        -> addSelect(DB::raw("'0' as AM"))
                        -> addSelect(DB::raw("'0' as KAM"))
                        -> addSelect(DB::raw("'0' as CT"))
                        -> addSelect(DB::raw("'0' as TV"))
                        ->groupBy('stores.area_id')
                        ->groupBy('area.id')
                        ->groupBy('area.area_name')
                        ->groupBy('area.area_description')
                        ->orderBy('area.area_name')
                        ->get();
        $user_gdv = User::join('stores','users.store_id','=','stores.store_id')
            ->join('area','stores.area_id','=','area.id')
            ->select('area.id','area.area_name',DB::raw('COUNT(users.position_id) AS sum_gdv'))
            ->where('position_id','=',3)
            ->groupBy('area.area_name','area.id')
            ->get();
        foreach ($area as $value){
            foreach ($user_gdv as $value1){
                if($value->id === $value1->id){
                    $value->GDV = $value1->sum_gdv;
                }
            }
        }
        $user_am = User::join('stores','users.store_id','=','stores.store_id')
            ->join('area','stores.area_id','=','area.id')
            ->select('area.id','area.area_name',DB::raw('COUNT(users.position_id) AS sum_am'))
            ->where('position_id','=',5)
            ->groupBy('area.id','area.area_name')
            ->get();
        foreach ($area as $value){
            foreach ($user_am as $value1){
                if($value->id === $value1->id){
                    $value->AM = $value1->sum_am;
                }
            }
        }
        $user_kam = User::join('stores','users.store_id','=','stores.store_id')
            ->join('area','stores.area_id','=','area.id')
            ->select('area.id','area.area_name',DB::raw('COUNT(users.position_id) AS sum_kam'))
            ->where('position_id','=',6)
            ->groupBy('area.id','area.area_name')
            ->get();
        foreach ($area as $value){
            foreach ($user_kam as $value1){
                if($value->id === $value1->id){
                    $value->KAM = $value1->sum_kam;
                }
            }
        }
        $user_ct = User::join('stores','users.store_id','=','stores.store_id')
            ->join('area','stores.area_id','=','area.id')
            ->select('area.id','area.area_name',DB::raw('COUNT(users.contract_id) AS sum_ct'))
            ->where('contract_id','=',1)
            ->groupBy('area.id','area.area_name')
            ->get();
        foreach ($area as $value){
            foreach ($user_ct as $value1){
                if($value->id === $value1->id){
                    $value->CT = $value1->sum_ct;
                }
            }
        }
        $user_tv = User::join('stores','users.store_id','=','stores.store_id')
            ->join('area','stores.area_id','=','area.id')
            ->select('area.id','area.area_name',DB::raw('COUNT(users.contract_id) AS sum_tv'))
            ->where('contract_id','=',2)
            ->groupBy('area.id','area.area_name')
            ->get();
        foreach ($area as $value){
            foreach ($user_tv as $value1){
                if($value->id === $value1->id){
                    $value->TV = $value1->sum_tv;
                }
            }
        }
//        dd($area);
        return view('area.area_list',compact('area'));
    }

    public function addNewArea(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required|max:50',
            'txtDescription' => 'required|max:250',
        ]);
        $noti= array(
            'message' => ' Đăng ký lỗi! Hãy chọn phần tạo tài khoản và nhập lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator->fails()) {
            return Redirect::back()
                ->with($noti)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            $create_area = DB::table('area')->insert([
                'area_name'=> $request['txtName'],
                'area_description' => $request['txtDescription']
            ]);
        }catch (QueryException $ex){
            $notification = array(
                'message' => 'Tên hoặc Thông tin không chính xác! Vui lòng nhập lại ',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
        $notification = array(
            'message' => 'Thêm thông tin thành công!',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }

    public function viewUpdateArea($id){
        $data = Area::find($id);
        return view('area.view_area_update')->with('data',$data);
    }

    public function updateInforArea(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required|max:50',
            'txtDescription' => 'required|max:250',
        ]);
        $noti= array(
            'message' => ' Cập nhật lỗi! Hãy kiểm tra lại thông tin tài khoản và nhập lại !',
            'alert-type' => 'error'
        );
        if ($validator->fails()) {
            return Redirect::back()
                ->with($noti)
                ->withErrors($validator)
                ->withInput();
        }
        $data_area_update =DB::table('area')->where('id','=',$request->area_id)
            ->update([
                'area_name'=>$request->txtName,
                'area_description'=>$request->txtDescription
            ]);
        if($data_area_update = 1){
            $notification = array(
                'message' => 'Cập nhật thông tin thành công!',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Cập nhật thông tin không thành công!',
                'alert-type' => 'success'
            );
        }
        return Redirect::back()->with($notification);
    }

    public function deleteArea($id){
        $update_store = DB::table('stores')->select('store_id')
            ->where('area_id','=',$id)
            ->get();
        foreach ($update_store as $value){
            $update_id_area = DB::table('stores')->where('store_id','=',$value->store_id)
                ->update(['area_id'=>1]);
        }
        $data = DB::table('area')
            ->delete($id);
        if($data = 1){
            $notification = array(
                'message' => 'Xoá thông tin thành công!',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Xóa thông tin không thành công!',
                'alert-type' => 'success'
            );
        }
        return Redirect::back()->with($notification);
    }

    public function export_Area(){
        return Excel::download(new ExportAreaController(),'Area.xlsx');
    }


}
