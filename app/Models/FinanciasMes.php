<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\FinanciasMesFactory;

class FinanciasMes extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idFinancias';


    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return FinanciasMesFactory::new();
    }

    public function gastoMes(){
        return $this->hasMany(GastosMes::class);
    }

    public function User(){
        return $this->hasOne(User::class, 'id', 'idUser');
    }
}
