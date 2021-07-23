<?php

namespace App\Models;

use Eloquent as Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Webpage
 * @package App\Models
 * @version December 27, 2019, 9:45 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection ads
 * @property string name
 */
class Webpage extends Model
{
    // use SoftDeletes;

    public $table = 'webpages';
    

    // protected $dates = ['deleted_at'];



    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
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
    public function ads()
    {
        return $this->belongsToMany(\App\Models\Ads::class, 'ads_webpage', 'webpage_id', 'ads_id');
    }
}
