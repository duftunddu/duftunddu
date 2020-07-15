<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property boolean $id
 * @property boolean $profession_category_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property ProfessionCategory $professionCategory
 * @property FragranceProfile[] $fragranceProfiles
 */
class Profession extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'profession';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['profession_category_id', 'created_at', 'updated_at', 'name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function professionCategory()
    {
        return $this->belongsTo('App\ProfessionCategory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fragranceProfiles()
    {
        return $this->hasMany('App\FragranceProfile');
    }
}
