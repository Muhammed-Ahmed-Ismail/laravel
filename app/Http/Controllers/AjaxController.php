<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AjaxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function view()
    {
        return view('test');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function send_http_request(Request $request)
    {

        Log::info((string)$request);

        return response()->json([
            'success'=>'get your data'
        ]);

    }

}
