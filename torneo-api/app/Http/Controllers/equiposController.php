<?php

namespace App\Http\Controllers;

use App\Models\equipo;
use Exception;
use Illuminate\Http\Request;

class equiposController extends Controller
{
    public function index(){
        $equipos = equipo::all();

        return response()->json([
            'message' => 'Lista de equipos',
            'data' => $equipos
        ], 200);
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required',
              
            ]);

            $equipo = new equipo();
            $equipo->nombre = $request->nombre;

            
           

           
            $equipo->save();
            return response()->json(['mensaje' => 'Equipo registrado con éxito']);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Error al registrar el equipo: ' . $error->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                
                'nombre' => 'required',
               
            ]);
            if(!equipo::find($id)){
                return response()->json(['mensaje'=> 'El id del equipo ingresado no existe'], 500);
            }

            $equipo = equipo::find($id);
            $equipo->nombre = $request->nombre;
    

            
            $equipo->save();
            return response()->json(['mensaje' => 'Datos del equipo actualizados con éxito'],200);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Error al actualizar los datos del equipo: ' . $error->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
       try{
        if(!equipo::find($id)){
            return response()->json(['mensaje' => 'El id del equipo ingresado no existe'], 500);
        }
        equipo::find($id)->delete();
        return response()->json(['mensaje' => 'equipo eliminado con éxito'], 200);
       }
       catch (Exception $error) {
        return response()->json([
            'message' => 'Error al eliminar al equipo: ' . $error->getMessage()
        ], 500);
    }
    }

    public function show($id) {
        try{
            if(!equipo::find($id)){
                return response()->json(['mensaje' => 'El id del equipo ingresado no existe'], 500);
            }
            $equipo = equipo::find($id);

            return response()->json([
                'message' => 'equipo encontrado exitosamente',
                'data' => $equipo,
                'jugadores' => $equipo->jugadores
            ], 200);
            
           }
           catch (Exception $error) {
            return response()->json([
                'message' => 'Error al buscar al equipo: ' . $error->getMessage()
            ], 500);
        }
    }

    
}
