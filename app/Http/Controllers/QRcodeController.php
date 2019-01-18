<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Flash;


class QRcodeController extends Controller
{
    //
    public function index(){

        return view('qrcode');
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
     
        return view('qrcode');
    }
}
