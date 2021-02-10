<?php


namespace App\Http\Controllers;


use App\Store;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportStoresController  extends Controller implements FromCollection,WithHeadings
{
    public function collection()
    {
        $store = Store::leftJoin('users','users.store_id','=','stores.store_id')
            ->select('stores.store_id','stores.store_name','stores.store_address','stores.phone', DB::raw('COUNT(users.store_id) AS sum'))
            ->groupBy('stores.store_id')
            ->groupBy('stores.store_name')
            ->groupBy('stores.store_address')
            ->groupBy('stores.phone')
            ->get();
        return $store;
    }

    public function headings(): array
    {

        return [
            'STT',
            'Tên Cửa Hàng',
            'Địa Chỉ Cửa hàng',
            'Số Điện Thoại Cửa Hàng',
            'Tổng số nhân viên'
        ];
    }
}
