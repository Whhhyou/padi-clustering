<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MapController extends Controller
{
    public function Map(Request $request)
    {
        $availableYears = DB::table('tb_perhitungan')
        ->select('tahun')
        ->distinct()
        ->pluck('tahun');

        $tahun = $request->input('tahun', 2018); 

        $geojson = file_get_contents(public_path('template/js/geojson.geojson'));
        $geojsonData = json_decode($geojson);

        //dd($geojsonData);

        $clusters = DB::table('tb_perhitungan')
            ->select('id_kabupaten', 'cluster')
            ->where('tahun', $tahun)
            ->distinct()
            ->get();
        
        $clusterMap = [];
        foreach ($clusters as $cluster) {
            $clusterMap[$cluster->id_kabupaten] = $cluster->cluster;
        }

        foreach ($geojsonData->features as $feature) {
            $id_kabupaten = $feature->properties->id;
            if (isset($clusterMap[$id_kabupaten])) {
                $feature->properties->cluster = $clusterMap[$id_kabupaten];
            } else {
                $feature->properties->cluster = null;
            }
        }

        $modifiedGeojsonString = json_encode($geojsonData);

        //dd($geojsonData);

        return view('maps', ['geojson' => $modifiedGeojsonString, 'availableYears' => $availableYears]);
    }
}

