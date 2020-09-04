<?php

namespace App\Http\Controllers;

use App\Area;
use App\Store;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class StoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::join('area','area.id','=','stores.area_id')
                ->select('stores.*','area.area_name')
                ->get();
        $area = Area::all();
        return view('store.stores_list')->with(['stores'=>$stores,'area'=>$area]);
    }

    public function view_all_store_of_area($id){
        $area_name =Area::find($id)->area_name;
        $stores = Store::leftJoin('users','users.store_id','=','stores.store_id')
                ->select('stores.store_id','stores.store_name','stores.store_address','stores.area_id',DB::raw('COUNT(users.store_id) AS sum'))
                ->where('area_id','=',$id)
                ->groupBy('stores.store_id')
                ->groupBy('stores.store_name')
                ->groupBy('stores.store_address')
                ->groupBy('stores.area_id')
                ->get();
        $area = Area::all();
        return view('area.view_store_of_area')->with(['stores'=>$stores,'area'=>$area,'area_name'=>$area_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required|max:50',
            'txtAddress' => 'required|max:250',
            'txtPhone' => 'required|max:12',
            'area_id' => 'required|integer'
        ]);
        $notification= array(
            'message' => ' Đăng ký cửa hàng lỗi! Hãy chọn phần tạo tài khoản và nhập lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            $create_area = DB::table('stores')->insert([
                'store_name'=> $request['txtName'],
                'store_address' => $request['txtAddress'],
                'area_id' => $request['area_id'],
                'phone' => $request['txtPhone']
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = Store::find($id);
        $area = Area::all();
        return  view('store.stores_update')->with(['data'=>$data,'area'=>$area]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'txtName'=> 'required|max:50',
            'txtAddress' => 'required|max:250',
            'area_id' => 'required',
            'txtPhone' => 'required|max:12',
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
        $data_area_update =DB::table('stores')->where('store_id','=',$request->store_id)
            ->update([
                'store_name'=>$request->txtName,
                'store_address'=>$request->txtAddress,
                'area_id'=>$request->area_id,
                'phone'=>$request->txtPhone

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $data = Store::find($id)
                ->delete();
        if($data = true){
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

    public function export_stores(){
        return Excel::download(new ExportStoresController(),'Stores.xlsx');
    }
}
