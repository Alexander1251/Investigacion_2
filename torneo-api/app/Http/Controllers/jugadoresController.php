<?php

namespace App\Http\Controllers;

use App\Models\equipo;
use App\Models\jugador;
use Exception;
use Illuminate\Http\Request;

class jugadoresController extends Controller
{

    public function index(){
        $jugadores = jugador::all();

        return response()->json([
            'message' => 'Lista de jugadores',
            'data' => $jugadores
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombres' => 'required',
                'apellidos' => 'required',
                'sexo' => 'required',
                'edad' => 'required',
                'id_equipo' => 'required'
            ]);

            $jugador = new jugador();
            $jugador->nombres = $request->nombres;
            $jugador->apellidos = $request->apellidos;
            $jugador->sexo = $request->sexo;
            $jugador->edad = $request->edad;
            if(sizeof(jugador::where('id_equipo', $request->id_equipo)->get()) > 8){
                return response()->json(['mensaje', 'El equipo no puede contener más de 8 jugadores'], 500);

            }

            if (!equipo::find($request->id_equipo)) {
                return response()->json(['mensaje', 'El equipo ingresado no existe'], 200);
            } else {
                $jugador->id_equipo = $request->id_equipo;
            }
            $jugador->save();
            return response()->json(['mensaje', 'Jugador registrado con éxito']);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Error al registrar el jugador: ' . $error->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                
                'nombres' => 'required',
                'apellidos' => 'required',
                'sexo' => 'required',
                'edad' => 'required',
                'id_equipo' => 'required'
            ]);
            if(!jugador::find($id)){
                return response()->json(['mensaje', 'El id del jugador ingresado no existe'], 500);
            }

            $jugador = jugador::find($id);
            $jugador->nombres = $request->nombres;
            $jugador->apellidos = $request->apellidos;
            $jugador->sexo = $request->sexo;
            $jugador->edad = $request->edad;

            if (!equipo::find($request->id_equipo)) {
                return response()->json(['mensaje', 'El equipo ingresado no existe'], 500);
            } else {
                $jugador->id_equipo = $request->id_equipo;
            }
            $jugador->save();
            return response()->json(['mensaje', 'Datos del jugador actualizados con éxito'],200);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Error al actualizar los datos del jugador: ' . $error->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
       try{
        if(!jugador::find($id)){
            return response()->json(['mensaje', 'El id del jugador ingresado no existe'], 500);
        }
        jugador::find($id)->delete();
        return response()->json(['mensaje', 'Jugador eliminado con éxito'], 200);
       }
       catch (Exception $error) {
        return response()->json([
            'message' => 'Error al eliminar al jugador: ' . $error->getMessage()
        ], 500);
    }
    }

    public function show($id) {
        try{
            if(!jugador::find($id)){
                return response()->json(['mensaje', 'El id del jugador ingresado no existe'], 500);
            }
            $jugador = jugador::find($id);

            return response()->json([
                'message' => 'Jugador encontrado exitosamente',
                'data' => $jugador
            ], 200);
            
           }
           catch (Exception $error) {
            return response()->json([
                'message' => 'Error al buscar al jugador: ' . $error->getMessage()
            ], 500);
        }
    }
}
