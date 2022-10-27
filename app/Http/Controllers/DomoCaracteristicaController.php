<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caracteristica;
use App\Models\Domo;
use App\Models\DomoCaracteristica;
use DB;

class DomoCaracteristicaController extends Controller
{
    public function index(){
        $caracteristicas = Caracteristica::all(); 
        //Retornamos utiliizando compact, ára retornar un array de variables con sus valores
        return view('domocaracteristica.index', compact('caracteristicas')); 
    }

    public function save(Request $request){

            $input = $request->all();
            try{ 
                DB::beginTransaction();
            $domo = Domo::create([
                
                "nombre"=>$input["nombre"],
                "descripcion"=>$input["descripcion"],
                "capacidad"=>$input["capacidad"],
                "numerobaños"=>$input["numerobaños"],
                "tipodomo"=>$input["tipodomo"],
                "estado"=>1
            ]);

           foreach($input["caracteristica_id"] as $key => $value){
                DomoCaracteristica::create([
                    "caracteristica_id"=>$value,
                    "domo_id"=>$domo->id,
                    "cantidad"=>$input["cantidades"][$key]
                ]);

                 $ins = Caracteristica::find($value);
                $ins->update(["cantidad"=> $ins->cantidad - $input["cantidades"][$key]]); 
            }

                DB::commit();
                return redirect("/domo/listar")->with('status', '1');
        }catch(\Exception $e){

                 DB::rollBack();

                return redirect("/domo/listar")->with('status', $e->getMessage()); 

        }

    }

    public function show(Request $request){

        $id = $request->input("id");
        $caracteristicas = [];
        if($id != null){
            $caracteristicas = Caracteristica::select("caracteristica.*", "domo_caracteristica.cantidad as cantidad_c")
            ->join("domo_caracteristica", "caracteristica.id", "=", "domo_caracteristica.caracteristica_id")
            ->where("domo_caracteristica.domo_id", $id)
            ->get();
        }
        
        $domos = Domo::select("domo.*")->get();

        return view("domocaracteristica.show", compact('domos', 'caracteristicas'));
    }
}



