<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'kode_user'  => 'USER001',
            'nama_lengkap' => 'User Admin',
            'jenis_kelamin' => 'Laki-laki',
            'level' => 'Admin',
            'email' => 'admin@test.com',
            'username' => 'admin',
            'password'  => bcrypt('admin'),
            'hp' => '087863216757',
            'foto' => 'cropped-new-Logo-Undiksha.png',
            'alamat' => 'Singaraja',
            'telegram_id' => '956802666',
        ]);
    }
}
