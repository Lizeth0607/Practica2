<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\paisModel;

class paisController extends Controller
{
    public function mostrarPaises(){
        $curl = curl_init(); 

        curl_setopt_array($curl, [
            CURLOPT_URL => "http://battuta.medunes.net/api/country/all/?key=7b6ed3d77be4dd5b5d8b5670b8f4d155",
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
            foreach ($objeto as $pais){
                echo json_encode($pais);
                //echo json_encode($objeto);
                $verificar = paisModel::where('name',$pais->name)->first();
                if(!$verificar)
                    $nuevoPais = new paisModel();

                $nuevoPais->name = $pais->name;
                $nuevoPais->id = $pais->code;
              

                $nuevoPais->save();
            }
        }
    }
    public function obtenerPaisId($id){
        $paisId = paisModel :: where('id', $id)->get();
        return ['pais'=>$paisId];
    }
    public function obtenerPaisNombre($nombre){
        $paisNombre = paisModel :: where('name', $nombre)->get();
        return ['pais'=>$paisNombre];
    }
}
