<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTravelTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_travel' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_mobil' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'plat_nomor' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'harga_sewa' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'status_mobil' => [
                'type'       => 'ENUM',
                'constraint' => ['Tersedia', 'Disewa', 'Servis'],
                'default'    => 'Tersedia',
            ],
            'foto' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_travel', true);
        $this->forge->createTable('travel');
    }

    public function down()
    {
        $this->forge->dropTable('travel');
    }
}
