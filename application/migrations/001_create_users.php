<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_users extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'last_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'middle_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'email_address' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => TRUE,
            ),
            'contact_number' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users', TRUE);

        $this->db->insert('users', array(
            'first_name' => 'admin',
            'last_name' => 'admin',
            'middle_name' => 'admin',
            'email_address' => 'admin@gmail.com',
            'contact_number' => '00000000000',
            'address' => 'none',
            'password' => password_hash('password', PASSWORD_BCRYPT),
        ));
    }

    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}