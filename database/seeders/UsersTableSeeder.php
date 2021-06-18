<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'kode_user'  => 'USER001',
            'nama_lengkap' => 'User Admin',
            'jenis_kelamin' => 'Laki-laki',
            'level' => 'Admin',
            'email' => 'admin@test.com',
            'username' => 'admin',
            'password'  => bcrypt('admin'),
            'no_hp' => '087863216757',
            'foto' => 'cropped-new-Logo-Undiksha.png',
            'alamat' => 'Singaraja',
            'telegram_id' => '956802666',
        ]);
    }
}
