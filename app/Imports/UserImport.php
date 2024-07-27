<?php

namespace App\Imports;

use App\Models\Users\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class UserImport implements ToModel
{
    public function model(array $row)
    {
//        return new User([
//            'name' => $row['name'],
//            'phone' => $row['phone'],
//            'email' => $row['email'],
//            'blood_type_id' => $row['blood_type_id'],
//            'class_room_id' => $row['class_room_id'],
//            'id_number' => $row['id_number'],
//            'birth_date' => Carbon::parse($row['birth_date'])->format('Y-m-d'),
//            'height' => $row['height'],
//            'weight' => $row['weight'],
    }
}
