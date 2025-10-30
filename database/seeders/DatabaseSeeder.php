<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Application;
use App\Models\Role;
use App\Models\User;
use App\Models\Department;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // roles
        $super = Role::firstOrCreate(
            ['name' => 'superadmin'],
            ['label' => 'Super Administrator']
        );
        $it = Role::firstOrCreate(
            ['name' => 'it-admin'],
            ['label' => 'Administrator TI']
        );
        $hr = Role::firstOrCreate(
            ['name' => 'hr'],
            ['label' => 'Human Resource']
        );
        $staff = Role::firstOrCreate(
            ['name' => 'karyawan'],
            ['label' => 'Karyawan']
        );

        // departemen
        $depIt = Department::firstOrCreate(['name' => 'IT', 'code' => 'IT']);
        $depHr = Department::firstOrCreate(['name' => 'Human Resource', 'code' => 'HR']);

        // user superadmin
        $user = User::firstOrCreate(
            ['email' => 'superadmin@company.test'],
            [
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'password' => Hash::make('password'),
                'department_id' => $depIt->id,
            ]
        );

        // attach role
        $user->roles()->sync([$super->id]);

        // aplikasi
        Application::firstOrCreate([
            'slug' => 'hris',
        ], [
            'name' => 'HRIS',
            'url' => 'https://hris.company.test',
            'icon' => 'bi-people-fill',
            'active' => true,
        ]);

        Application::firstOrCreate([
            'slug' => 'eoffice',
        ], [
            'name' => 'E-Office',
            'url' => 'https://eoffice.company.test',
            'icon' => 'bi-building-fill',
            'active' => true,
        ]);

        Application::firstOrCreate([
            'slug' => 'elp',
        ], [
            'name' => 'E-Learning Perusahaan',
            'url' => 'https://elp.company.test',
            'icon' => 'bi-mortarboard-fill',
            'active' => true,
        ]);
    }
}
