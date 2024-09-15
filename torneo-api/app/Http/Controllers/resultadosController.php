<?php

namespace App\Http\Controllers;

use App\Models\partido;
use App\Models\resultado;
use Exception;
use Illuminate\Http\Request;

class resultadosController extends Controller
{
    public function index(){
        $resultados = resultado::all();

        return response()->json([
            'message' => 'Lista de resultados',
            'data' => $resultados
        ], 200);
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
          
                'id_partido' => 'required',
                'goles_equipo_1' => 'required',
                'goles_equipo_2' => 'required',
                
                
                
              
            ]);

            $resultado = new resultado();
            $resultado->goles_equipo_1 = $request->goles_equipo_1;
            $resultado->goles_equipo_2 = $request->goles_equipo_2;
          
            $resultado->id_partido = $request->id_partido;
            if($request->goles_equipo_1 > $request->goles_equipo_2){

                $partido = partido::find($request->id_partido);
                $resultado->ganador = $partido->equipo1->id;
            }
            else{

                $partido = partido::find($request->id_partido);
                $resultado->ganador = $partido->equipo2->id;
            }
         

            
           

           
            $resultado->save();
            return response()->json(['mensaje' => 'Resultado registrado con éxito']);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Error al registrar el resultado: ' . $error->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
               
                'id_partido' => 'required',
                'goles_equipo_1' => 'required',
                'goles_equipo_2' => 'required',
                
               
            ]);
            if(!resultado::find($id)){
                return response()->json(['mensaje'=> 'El id del resultado ingresado no existe'], 500);
            }

            $resultado = resultado::find($id);
            $resultado->goles_equipo_1 = $request->goles_equipo_1;
            $resultado->goles_equipo_2 = $request->goles_equipo_2;
          
            $resultado->id_partido = $request->id_partido;
            if($request->goles_equipo_1 > $request->goles_equipo_2){

                $partido = partido::find($request->id_partido);
                $resultado->ganador = $partido->equipo1->id;
            }
            else{

                $partido = partido::find($request->id_partido);
                $resultado->ganador = $partido->equipo2->id;
            }

            
           

           
            $resultado->save();
            return response()->json(['mensaje' => 'Datos del resultado actualizados con éxito'],200);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Error al actualizar los datos del resultado: ' . $error->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
       try{
        if(!resultado::find($id)){
            return response()->json(['mensaje' => 'El id del resultado ingresado no existe'], 500);
        }
        resultado::find($id)->delete();
        return response()->json(['mensaje' => 'Resultado eliminado con éxito'], 200);
       }
       catch (Exception $error) {
        return response()->json([
            'message' => 'Error al eliminar al resultado: ' . $error->getMessage()
        ], 500);
    }
    }

    public function show($id) {
        try{
            if(!resultado::find($id)){
                return response()->json(['mensaje' => 'El id del resultado ingresado no existe'], 500);
            }
            $resultado = resultado::find($id);

            return response()->json([
                'message' => 'Resultado encontrado exitosamente',
                'data' => $resultado,
                'ganador' => $resultado->vencedor->nombre
            ], 200);
            
           }
           catch (Exception $error) {
            return response()->json([
                'message' => 'Error al buscar al resultado: ' . $error->getMessage()
            ], 500);
        }
    }
}
