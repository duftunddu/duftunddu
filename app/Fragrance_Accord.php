<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $fragrance_id
 * @property int $accord_id
 * @property string $created_at
 * @property string $updated_at
 * @property Accord $accord
 * @property Fragrance $fragrance
 */
class Fragrance_Accord extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'fragrance_accord';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['fragrance_id', 'accord_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accord()
    {
        return $this->belongsTo('App\Accord');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fragrance()
    {
        return $this->belongsTo('App\Fragrance');
    }
}
