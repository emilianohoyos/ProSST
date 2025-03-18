<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear el rol ADMIN si no existe
        $adminRole = Role::firstOrCreate(['name' => 'ADMIN']);

        // Crear el usuario administrador
        $adminUser = User::firstOrCreate(
            ['email' => 'emilianohoyos10@gmail.com'], // Cambia el correo si es necesario
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'email' => 'emilianohoyos10@gmail.com',
                'identification' => '123445',
                'password' => Hash::make('12345678'), // Cambia la contraseña según necesites
                'document_type_id' => 1, // Ajusta según tu BD
                'person_type_id' => 1, // Ajusta según tu BD
                'cellphone' => 'Colombia',
                'department' => 'Cundinamarca',
                'city' => 'Bogotá',
                'neighborhood' => 'Laureles',
                'address' => 'Calle 123 #45-67',
                'professional_card' => '564665456'
            ]
        );

        // Asignar el rol de ADMIN
        if (!$adminUser->hasRole('ADMIN')) {
            $adminUser->assignRole($adminRole);
        }

        $this->command->info('Usuario administrador creado con éxito.');
    }
}
