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
 * Time: 21:16
 */
#namespace application\migrations;
class Migration_User_groups_init extends \CI_Migration
{
    public function up()
    {
        $prefix = $this->db->dbprefix;
        $fields = array(
            'user_id' => array(
                'type' => 'BIGINT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ),
            'group_id' => array(
                'type' => 'BIGINT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ),
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', true);
        $this->dbforge->add_key('username', true);
        $this->dbforge->create_table('users_groups', true);
        // Add foreign keys
        $this->db->query("ALTER TABLE `" . $prefix . "users_groups` ADD CONSTRAINT `FK_user_groups_user_id` FOREIGN KEY (`user_id`) REFERENCES `" . $prefix . "users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
        $this->db->query("ALTER TABLE `" . $prefix . "users_groups` ADD CONSTRAINT `FK_user_groups_group_id` FOREIGN KEY (`group_id`) REFERENCES `" . $prefix . "groups` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;");
    }

    public function down()
    {
        $this->dbforge->drop_table(DBTables::users_groups);
    }
} 