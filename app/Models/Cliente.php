<?php

// Defino el espacio de nombres del modelo
namespace App\Models;

// Importo el modelo base de Eloquent
use Illuminate\Database\Eloquent\Model;

// Creo el modelo Cliente que representa la tabla clientes
class Cliente extends Model
{
    // Indico explícitamente el nombre de la tabla asociada al modelo
    protected $table = 'clientes';

    // Defino los campos que se pueden rellenar de forma masiva
    // Esto me permite usar create() y update() de forma segura
    protected $fillable = ['nombre', 'empresa', 'email'];
}
