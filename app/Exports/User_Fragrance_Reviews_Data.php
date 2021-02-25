<?php

namespace App\Exports;

use App\Helper\Fragrance_Review_Helper;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class User_Fragrance_Reviews_Data implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $fragrance_review_helper = new Fragrance_Review_Helper();
        $all = $fragrance_review_helper->get_fragrance_review_data();
        
        return $all;
    }

    public function headings() :array
    {
        // Field names
        $fragrance_review_helper = new Fragrance_Review_Helper();
        return $fragrance_review_helper->get_fragrance_review_data_fields_export();
    }
}
