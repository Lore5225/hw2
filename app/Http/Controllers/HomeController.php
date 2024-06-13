<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class HomeController extends BaseController
{
    public function checkAuth()
    {
        if (Session::has('userID')) {
            return redirect('indexlogged');
        }

        return view('index');
    }

    public function ApiYoutube()
    {

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://youtube138.p.rapidapi.com/channel/videos/?id=UCv--CI9ZNufqFTUAFc4bO0Q&filter=videos_latest&hl=en&gl=US",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: youtube138.p.rapidapi.com",
                "x-rapidapi-key: 74908fddb5mshdf5d39b7e5212d2p1e682ajsn2dc8e06f3c19"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);


        if ($err) {
            return response()->json(['error' => $err]);
        } else {
            return response()->json(json_decode($response, true));
        }
    }
}
