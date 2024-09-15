<?php

namespace App\Http\Controllers;

use App\Models\partido;
use Exception;
use Illuminate\Http\Request;

class partidosController extends Controller
{
    public function index(){
        $partidos = partido::all();

        return response()->json([
            'message' => 'Lista de partidos',
            'data' => $partidos
        ], 200);
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
          
                'id_equipo1' => 'required',
                'id_equipo2' => 'required',
                'fecha' => 'required',
                'lugar' => 'required',
                
              
            ]);

            $partido = new partido();
            $partido->id_equipo1 = $request->id_equipo1;
            $partido->id_equipo2 = $request->id_equipo2;
          
            $partido->fecha = $request->fecha;
            $partido->lugar = $request->lugar;
            $partido->id_estado = 1;

            
           

           
            $partido->save();
            return response()->json(['mensaje' => 'Partido registrado con éxito']);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Error al registrar el partido: ' . $error->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
               
                'id_equipo1' => 'required',
                'id_equipo2' => 'required',
                'fecha' => 'required',
                'lugar' => 'required',
               
            ]);
            if(!partido::find($id)){
                return response()->json(['mensaje'=> 'El id del partido ingresado no existe'], 500);
            }

            $partido = partido::find($id);
            $partido->id_equipo1 = $request->id_equipo1;
            $partido->id_equipo2 = $request->id_equipo2;
            
            $partido->fecha = $request->fecha;
            $partido->lugar = $request->lugar;
            if(isset($request->id_estado)){
                $partido->id_estado = $request->id_estado;
            }

            
           

           
            $partido->save();
            return response()->json(['mensaje' => 'Datos del partido actualizados con éxito'],200);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Error al actualizar los datos del partido: ' . $error->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
       try{
        if(!partido::find($id)){
            return response()->json(['mensaje' => 'El id del partido ingresado no existe'], 500);
        }
        partido::find($id)->delete();
        return response()->json(['mensaje' => 'Partido eliminado con éxito'], 200);
       }
       catch (Exception $error) {
        return response()->json([
            'message' => 'Error al eliminar al partido: ' . $error->getMessage()
        ], 500);
    }
    }

    public function show($id) {
        try{
            if(!partido::find($id)){
                return response()->json(['mensaje' => 'El id del partido ingresado no existe'], 500);
            }
            $partido = partido::find($id);

            return response()->json([
                'message' => 'Partido encontrado exitosamente',
                'data' => $partido,
                'equipo1' => $partido->equipo1->nombre,
                'equipo2' => $partido->equipo2->nombre
            ], 200);
            
           }
           catch (Exception $error) {
            return response()->json([
                'message' => 'Error al buscar al partido: ' . $error->getMessage()
            ], 500);
        }
    }
}
