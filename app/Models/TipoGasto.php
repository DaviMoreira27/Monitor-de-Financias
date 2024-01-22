<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoGasto extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */

    protected $table = 'tipo_gasto';
    protected $primaryKey = 'idTipoGasto';
    protected $fillable = ['nomeGasto', 'tipoGasto'];
}
