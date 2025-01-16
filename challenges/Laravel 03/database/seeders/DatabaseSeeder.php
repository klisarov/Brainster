<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        DB::table('users')->insert([
            'email' => 'admin@brainster.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Create projects
        $projects = [
            [
                'name' => 'Wilderman-Adams',
                'subtitle' => 'Focused content-based',
                'image' => '/images/project1.jpg',
                'url' => 'https://example.com',
                'description' => 'Ad molestias sit reprehenderit voluptatem rerum voluptatem natus. Et vel voluptatem qui provident.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Vandervort-Rolfson',
                'subtitle' => 'Robust analyzing forecast',
                'image' => '/images/project2.jpg',
                'url' => 'https://example.com',
                'description' => 'Accusantium et porro recusandae ad sapiente ex vel. Debitis aut voluptas doloremque labore in et.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Schimmel, Stiedemann and Pollich',
                'subtitle' => 'Persistent discrete firmware',
                'image' => '/images/project3.jpg',
                'url' => 'https://example.com',
                'description' => 'Eum aliquam doloremque quae nobis. Ut inventore sit qui magni eos ipsum beatae.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Pagac-Feeney',
                'subtitle' => 'Customer-focused demand-driven leverage',
                'image' => '/images/project4.jpg',
                'url' => 'https://example.com',
                'description' => 'Ad nisi dolorem et a aspernatur. Aut odit iusto est quos doloremque recusandae consequatur.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Kuhn-Sawayn',
                'subtitle' => 'Intuitive object-oriented policy',
                'image' => '/images/project5.jpg',
                'url' => 'https://example.com',
                'description' => 'Qui temporibus ipsum iusto quis ut. Iusto est consequatur enim eum rem error laborum.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Gutmann Ltd',
                'subtitle' => 'Future-proofed heuristic monitoring',
                'image' => '/images/project6.jpg',
                'url' => 'https://example.com',
                'description' => 'Facere sed magni qui autem ut. Iusto omnis animi provident quia blanditis omnis ducimus.',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($projects as $project) {
            DB::table('projects')->insert($project);
        }
    }
}