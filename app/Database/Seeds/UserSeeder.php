<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // 1. Create Admin
        $db->table('user')->insert([
            'username' => 'admin',
            'email'    => 'admin@ycr.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role'     => 'admin',
        ]);
        $adminId = $db->insertID();
        $db->table('admin')->insert([
            'id_user'    => $adminId,
            'nama_admin' => 'Administrator Utama',
            'no_telp'    => '08123456789',
        ]);

        // 2. Create Owner
        $db->table('user')->insert([
            'username' => 'owner',
            'email'    => 'owner@ycr.com',
            'password' => password_hash('owner123', PASSWORD_DEFAULT),
            'role'     => 'owner',
        ]);
        $ownerId = $db->insertID();
        $db->table('owner')->insert([
            'id_user'     => $ownerId,
            'nama_owner'  => 'Pemilik YCR',
            'no_telp'     => '08987654321',
            'alamat'      => 'Jakarta, Indonesia',
        ]);
    }
}
