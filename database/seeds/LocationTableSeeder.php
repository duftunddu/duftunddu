<?php

use App\Location;
use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

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
            Location::create($Arr[$i]);
        }
        return;
    }

    public function run()
    {
        Location::truncate();

        // Number of files
        $n = 60;

        //Importing files
        for($i = 1; $i < $n+1; $i++){
            $csv_filename = "iplocation/iplocation_part{$i}.csv";
            $this->importCsv($csv_filename);
        }
        return;
    }
}
