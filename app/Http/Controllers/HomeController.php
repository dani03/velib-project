<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    public function __invoke()
    {
        //find all the data from redis 
        $keys = Redis::connection()->keys('*');
        $datas = [];
        $dataCollections = [];
        foreach ($keys as $key) {

            $values = Redis::hgetall($key);

            // Combine the key and values into an associative array
            $datas[$key] = $values;
        }
        
        return view('home', compact('datas'));

        //send the data to the view
    }
}
