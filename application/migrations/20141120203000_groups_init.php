<?php
/*
 * The MIT License
 *
 * Copyright 2014 Stefan Schmid <stefanschmid35@googlemail.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
/**
 * User: Stefan
 * Date: 20.11.2014
 * Time: 20:50
 */
#namespace application\migrations;
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_Groups_Init extends \CI_Migration
{
    public function up()
    {
        // Setting table structure
        $fields = array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
                'auto_increment' => true
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ),
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('groups', true);
        // Insert Default Groups
        $defaultGroups = array(
            array(
                'id' => 1,
                'name' => "User"
            ),
            array(
                'id' => 2,
                'name' => "Developer"
            ),
            array(
                'id' => 3,
                'name' => "Administrator"
            ),
        );
        $this->db->insert_batch('groups', $defaultGroups);
    }

    public function down()
    {
        $this->dbforge->drop_table('groups');
    }
} 