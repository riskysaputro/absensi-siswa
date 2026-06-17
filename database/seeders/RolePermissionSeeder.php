<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolePermissionSeeder extends Seeder
{

    public function run()
    {


        $permissions = [

            // 'manage users',
            // 'manage students',
            // 'manage classes',
            // 'manage subjects',
            // 'manage schedules',
            // 'take attendance',
            // 'view reports',
            'kelola pengguna',
            'kelola siswa',
            'kelola kelas',
            'kelola mata pelajaran',
            'kelola jadwal',
            'kelola absensi',
            'lihat laporan',
            'kelola hak akses',

        ];


        foreach ($permissions as $permission) {

            Permission::create([
                'name' => $permission
            ]);
        }



        $superAdmin = Role::create([
            'name' => 'Super Admin'
        ]);


        $kepala = Role::create([
            'name' => 'Kepala Sekolah'
        ]);


        $guru = Role::create([
            'name' => 'Guru'
        ]);



        $superAdmin->givePermissionTo(
            Permission::all()
        );


        $kepala->givePermissionTo([

            'lihat laporan',

        ]);



        $guru->givePermissionTo([

            'kelola absensi',
            'lihat laporan',

        ]);
    }
}
