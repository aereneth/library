<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_copies extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'book_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
            ),
            'status' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'remark' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'deleted' => array(
                'type' => 'BOOLEAN',
                'default' => FALSE,
            ),
            'CONSTRAINT fk_copies_book FOREIGN KEY (book_id) REFERENCES books(id)',
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('copies', TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('copies');
    }
}