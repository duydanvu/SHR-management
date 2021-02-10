<?php


namespace App\Http\Controllers;


use App\Area;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportAreaController  extends Controller implements FromCollection,WithHeadings
{
    //
    public function collection()
    {
        $area = Area::leftJoin('stores','area.id','=','stores.area_id')
            ->select('area.id','area.area_name','area.area_description', DB::raw('COUNT(stores.area_id) AS sum'))
            ->groupBy('stores.area_id')
            ->groupBy('area.id')
            ->groupBy('area.area_name')
            ->groupBy('area.area_description')
            ->orderBy('area.area_name')
            ->get();
        return $area;
    }

    public function headings(): array
    {

        return [
            'STT',
            'Tên Khu Vực',
            'Thông tin chi tiết',
            'Tổng số cửa hàng'
        ];
    }
}
