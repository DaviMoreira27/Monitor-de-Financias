<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GastosMes extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idGasto';
    protected $fillable = ['idFinancias', 'idTipoGasto', 'valorGasto'];

    public function FinanciasMes(){
        return $this->belongsTo(FinanciasMes::class);
    }

    public function TipoGasto(){
        return $this->belongsTo(TipoGasto::class);
    }
}
