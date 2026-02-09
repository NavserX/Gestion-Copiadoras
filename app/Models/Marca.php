<?php

// Defino el espacio de nombres del modelo
namespace App\Models;

// Importo el modelo base de Eloquent
use Illuminate\Database\Eloquent\Model;

// Creo el modelo Marca que representa la tabla marcas
class Marca extends Model
{
    // Indico el nombre de la tabla asociada a este modelo
    protected $table = 'marcas';

    // Defino los campos que se pueden rellenar de forma masiva
    // Esto permite crear y actualizar marcas usando create() o update()
    protected $fillable = ['nombre'];
}
