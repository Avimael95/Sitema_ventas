<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    // se deberia poner pero como ya la clase se llama Categoria laravel asume que se la tabla se llama categorias
    //protected $table ='categorias';
    //tampoco ponemos el id por que laravel asu que el campo se llama asi id
    //protected $primaryKey="id";
    protected $fillable=['nombre','descripcion','condicion'];

    //Creating the relationship between the article from one to many
    public function articulos()
    {
        return $this->hasMany('App\Articulo');
    }
}
