<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property boolean $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property FragranceProfile[] $fragranceProfiles
 */
class Climate extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'climate';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fragranceProfiles()
    {
        return $this->hasMany('App\FragranceProfile');
    }
}
