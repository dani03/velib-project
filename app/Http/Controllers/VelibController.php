<?php

namespace App\Http\Controllers;

use App\Http\Requests\FindStationRequest;
use App\Http\Requests\StoreStationRequest;
use App\Http\Services\RedisService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use LDAP\Result;

class VelibController extends Controller
{

    public function __construct(public RedisService $redisService)
    {
        $this->redisService = $redisService;
    }


    public function findVelib(FindStationRequest $request)
    {
        $userResreach = $request->velib_name;

        $stationsVille = $this->redisService->find("ville", $userResreach);
        $stationsCommunes = $this->redisService->find("Nom station", $userResreach);

        $stations = array_merge($stationsCommunes, $stationsVille);

        return view('home', compact('stations'));
    }

    public function create()
    {
        return view('create');
    }

    public function index()
    {
        $keys = $this->redisService->findAllKeys();
        $datas = [];
        $dataCollections = [];
        foreach ($keys as $key) {

            $values = Redis::hgetall($key);

            // Combine the key and values into an associative array
            $datas[$key] = $values;
        }

        return view('all', compact('datas'));
    }

    public function store(StoreStationRequest $request)
    {


        $yesNO = ['OUI', 'NON'];
        $id = rand(25000, 30000);
        $data = [
            "station" => "station:",
            "Identifiant" => $id,
            "Nom station" => $request->ville,
            "Station en fonctionnement" =>  $yesNO[rand(0, count($yesNO) - 1)],
            "Capacité de la station" => rand(0, 80),
            "Nombre bornettes libres" => rand(0, 80),
            "Nombre total vélos disponibles" => rand(0, 20),
            "Vélos mécaniques disponibles" => rand(0, 10),
            "Vélos électriques disponibles" =>  rand(0, 8),
            "Borne de paiement disponible" => "OUI",
            "Retour vélib possible" => "OUI",
            "Actualisation de la donnée" => Carbon::now()->diffForHumans(),
            "ville" => $request->commune,

            "theid" => "station:$id:$request->commune",

        ];

        if (!Redis::connection()->hmset($data['theid'], $data)) {
            return redirect()->back()->with('errors', 'impossible d\'ajouté la station');
        }
        return redirect()->back()->with('success', 'station ajouté');
    }

    public function delete(string $velibKey)
    {

        Redis::connection()->del($velibKey);

        return redirect()->back()->with('success', 'station supprimée');
    }

    public function edit($stationKey)
    {

        $station =  $this->redisService->getValues($stationKey);
        
        return view('edit', compact('station'));
    }

    public function update(StoreStationRequest $request, $key) {
        //dd($request->all(), $key);
        $infos = explode(':', $key);
        $id = $infos[1];
        
        $data = [
            "station" => "station:",
            "Identifiant" => $id,
            "Nom station" => $request->ville,
            "Station en fonctionnement" =>  "OUI",
            "Capacité de la station" => rand(0, 80),
            "Nombre bornettes libres" => rand(0, 80),
            "Nombre total vélos disponibles" => rand(0, 20),
            "Vélos mécaniques disponibles" => rand(0, 10),
            "Vélos électriques disponibles" =>  rand(0, 8),
            "Borne de paiement disponible" => "OUI",
            "Retour vélib possible" => "OUI",
            "Actualisation de la donnée" => Carbon::now()->diffForHumans(),
            "ville" => $request->commune,

            "theid" => "station:$id:$request->commune",

        ];
        Redis::connection()->hmset($key, $data);

        return redirect()->route('index.velib')->with('success', 'station mis à jour');
    }
}
