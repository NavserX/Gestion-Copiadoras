<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reparacion;
use Illuminate\Http\Request;

class ReparacionController extends Controller
{
    /**
     * GET: Listo todas las reparaciones con sus relaciones.
     */
    public function index()
    {
        // Uso eager loading (with) para traer los nombres de marca, tecnico y cliente
        return Reparacion::with(['marca', 'tecnico', 'cliente'])->get();
    }

    /**
     * POST: Creo una nueva reparación.
     */
    public function store(Request $request)
    {
        // Validamos que los IDs enviados existan en sus respectivas tablas
        $request->validate([
            'marca_id'    => 'required|exists:marcas,id',
            'tecnico_id'  => 'required|exists:tecnicos,id',
            'cliente_id'  => 'required|exists:clientes,id',
            'descripcion' => 'required|string',
            'estado'      => 'nullable|string'
        ]);

        $reparacion = Reparacion::create($request->all());

        return response()->json([
            'mensaje' => 'Reparación registrada con éxito',
            'datos'   => $reparacion->load(['marca', 'tecnico', 'cliente'])
        ], 201);
    }

    /**
     * GET {id}: Con esto creo una reparación específica.
     */
    public function show($id)
    {
        return Reparacion::with(['marca', 'tecnico', 'cliente'])->findOrFail($id);
    }

    /**
     * PUT {id}: Actualizo una reparación.
     */
    public function update(Request $request, $id)
    {
        $reparacion = Reparacion::findOrFail($id);
        $reparacion->update($request->all());

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
        $reparacion = Reparacion::findOrFail($id);
        $reparacion->delete();

        return response()->json(['mensaje' => 'Reparación eliminada']);
    }
}
