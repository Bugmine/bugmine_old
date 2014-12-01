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
 * Date: 24.11.2014
 * Time: 20:26
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Group_Rights_Init extends CI_Migration
{
    public function up()
    {
        $prefix = $this->db->dbprefix;
        $fields = array(
            'group_id' => array(
                'type' => 'BIGINT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ),
            'right_id' => array(
                'type' => 'BIGINT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ),
            'value' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'unsigned' => true,
                'null' => false,
            ),
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('group_id', true);
        $this->dbforge->add_key('right_id', true);
        $this->dbforge->create_table('group_rights', true);
        $this->db->query("ALTER TABLE `" . $prefix . "group_rights` ADD CONSTRAINT `FK_group_rights_group_id` FOREIGN KEY (`group_id`) REFERENCES `" . $prefix . "groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
        $this->db->query("ALTER TABLE `" . $prefix . "group_rights` ADD CONSTRAINT `FK_group_rights_right_id` FOREIGN KEY (`right_id`) REFERENCES `" . $prefix . "rights` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;");

        $defaultRights = array(
            // tickets_createTicket
            array(
                'group_id' => 1,
                'right_id' => 1,
                'value' => true,
            ),
            array(
                'group_id' => 2,
                'right_id' => 1,
                'value' => true,
            ),
            array(
                'group_id' => 3,
                'right_id' => 1,
                'value' => true,
            ),
            // tickets_updateTicket
            array(
                'group_id' => 1,
                'right_id' => 2,
                'value' => true,
            ),
            array(
                'group_id' => 2,
                'right_id' => 2,
                'value' => true,
            ),
            array(
                'group_id' => 3,
                'right_id' => 2,
                'value' => true,
            ),
            // tickets_closeTicket
            array(
                'group_id' => 1,
                'right_id' => 3,
                'value' => false,
            ),
            array(
                'group_id' => 2,
                'right_id' => 3,
                'value' => true,
            ),
            array(
                'group_id' => 3,
                'right_id' => 3,
                'value' => true,
            ),
            // tickets_commentTicket
            array(
                'group_id' => 1,
                'right_id' => 4,
                'value' => true,
            ),
            array(
                'group_id' => 2,
                'right_id' => 4,
                'value' => true,
            ),
            array(
                'group_id' => 3,
                'right_id' => 4,
                'value' => true,
            ),
            // tickets_deleteTicket
            array(
                'group_id' => 1,
                'right_id' => 5,
                'value' => false,
            ),
            array(
                'group_id' => 2,
                'right_id' => 5,
                'value' => true,
            ),
            array(
                'group_id' => 3,
                'right_id' => 5,
                'value' => true,
            ),
        );
        $this->db->insert_batch('group_rights', $defaultRights);
    }

    public function down()
    {
        $this->dbforge->drop_table('group_rights');
    }
} 