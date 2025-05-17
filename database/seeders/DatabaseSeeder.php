<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use App\Models\Reimbursement;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // Seed departments
        Department::create([
            'nama_departemen' => 'HR',
            'deskripsi' => 'Human Resources Department'
        ]);

        Department::create([
            'nama_departemen' => 'FINANCE',
            'deskripsi' => 'Finance Department'
        ]);

        Department::create([
            'nama_departemen' => 'IT',
            'deskripsi' => 'Information Technology Department'
        ]);

        Department::create([
            'nama_departemen' => 'MARKETING',
            'deskripsi' => 'Marketing Department'
        ]);

        Department::create([
            'nama_departemen' => 'COURIER',
            'deskripsi' => 'Courier Department'
        ]);

        // Seed positions
        Position::create([
            'nama_jabatan' => 'HR Manager',
            'deskripsi' => 'Manager of HR Department'
        ]);

        Position::create([
            'nama_jabatan' => 'HR Officer',
            'deskripsi' => 'Officer of HR Department'
        ]);

        Position::create([
            'nama_jabatan' => 'Finance Manager',
            'deskripsi' => 'Manager of Finance Department'
        ]);

        Position::create([
            'nama_jabatan' => 'Finance Officer',
            'deskripsi' => 'Officer of Finance Department'
        ]);

        Position::create([
            'nama_jabatan' => 'Programmer',
            'deskripsi' => 'IT Programmer'
        ]);

        Position::create([
            'nama_jabatan' => 'Marketing Officer',
            'deskripsi' => 'Marketing Officer'
        ]);

        Position::create([
            'nama_jabatan' => 'Courier',
            'deskripsi' => 'Courier'
        ]);

        // Seed Pegawai
        User::create([
            'NIP' => '083128734012',
            'nama' => 'Arif Febrianto',
            'id_jabatan' => 5,
            'id_departemen' => 3,
            'telepon' => '083128734012',
            'alamat' => 'Jl. Mangga Besar 7',
            'email' => 'arif@jasanet.co.id',
            'password' => bcrypt('jasanet@123')
        ]);

        // User::create([
        //     'NIP' => '085894711377',
        //     'nama' => 'Erna Safitri',
        //     'id_jabatan' => 6,
        //     'id_departemen' => 4,
        //     'telepon' => '085894711377',
        //     'alamat' => 'Jl. HR Boulevard No. 2',
        //     'email' => 'ratih@marketing.com',
        //     'password' => bcrypt('password')
        // ]);

        //seed HR Manager
        User::create([
            'NIP' => '0818848665',
            'nama' => 'Hendra Susanto',
            'id_jabatan' => 1,
            'id_departemen' => 1,
            'telepon' => '0818848665',
            'alamat' => '-',
            'email' => 'sales@jasanet.co.id',
            'password' => bcrypt('jsnc225m2m'),
        ]);

        //seed Finance Manager
        User::create([
            'NIP' => '081559948888',
            'nama' => 'Yanti',
            'id_jabatan' => 3,
            'id_departemen' => 2,
            'telepon' => '081559948888',
            'alamat' => '-',
            'email' => 'yanti@jasanet.co.id',
            'password' => bcrypt('jsnc225m2m'),
        ]);
    }
}
