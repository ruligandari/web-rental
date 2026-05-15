<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInvoiceTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_invoice' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_reservasi' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'no_invoice' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'rincian_tambahan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_invoice', true);
        $this->forge->addForeignKey('id_reservasi', 'pemesanan', 'id_reservasi', 'CASCADE', 'CASCADE');
        $this->forge->createTable('invoice');
    }

    public function down()
    {
        $this->forge->dropTable('invoice');
    }
}
