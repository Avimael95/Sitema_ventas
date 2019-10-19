<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulo;

class ArticuloController extends Controller
{
    public function index(Request $request)
    {
        // $articulos = Articulo::all();
        // return $articulos;
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         if ($buscar=='') {
            $articulos = Articulo::join('categorias','articulos.idcategoria','=','categorias.id')
            ->select('articulos.id','articulos.idcategoria','articulos.codigo','articulos.nombre','categorias.nombre as nombre_categoria','articulos.precio_venta','articulos.stock','articulos.descripcion','articulos.condicion')
            -> orderBy('articulos.id','desc')->paginate(5);
        } else {
            $articulos = Articulo::join('categorias','articulos.idcategoria','=','categorias.id')
            ->select('articulos.id','articulos.idcategoria','articulos.codigo','articulos.nombre','categorias.nombre as nombre_categoria','articulos.precio_venta','articulos.stock','articulos.descripcion','articulos.condicion')
            ->where('articulos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('articulos.id', 'desc')->paginate(5);
          
        }

        // retornarmos todos los atributos del paginador
        return [
            'pagination'=>[
                'total' => $articulos->total(),
                'current_page'=>$articulos->currentPage(),
                'per_page' => $articulos->perPage(),
                'last_page' => $articulos->lastPage(),
                'from'=>$articulos->firstItem(),
                'to'=>$articulos->lastItem(),
            ],
            'articulos'=>$articulos
        ];
    }
    
   
    public function store(Request $request)
    {
        $articulo = new Articulo();
        $articulo->idcategoria = $request->idcategoria;
        $articulo->codigo = $request->codigo;
        $articulo->nombre = $request->nombre;
        $articulo->precio_venta = $request->precio_venta;
        $articulo->stock = $request->stock;
        $articulo->descripcion = $request->descripcion;
        $articulo->condicion = '1';
        $articulo->save();
      
    }

    public function update(Request $request)
    {
        $articulo = Articulo::findOrFail($request->id);
        $articulo->idcategoria = $request->idcategoria;
        $articulo->codigo = $request->codigo;
        $articulo->nombre = $request->nombre;
        $articulo->precio_venta = $request->precio_venta;
        $articulo->stock = $request->stock;
        $articulo->descripcion = $request->descripcion;
        $articulo->condicion = '1';
        $articulo->save();
    }


   
    public function desactivar(Request $request)
    {
        $articulo = Articulo::findOrfail($request->id);
        $articulo->condicion = '0';
        $articulo->save();

    }

    public function activar(Request $request)
    {
        $articulo = Articulo::findOrfail($request->id);
        $articulo->condicion = '1';
        $articulo->save();
    }
}
