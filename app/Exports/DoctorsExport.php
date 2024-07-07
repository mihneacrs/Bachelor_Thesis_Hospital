<?php

namespace App\Exports;

use App\Models\Doctor;
use Maatwebsite\Excel\Concerns\FromCollection;

class DoctorsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $doctor=Doctor::select('name','phone','specialty','room') ->get();

        return $doctor;
    }
}
