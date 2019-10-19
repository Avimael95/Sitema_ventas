<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $fillable=[
        'idcategoria',
        'codigo',
        'nombre',
        'precio_venta',
        'stock',
        'descripcion',
        'condicion'
    ];

    public function categoria(){
        // Definimos la relacion de uno a mucho inverso
        // una categoria tiene muchos articulos
        return $this->belongsTo('App\Categoria');
    }
}
