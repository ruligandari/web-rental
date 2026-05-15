<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOwnerTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_owner' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'nama_owner' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'no_telp' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'alamat' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id_owner', true);
        $this->forge->addForeignKey('id_user', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('owner');
    }

    public function down()
    {
        $this->forge->dropTable('owner');
    }
}
