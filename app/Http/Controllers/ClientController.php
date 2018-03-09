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
            'hashtags' => '#liepaja #riga',
            'reload' => false,
            'clear' => false,
            'instagram' => [
                'random' => true,
                'limit' => 1,
            ],
            'twitter' => [
                'random' => true,
                'limit' => 1,
            ],
            //'randomInstagram' => true,
            //'randomTwitter' => true,
            'reloadSec' => 30,
        ]);

        return response()->json($response);
    }
}
