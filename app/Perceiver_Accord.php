<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $perceiver_id
 * @property int $accord_id
 * @property string $created_at
 * @property string $updated_at
 * @property Accord $accord
 * @property Perceiver $perceiver
 */
class Perceiver_Accord extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'perceiver_accord';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['perceiver_id', 'accord_id', 'created_at', 'updated_at'];

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
    public function perceiver()
    {
        return $this->belongsTo('App\Perceiver');
    }
}
