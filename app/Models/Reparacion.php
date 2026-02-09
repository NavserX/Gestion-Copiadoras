<?php

// Defino el espacio de nombres del modelo
namespace App\Models;

// Importo el modelo base de Eloquent
use Illuminate\Database\Eloquent\Model;

// Creo el modelo Reparacion que representa la tabla reparaciones
class Reparacion extends Model
{
    // Indico el nombre de la tabla asociada al modelo
    protected $table = 'reparaciones';

    // Defino los campos que se pueden rellenar de forma masiva
    // Incluyo las claves foráneas y los datos propios de la reparación
    protected $fillable = [
        'marca_id',
        'tecnico_id',
        'cliente_id',
        'descripcion',
        'estado'
    ];

    // Defino la relación con la tabla marcas
    // Una reparación pertenece a una única marca
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    // Defino la relación con la tabla tecnicos
    // Una reparación pertenece a un único técnico
    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class);
    }

    // Defino la relación con la tabla clientes
    // Una reparación pertenece a un único cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
