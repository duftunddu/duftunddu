<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property boolean $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property Fragrance[] $fragrances
 */
class Fragrance_Type extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'fragrance_type';

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
    public function fragrances()
    {
        return $this->hasMany('App\Fragrance', 'type_id');
    }
}
