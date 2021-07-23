<?php

namespace App\Models;

use Eloquent as Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Ads
 * @package App\Models
 * @version December 27, 2019, 9:42 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection webpages
 * @property string photo
 * @property string name
 * @property string webpage
 */
class Ads extends Model
{
    // use SoftDeletes;

    public $table = 'ads';
    

    // protected $dates = ['deleted_at'];



    public $fillable = [
        'photo',
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'photo' => 'string',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function webpages()
    {
        return $this->belongsToMany(\App\Models\Webpage::class, 'ads_webpage', 'ads_id', 'webpage_id');
    }
}
