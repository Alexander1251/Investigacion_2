<?php

namespace App\Http\Controllers;

use App\Models\partido_estado;
use Exception;
use Illuminate\Http\Request;

class partidoEstadosController extends Controller
{
    public function index(){
        $partido_estados = partido_estado::all();

        return response()->json([
            'message' => 'Lista de estados',
            'data' => $partido_estados
        ], 200);
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'estado' => 'required',
              
            ]);

            $partido_estado = new partido_estado();
            $partido_estado->estado = $request->estado;

            
           

           
            $partido_estado->save();
            return response()->json(['mensaje' => 'Estado registrado con éxito']);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Error al registrar el estado: ' . $error->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                
                'estado' => 'required',
               
            ]);
            if(!partido_estado::find($id)){
                return response()->json(['mensaje'=> 'El id del estado ingresado no existe'], 500);
            }

            $partido_estado = partido_estado::find($id);
            $partido_estado->estado = $request->estado;
    

            
            $partido_estado->save();
            return response()->json(['mensaje' => 'Datos del estado actualizados con éxito'],200);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Error al actualizar los datos del estado: ' . $error->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
       try{
        if(!partido_estado::find($id)){
            return response()->json(['mensaje' => 'El id del estado ingresado no existe'], 500);
        }
        partido_estado::find($id)->delete();
        return response()->json(['mensaje' => 'Estado eliminado con éxito'], 200);
       }
       catch (Exception $error) {
        return response()->json([
            'message' => 'Error al eliminar al estado: ' . $error->getMessage()
        ], 500);
    }
    }

    public function show($id) {
        try{
            if(!partido_estado::find($id)){
                return response()->json(['mensaje' => 'El id del estado ingresado no existe'], 500);
            }
            $partido_estado = partido_estado::find($id);

            return response()->json([
                'message' => 'Estado encontrado exitosamente',
                'data' => $partido_estado
            ], 200);
            
           }
           catch (Exception $error) {
            return response()->json([
                'message' => 'Error al buscar al estado: ' . $error->getMessage()
            ], 500);
        }
    }
}
