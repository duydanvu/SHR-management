<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name'=>$row[20],
            'password'=>$row[19],
            'first_name'=>'',
            'last_name' => $row[4],
            'email' => $row[20],
            'phone' => $row[19],
            'dob' => $row[6],
            'address' => '',
            'gender' => '',
            'url_image' => '',
            'line' => $row[15],
            'store_id' => $row[''],
            'department_id' => $row[''],
            'service_id' => $row[''],
            'position_id' => $row[''],
            'contract_id' => $row[''],
            'contract_number' => $row[26],
            'start_time' => $row[27],
            'end_time' => $row[28],
        ]);
    }
}
