<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function control(Request $request)
    {
        $response = collect([
            'hashtags' => '#disconakts #disconakts2018',
            //'hashtags' => '#liepaja',
            //'hashtags' => '#grobina',
            'hashtags' => '#spotify',
            'reload' => false,
            'clear' => false,
            'randomInstagram' => true,
            'randomTwitter' => true,
            'reloadSec' => 30,
        ]);

        return response()->json($response);
    }
}
