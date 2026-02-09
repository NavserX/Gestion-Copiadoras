<?php

// Defino el espacio de nombres donde se encuentra este controlador (API)
namespace App\Http\Controllers\Api;

// Importo el controlador base de Laravel
use App\Http\Controllers\Controller;

// Importo el modelo Reparacion para poder trabajar con la tabla reparaciones
use App\Models\Reparacion;

// Importo Request para manejar los datos que llegan por petición HTTP
use Illuminate\Http\Request;

// Creo el controlador ReparacionController que hereda del controlador base
class ReparacionController extends Controller
{
    /**
     * GET: Listo todas las reparaciones con sus relaciones.
     */
    public function index()
    {
        // Obtengo todas las reparaciones y cargo sus relaciones:
        // marca, técnico y cliente
        return Reparacion::with(['marca', 'tecnico', 'cliente'])->get();
    }

    /**
     * POST: Creo una nueva reparación.
     */
    public function store(Request $request)
    {
        // Valido los datos que llegan por la petición
        // Compruebo que los IDs existan en sus tablas correspondientes
        // y que la descripción sea un texto obligatorio
        $request->validate([
            'marca_id'    => 'required|exists:marcas,id',
            'tecnico_id'  => 'required|exists:tecnicos,id',
            'cliente_id'  => 'required|exists:clientes,id',
            'descripcion' => 'required|string',
            'estado'      => 'nullable|string'
        ]);

        // Creo la reparación usando todos los datos recibidos
        $reparacion = Reparacion::create($request->all());

        // Devuelvo una respuesta JSON indicando que todo ha ido bien
        // y cargo también las relaciones asociadas a la reparación
        return response()->json([
            'mensaje' => 'Reparación registrada con éxito',
            'datos'   => $reparacion->load(['marca', 'tecnico', 'cliente'])
        ], 201);
    }

    /**
     * GET {id}: Muestro una reparación concreta.
     */
    public function show($id)
    {
        // Busco una reparación por su ID
        // Si no existe, Laravel devuelve un error automáticamente
        // También cargo sus relaciones asociadas
        return Reparacion::with(['marca', 'tecnico', 'cliente'])->findOrFail($id);
    }

    /**
     * PUT {id}: Actualizo una reparación.
     */
    public function update(Request $request, $id)
    {
        // Busco la reparación que quiero actualizar
        $reparacion = Reparacion::findOrFail($id);

        // Actualizo la reparación con los datos recibidos
        $reparacion->update($request->all());

        // Devuelvo un mensaje confirmando la actualización
        return response()->json([
            'mensaje' => 'Reparación actualizada',
            'datos'   => $reparacion
        ]);
    }

    /**
     * DELETE {id}: Elimino un registro.
     */
    public function destroy($id)
    {
        // Busco la reparación por su ID
        $reparacion = Reparacion::findOrFail($id);

        // Elimino la reparación de la base de datos
        $reparacion->delete();

        // Devuelvo un mensaje confirmando la eliminación
        return response()->json(['mensaje' => 'Reparación eliminada']);
    }
}
