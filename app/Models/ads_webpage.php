<?php

namespace App\Models;

use Eloquent as Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ads_webpage
 * @package App\Models
 * @version December 27, 2019, 11:44 am UTC
 *
 * @property integer ads_id
 * @property integer webpage_id
 */
class ads_webpage extends Model
{
    // use SoftDeletes;

    public $table = 'ads_webpages';
    

    // protected $dates = ['deleted_at'];



    public $fillable = [
        'ads_id',
        'webpage_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ads_id' => 'integer',
        'webpage_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
