<?php

namespace App\Exports;

use App\User_Fragrance_Review;
use Maatwebsite\Excel\Concerns\FromCollection;

class User_Fragrance_Reviews_Data implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User_Fragrance_Review::all();
    }
}
