<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_books extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'isbn' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => TRUE,
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'other_title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'publisher' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'publication_year' => array(
                'type' => 'VARCHAR',
                'constraint' => '4',
                'null' => TRUE,
            ),
            'editon' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'description' => array(
                'type' => 'TEXT',
            ),
            'abstract' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'status' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('books', TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('books');
    }
}