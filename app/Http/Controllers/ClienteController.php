<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        $critero=$request->criterio;

        if ($critero=='') {
            $Persona=Persona::orderBy('id','desc')->paginate(5);
        }else{
            $Persona=Persona::where($critero,'like','%'.$buscar.'%')->orderBy('id')->paginate(5);
        }
        return [
            'pagination'=>[
                'total' => $Persona->total(),
                'current_page'=>$Persona->currentPage(),
                'per_page' => $Persona->perPage(),
                'last_page' => $Persona->lastPage(),
                'from'=>$Persona->firstItem(),
                'to'=>$Persona->lastItem(),
            ],
            'Persona'=>$Persona
        ];
    }

    public function store(Request $request)
    {
        $Persona = new Persona();
        $Persona->nombre=$request->nombre;
        $Persona->tipo_documento=$request->tipo_documento;
        $Persona->num_documento=$request->num_documento;
        $Persona->direccion=$request->direccion;
        $Persona->telefono = $request->telefono;
        $Persona->email=$request->email;
        $Persona->save();
    }

    public function update(Request $request)
    {
        $Persona = Persona::findOrfail($request->id);
        $Persona->nombre=$request->nombre;
        $Persona->tipo_documento=$request->tipo_documento;
        $Persona->num_documento=$request->num_documento;
        $Persona->direccion=$request->direccion;
        $Persona->telefono = $request->telefono;
        $Persona->email=$request->email;
        $Persona->save();

    }

    public function delete(Request $request)
    {
        $Persona = Persona::findOrfail($request->id);
        $Persona->delete();
      }
}
