<?php

namespace App\Models;

use Eloquent as Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @package App\Models
 * @version December 27, 2019, 4:15 am UTC
 *
 * @property string name
 */
class Category extends Model
{
    // use SoftDeletes;

    public $table = 'categories';
    

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

    public function post()
    {
        return $this->hasMany('App\Models\Post');
    }
}
