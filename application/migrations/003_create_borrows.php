<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_borrows extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
            ),
            'book_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
            ),
            'borrow_date' => array(
                'type' => 'DATETIME',
            ),
            'due_date' => array(
                'type' => 'DATETIME',
            ),
            'return_date' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'borrowed_days' => array(
                'type' => 'int',
                'constraint' => 5,
                'default' => 0,
            ),
            'fine' => array(
                'type' => 'DECIMAL',
                'default' => 0,
            ),
            'status' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'remark' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('borrows', TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('borrows');
    }
}