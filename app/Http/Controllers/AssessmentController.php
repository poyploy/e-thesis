<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Flash;


class AssessmentController extends Controller
{
    // 
    public function index(){

        return view('assessment');
    }

   /**
     * Display the specified Menu.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show()
    {
        return view('assessment');
    }
}

