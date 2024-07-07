<?php

namespace App\Imports;

use App\Models\Appointment;
use Maatwebsite\Excel\Concerns\ToModel;

class AppointmentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Appointment([
            'name' => $row[0],
            'doctor' => $row[1],
            'date' => $row[2],
            'message' => $row[3],
            'status' => $row[4]
        ]);
    }
}
