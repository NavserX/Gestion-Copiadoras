<?php

// Defino el espacio de nombres de los seeders
namespace Database\Seeders;

// Importo el modelo User (aunque en este seeder no lo uso directamente, pero lo he visto en otros ejemplos y lo dejo por si acaso)
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Creo el seeder principal de la aplicación
class DatabaseSeeder extends Seeder
{
    // Uso el trait WithoutModelEvents para evitar que se lancen eventos
    // mientras se insertan los datos de prueba
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Inserto las marcas
        // Cada marca solo necesita el nombre
        \App\Models\Marca::create(['nombre' => 'Konica']);
        \App\Models\Marca::create(['nombre' => 'HP']);
        \App\Models\Marca::create(['nombre' => 'Sharp']);

        // 2. Inserto los técnicos
        // Creo varios técnicos con su nombre y email
        \App\Models\Tecnico::create([
            'nombre' => 'Sergio Navarro',
            'email'  => 'sergio@od.com'
        ]);

        \App\Models\Tecnico::create([
            'nombre' => 'Jose Cabrera',
            'email'  => 'jose@od.com'
        ]);

        \App\Models\Tecnico::create([
            'nombre' => 'Alfonso Campos',
            'email'  => 'alfonso@od.com'
        ]);

        // 3. Inserto los clientes
        // Uso un bucle para crear varios clientes de prueba
        // Me aseguro de usar el modelo correcto: \App\Models\Cliente
        for ($i = 1; $i <= 10; $i++) {
            \App\Models\Cliente::create([
                'nombre'  => "Cliente $i",
                'empresa' => "Empresa S.A. $i",
                'email'   => "contacto$i@cliente.com"
            ]);
        }
    }
}
