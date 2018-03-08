<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function control(Request $request)
    {
        $response = collect([
            'hashtags' => '#disconakts #disconakts2018',
            'reload' => 'false',
            'clear' => 'fasle',
        ]);

        return response()->json($response);
    }
}
