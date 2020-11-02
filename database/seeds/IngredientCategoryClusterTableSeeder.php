<?php

use App\Ingredient_Category_Cluster;
use Illuminate\Database\Seeder;

class IngredientCategoryClusterTableSeeder extends Seeder
{
    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    public function importCsv($file_name)
    {
        $file = public_path($file_name);
        $Arr = $this->csvToArray($file);
        $data = [];
        for ($i = 0; $i < count($Arr); $i ++)
        {
            // Location::firstOrCreate($Arr[$i]);
            Ingredient_Category_Cluster::firstOrCreate($Arr[$i]);
        }
        return;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // The model name is in importCsv, it indicates the which model to use.

        $csv_filename = "seeds/accords_and_notes/note_category_cluster-utf8.csv";
        $this->importCsv($csv_filename);
        
        return;
    }
}
