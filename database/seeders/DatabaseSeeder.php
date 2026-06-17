<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ini mangggil seeder role
        $this->call([
            RolePermissionSeeder::class,
        ]);
        // ini buat user yaitu admin
        $admin = User::create([

            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),

            'nip' => '123456789',
            'phone' => '08123456789',
            'address' => 'Jakarta',

        ]);
        $gurusatu = User::create([

            'name' => 'guru satu',
            'email' => 'guru@gmail.com',
            'password' => Hash::make('admin123'),

            'nip' => '1234567',
            'phone' => '08123456789',
            'address' => 'Jakarta',

        ]);
        $kepala = User::create([

            'name' => 'kepala sekoalh',
            'email' => 'kepsek@gmail.com',
            'password' => Hash::make('admin123'),

            'nip' => '1234562127',
            'phone' => '08123456789',
            'address' => 'Jakarta',

        ]);
        // ini buat beri role
        $admin->assignRole('Super Admin');
        $gurusatu->assignRole('Guru');
        $kepala->assignRole('Kepala Sekolah');

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Admin Test',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('admin123'),
        //     'nip' => '123456789',
        //     'phone' => '123456789',
        //     'address' => 'jakarta',
        // ]);

        $this->call([
            SubjectSeeder::class,
        ]);
    }
}