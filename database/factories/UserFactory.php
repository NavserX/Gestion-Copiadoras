<?php

// Defino el espacio de nombres de las factories
namespace Database\Factories;

// Importo la clase base Factory
use Illuminate\Database\Eloquent\Factories\Factory;

// Importo Hash para cifrar la contraseña
use Illuminate\Support\Facades\Hash;

// Importo Str para generar cadenas aleatorias
use Illuminate\Support\Str;

/**
 * Indico que esta factory está asociada al modelo User
 */
class UserFactory extends Factory
{
    /**
     * Guardo la contraseña que se va a reutilizar
     * para no cifrarla en cada creación
     */
    protected static ?string $password;

    /**
     * Defino el estado por defecto del modelo User.
     * Aquí establezco los datos falsos que se usarán
     * cuando se cree un usuario de prueba.
     */
    public function definition(): array
    {
        return [
            // Genero un nombre aleatorio
            'name' => fake()->name(),

            // Genero un email único y seguro
            'email' => fake()->unique()->safeEmail(),

            // Marco el email como verificado
            'email_verified_at' => now(),

            // Cifro la contraseña solo una vez y la reutilizo
            'password' => static::$password ??= Hash::make('password'),

            // Genero un token aleatorio para "recordarme"
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Defino un estado adicional para usuarios no verificados.
     * Pongo el campo email_verified_at a null.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
