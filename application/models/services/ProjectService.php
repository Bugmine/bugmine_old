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
 * Date: 29.11.2014
 * Time: 14:57
 */
require_once APPPATH . 'models/services/AbstractService.php';

class ProjectService extends AbstractService
{

    /**
     * Gets a row from the database by its ID
     *
     * @param long $id
     *
     * @return Row from the database matching the ID
     */
    public function GetById($id)
    {
        $result = $this->db->get_where('projects', array('id' => $id));
        $project = new Project();
        if ($result->num_rows() > 0) {
            $row = $result->result();
            $project->setId($row->id);
            $project->setName($row->name);
            $project->setDescription($row->description);
            $project->setIdentifier($row->identifier);
            $project->setWebsite($row->website);
        }
        return $project;
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
        $result = $this->db->get_where('projects', array($column . ' ' . $expression => $value));
        $projects = array();
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                $project = new Project();
                $project->setId($row->id);
                $project->setName($row->name);
                $project->setDescription($row->description);
                $project->setIdentifier($row->identifier);
                $project->setWebsite($row->website);
                array_push($projects, $project);
            }
        }
        return $projects;
    }

    /**
     * Deletes a row from the database by its ID
     *
     * @param long $id
     *
     */
    public function Delete($id)
    {
        $this->db->delete("projects", array('id' => $id));
    }

    /**
     * Inserts or Updates a row in the database
     *
     * @param Project $item
     *
     */
    public function Save($item)
    {
        $result = $this->db->get_where('projects', array('id' => $item->getId()));
        $data = array(
            'id' => $item->getId(),
            'name' => $item->getName(),
            'description' => $item->getDescription(),
            'identifier' => $item->getIdentifier(),
            'website' => $item->getWebsite(),
        );
        if ($result->num_rows() > 1) {
            $this->db->where('id', $item->getId());
            $this->db->update('projects', $data);
        } else {
            $this->db->insert('projects', $data);
        }
    }

    /**
     * Gets all entries from the database
     * @return array
     */
    public function GetAll()
    {
        $result = $this->db->get('projects');
        $projects = array();
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                $project = new Project();
                $project->setId($row->id);
                $project->setName($row->name);
                $project->setDescription($row->description);
                $project->setIdentifier($row->identifier);
                $project->setWebsite($row->website);
                array_push($projects, $project);
            }
        }
        return $projects;
    }
}