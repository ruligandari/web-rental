<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPaymentLinkToPemesanan extends Migration
{
    public function up()
    {
        $fields = [
            'payment_link' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ];
        $this->forge->addColumn('pemesanan', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('pemesanan', 'payment_link');
    }
}
