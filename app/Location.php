<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $ip_from
 * @property int $ip_to
 * @property string $country_code
 * @property string $country_name
 * @property string $region_name
 * @property string $city_name
 * @property float $latitude
 * @property float $longitude
 * @property string $zip_code
 * @property string $time_zone
 */
class Location extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'location';

    /**
     * @var array
     */
    protected $fillable = ['id', 'ip_from', 'ip_to', 'country_code', 'country_name', 'region_name', 'city_name', 'latitude', 'longitude', 'zip_code', 'time_zone'];
    
    public $timestamps = false;
}
