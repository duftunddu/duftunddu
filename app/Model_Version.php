<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $users_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $type
 * @property float $version
 * @property string $deleted_at
 * @property User $user
 * @property AffectingFactorsDatum[] $affectingFactorsDatas
 */
class Model_Version extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'model_version';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['users_id', 'created_at', 'updated_at', 'type', 'version', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function affectingFactorsDatas()
    {
        return $this->hasMany('App\AffectingFactorsDatum');
    }
}
