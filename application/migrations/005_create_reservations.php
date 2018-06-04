<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_reservations extends CI_Migration {

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
            'copy_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
            ),
            'book_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
            ),
            'reservation_date' => array(
                'type' => 'TIMESTAMP',
            ),
            'borrow_date' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
            'due_date' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
            'return_date' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE
            ),
            'overdue_fine' => array(
                'type' => 'DECIMAL',
                'default' => 0,
            ),
            'status' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'default' => 0
            ),
            'remark' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'deleted' => array(
                'type' => 'BOOLEAN',
                'default' => FALSE,
            ),
            'CONSTRAINT fk_reservations_copy FOREIGN KEY (copy_id) REFERENCES copies(id)',
            'CONSTRAINT fk_reservations_book FOREIGN KEY (book_id) REFERENCES books(id)',
            'CONSTRAINT fk_reservations_user FOREIGN KEY (user_id) REFERENCES users(id)',
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('reservations', TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('reservations');
    }
}