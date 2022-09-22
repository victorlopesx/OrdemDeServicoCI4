<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserTable extends Migration
{
    public function up()
    {
     $this->forge->addField([
        'id' => [
            'type' => 'INT',
            'constraint' => 5,
            'unsigned' => true,
            'auto_increment' => true,            
        ],
        'name' => [
            'type' => 'VARCHAR',
            'constraint' => 128, 
        ],
        'email' => [
            'type' => 'VARCHAR',
            'constraint' => 254, 
        ],
        'phoneNumber' => [
            'type' => 'BIGINT',
            'constraint' => 14,
        ],
        'password_hash' => [
            'type' => 'VARCHAR',
            'constraint' => 254, 
        ],
        'reset_hash' => [
            'type' => 'VARCHAR',
            'constraint' => 80, 
            'null' => true,
            'default' => null,
        ],
        'reset_expires' => [
            'type' => 'DATETIME',
            'null' => true,
            'default' => null,
        ],
        'avatar' => [
            'type' => 'VARCHAR',
            'constraint' => 254, 
            'null' => true,
            'default' => null,
        ],
        'active' => [
            'type' => 'BOOLEAN',
            'null' => false,
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => true,
            'default' => null,
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
            'default' => null,
        ],
        'deleted_at' => [
            'type' => 'DATETIME',
            'null' => true,
            'default' => null,
        ],
     ]);   

     $this->forge->addKey('id', true);
     $this->forge->addUniqueKey('email');

     $this->forge->createTable('users');

    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
