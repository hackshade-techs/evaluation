<?php

namespace App\Http\Controllers;

use App\Models\CourseUnit;
use Illuminate\Http\Request;

class CourseUnitController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $page = $request->input('page');

        if ($search_term)
        {
            $results = CourseUnit::where('name', 'LIKE', '%'.$search_term.'%')->paginate(10);
        }
        else
        {
            $results = CourseUnit::paginate(10);
        }

        return \Response::json($results);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\CourseUnit  $CourseUnit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return CourseUnit::find($id);
    }
}
