<?php

namespace Database\Seeders;

use App\Models\User;
use App\Traits\SeederTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    use SeederTrait;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => 1,
                'name' => 'Erick Gomez',
                'user' => 'Admin',
                'email' => 'desarrollador@gmail.com',
                'email_verified_at' => null,
                'password' => Hash::make('holamundo'),
                'rol' => 'admin',
                'remember_token' => Str::random(10),
                'status' => 'Activo',
                'created_at' => now(),
                'updated_at' => null,
            ],
        ];

        $this->createData($users, User::class, function (Builder $query, $value) {
            return $query->where('email', $value['email']);
        });
    }
}
