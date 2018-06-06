<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_settings extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'value' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'deleted' => array(
                'type' => 'BOOLEAN',
                'default' => FALSE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('settings', TRUE);

        $this->db->insert_batch('settings', array(
            array(
                'name' => 'overdue_rate',
                'value' => '20',
            ),
            array(
                'name' => 'borrow_duration',
                'value' => '5',
            ),
        ));
    }

    public function down()
    {
        $this->dbforge->drop_table('settings');
    }
}