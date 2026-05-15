<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMetodePembayaranToPemesanan extends Migration
{
    public function up()
    {
        $fields = [
            'metode_pembayaran' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
        ];
        $this->forge->addColumn('pemesanan', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('pemesanan', 'metode_pembayaran');
    }
}
