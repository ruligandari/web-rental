<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePemesananTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_reservasi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_pelanggan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_travel' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'tgl_mulai' => [
                'type' => 'DATE',
            ],
            'tgl_selesai' => [
                'type' => 'DATE',
            ],
            'total_bayar' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'tgl_bayar' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'status_reservasi' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);
        $this->forge->addKey('id_reservasi', true);
        $this->forge->addForeignKey('id_pelanggan', 'pelanggan', 'id_pelanggan', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_travel', 'travel', 'id_travel', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pemesanan');
    }

    public function down()
    {
        $this->forge->dropTable('pemesanan');
    }
}
