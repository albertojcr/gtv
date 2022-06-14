<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'Administrador']);
        $teacherRole = Role::create(['name' => 'Profesor']);
        $studentRole = Role::create(['name' => 'Alumno']);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        $admin->assignRole($adminRole);

        $teacher = User::create([
            'name' => 'Teacher',
            'email' => 'teacher@mail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        $teacher->assignRole($teacherRole);

        $student = User::create([
            'name' => 'Student',
            'email' => 'student@mail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        $student->assignRole($studentRole);
    }
}
