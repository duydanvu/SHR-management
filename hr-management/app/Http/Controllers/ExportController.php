<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportController extends Controller implements FromCollection,WithHeadings
{
    private  $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    //
    public function collection()
    {
        if ($this->request->add_now_ex == null){
            dd('dddd');
        }
        dd($this->request);
        $users = User::all();
        foreach ($orders as $row) {
            $order[] = array(
                '0' => $row->id,
                '1' => $row->name,
                '2' => $row->address,
                '3' => $row->email,
                '4' => $row->order_date,
                '5' => number_format($row->total),
            );
        }

        return (collect($order));
    }

    public function headings(): array
    {
        return [
            'id',
            'Tên',
            'Địa chỉ',
            'Email',
            'Ngày đặt hàng',
            'Tổng',
        ];
    }
}
