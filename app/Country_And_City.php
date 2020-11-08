<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $country_name
 * @property string $city_name
 */
class Country_And_City extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'country_and_city';

    /**
     * @var array
     */
    protected $fillable = ['id', 'country_name', 'city_name'];

}
