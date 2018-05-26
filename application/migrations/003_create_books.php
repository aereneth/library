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
            'category_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
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
            'status' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'acquisition_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'recent_update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'CONSTRAINT fk_books_category FOREIGN KEY (category_id) REFERENCES categories(id)',
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('books', TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('books');
    }
}