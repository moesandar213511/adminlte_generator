<?php

namespace App\Models;

use Eloquent as Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Post
 * @package App\Models
 * @version December 27, 2019, 4:53 am UTC
 *
 * @property string photo
 * @property integer cat_id
 * @property string title
 * @property string content
 */
class Post extends Model
{
    // use SoftDeletes;

    public $table = 'posts';
    

    // protected $dates = ['deleted_at'];



    public $fillable = [
        'photo',
        'cat_id',
        'title',
        'content'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'photo' => 'string',
        'cat_id' => 'integer',
        'title' => 'string',
        'content' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function category(){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }
}
