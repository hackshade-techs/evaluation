<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Course extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'courses';
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
     * Get the department to which the courses belong.
     */
    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    /**
     * Get the course units in a particular course.
     */
    public function courseUnits()
    {
        return $this->hasMany('App\Models\CourseUnit');
    }

    /**
     * Get the students in a particular course.
     */
    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }

    /**
     * Get all of the  comments.
     */
    public function suggestions()
    {
        return $this->morphMany('App\Models\Suggestion', 'suggestionable');
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
