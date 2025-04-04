<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\Project;
use App\Models\Document;
use App\Models\Requirement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        $project = Project::create([
            'name' => 'Proyecto Ejemplo',
            'description' => 'Descripción del proyecto',
            'user_id' => $admin->id,
            'status' => 'active'
        ]);

        $requirement = Requirement::create([
            'project_id' => $project->id,
            'type' => 'funcional',
            'description' => 'El sistema debe permitir la autenticación de usuarios.',
            'priority' => 'alta',
            'status' => 'pendiente'
        ]);

        Comment::create([
            'requirement_id' => $requirement->id,
            'user_id' => $admin->id,
            'text' => 'Este requisito es crítico para el inicio del desarrollo.'
        ]);

        Document::create([
            'project_id' => $project->id,
            'format' => 'pdf',
            'content' => 'Documento generado automáticamente para el proyecto.'
        ]);
    }
}
