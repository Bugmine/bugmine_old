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
 * Time: 20:01
 */
require_once APPPATH.'models/services/AbstractService.php';
class UserService extends AbstractService
{

    /**
     * Gets a row from the database by its ID
     *
     * @param int $id
     *
     * @return User
     */
    public function GetById($id)
    {
        $result = $this->db->get_where('users', array('id' => $id));
        $user = new User();
        if ($result->num_rows() > 0)
        {
            $row = $result->result();
                $user->setId($row->id);
                $user->setUsername($row->username);
                $user->setEmail($row->email);
                $user->setFirstName($row->firstname);
                $user->setLastName($row->lastname);
                $user->setPassword($row->password);
                $user->setSalt($row->salt);
                $user->setRegistrationDate($row->registrationdate);
        }
        return $user;
    }

    /**
     * Gets one or multiple rows from the database where the value is in the column
     *
     * @param string $column
     * @param string $expression
     * @param mixed $value
     *
     * @return One or multiple rows matching the value in the given column
     */
    public function Find($column, $expression, $value)
    {
        $result = $this->db->get_where('users', array($column.' '.$expression => $value));
        $users = array();
        if ($result->num_rows() > 0)
        {
            foreach ($result->result() as $row)
            {
                $user = new User();
                $user->setId($row->id);
                $user->setUsername($row->username);
                $user->setEmail($row->email);
                $user->setFirstName($row->firstname);
                $user->setLastName($row->lastname);
                $user->setPassword($row->password);
                $user->setSalt($row->salt);
                array_push($users, $user);
            }
        }
        return $users;
    }

    /**
     * Deletes a row from the database by its ID
     *
     * @param long $id
     *
     */
    public function Delete($id)
    {
        $this->db->delete("users_groups", array('user_id' => $id));
        $this->db->delete("users", array('id' => $id));
    }

    /**
     * Inserts or Updates a row in the database
     *
     * @param User $item
     *
     */
    public function Save($item)
    {
        $result = $this->db->get_where('users', array('id' => $item->getId()));
        $data = array(
            'id' => $item->getId(),
            'username' => $item->getUsername(),
            'email' => $item->getEmail(),
            'firstName' => $item->getFirstName(),
            'lastName' => $item->getLastName(),
            'password' => $item->getPassword(),
            'salt' => $item->getSalt()
        );
        if ($result->num_rows() > 1) {
            $this->db->where('id', $item->getId());
            $this->db->update('users', $data);
        } else {
            $this->db->insert('users', $data);
        }

    }
}