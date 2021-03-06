<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CestaTicket extends Model
{
    //tabla
    protected $table = 'cesta_ticket';

    // campos create_at update_at
    public $timestamps = false;

    // campos que se pueden ingresar y modificar
    protected $fillable = [
    	'cantidad', 'unidad_tributaria', 'estatus'
    ];
}
