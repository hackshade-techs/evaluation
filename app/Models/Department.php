<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
     */

    protected $table = 'departments';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
     */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
     */

    /**
     * Get the lecturers in a department.
     */
    public function lecturers()
    {
        return $this->hasMany('App\Models\Lecturer');
    }

    /**
     * Get the faculty to which the departments belong.
     */
    public function faculty()
    {
        return $this->belongsTo('App\Models\Faculty');
    }

    /**
     * Get the courses in a department.
     */
    public function courses()
    {
        return $this->hasMany('App\Models\Course');
    }

    /**
     * Get all of the  comments.
     */
//    public function suggestions()
//    {
//        return $this->morphMany('App\Models\Suggestion', 'suggestionable');
//    }

    public function suggestions() {

        return $this->hasMany('App\Models\Suggestion');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
     */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
     */

    /*
|--------------------------------------------------------------------------
| MUTATORS
|--------------------------------------------------------------------------
 */
}
