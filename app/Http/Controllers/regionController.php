<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\regionModel;

class regionController extends Controller
{
    public function mostrarRegiones($pais){
        $curl = curl_init(); 

        curl_setopt_array($curl, [
            CURLOPT_URL => "http://battuta.medunes.net/api/region/".$pais."/all/?key=7b6ed3d77be4dd5b5d8b5670b8f4d155",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            //CURLOPT_ENCONDING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT =>30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",

        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if($err){
            echo "curl error #:". $err;
        }else{
            $objeto = json_decode($response);
            foreach ($objeto as $reg){
                echo json_encode($reg);
                //echo json_encode($objeto);
                $verificar = regionModel::where('region',$reg->region)->first();
                if(!$verificar)
                    $nuevaRegion = new regionModel();

                $nuevaRegion->region = $reg->region;
                $nuevaRegion->country = $reg->country;
                $nuevaRegion->save();
            }
        }
    }
    public function obtenerRegionPais($pais){
        $regionPais = regionModel :: where('country',$pais)->get();
        return ['Pais' => $regionPais];
    }
    public function obtenerRegionNombre($nombre){
        $regionNombre = regionModel :: where('region',$nombre)->get();
        return ['Region' => $regionNombre];
    }
}
