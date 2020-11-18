<?php

namespace App\Helper;

use App;
use App\Location;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Helper
{
    public function __construct() {
        //
    }

    public static function normalize_name($name){
        
        if (App::environment('local')) {
            // The environment is local
            $process = new Process([
                'C:\Anaconda3\envs\duft_und_du\python.exe',
                'unidecode_string.py',
                $name
            ], null, [
                // 'PYTHONHOME' => 'C:\Program Files\WindowsApps\PythonSoftwareFoundation.Python.3.8_3.8.1520.0_x64__qbz5n2kfra8p0',
                // 'PYTHONPATH' => 'C:\Program Files\WindowsApps\PythonSoftwareFoundation.Python.3.8_3.8.1520.0_x64__qbz5n2kfra8p0;C:\Users\Abdul Samad\AppData\Local\Packages\PythonSoftwareFoundation.Python.3.8_qbz5n2kfra8p0\LocalCache\local-packages\Python38\site-packages',
                'PYTHONHASHSEED' => 1,
            ]);
        }
        
        if (App::environment('production')) {
            // The environment is either local OR staging...
            $process = new Process([
                'C:\Anaconda3\envs\duft_und_du\python.exe',
                'unidecode_string.py',
                $name
            ], null, [
                'PYTHONHASHSEED' => 1,
            ]);
        }


      
      $process->run();

      // executes after the command finishes
      if (!$process->isSuccessful()) {
          throw new ProcessFailedException($process);
      }
      
      $normal_name  = rtrim($process->getOutput());

      return $normal_name;
    }

    public static function var_dump_readable($var){
        echo '<pre>' , var_dump($var) , '</pre>';
        return;
    }

    public static function current_location(){
        return Location::firstWhere('ip_to', '>', ip2long(request()->ip()));
    }

    // It is said that it Returns a pure array not a stdClass knockoff,
    // I tried and was disappointed but further testing is required
    public static function convert_collection_to_array($array_with_stdClass){
        return array_map( function($value) { return (array)$value; }, $array_with_stdClass );
    }
}