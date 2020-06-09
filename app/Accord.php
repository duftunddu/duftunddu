<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property FragranceAccord[] $fragranceAccords
 * @property PerceiverAccord[] $perceiverAccords
 */
class Accord extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'accord';

    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fragranceAccords()
    {
        return $this->hasMany('App\FragranceAccord');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function perceiverAccords()
    {
        return $this->hasMany('App\PerceiverAccord');
    }
}
