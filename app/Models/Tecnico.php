<?php

// Defino el espacio de nombres del modelo
namespace App\Models;

// Importo el modelo base de Eloquent
use Illuminate\Database\Eloquent\Model;

// Creo el modelo Tecnico que representa la tabla tecnicos
class Tecnico extends Model
{
    // Indico el nombre de la tabla asociada a este modelo
    protected $table = 'tecnicos';

    // Defino los campos que se pueden rellenar de forma masiva
    // Esto me permite crear y actualizar técnicos de forma segura
    protected $fillable = ['nombre', 'email'];
}
