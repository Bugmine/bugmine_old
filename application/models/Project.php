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
 * Description of ProjectInfo
 *
 * @author Stefan Schmid <stefanschmid35@googlemail.com>
 */
class Project extends CI_Model {

    private $id;
    private $projectName;
    private $projectInfo;
    private $projectIsPublic;

    function getId() {
        return $this->id;
    }

    function getProjectName() {
        return $this->projectName;
    }

    function getProjectInfo() {
        return $this->projectInfo;
    }

    function getProjectIsPublic() {
        return $this->projectIsPublic;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setProjectName($projectName) {
        $this->projectName = $projectName;
    }

    function setProjectInfo($projectInfo) {
        $this->projectInfo = $projectInfo;
    }

    function setProjectIsPublic($projectIsPublic) {
        $this->projectIsPublic = $projectIsPublic;
    }

    function loadProject($id) {
        $query = $this->db->get_where($this->db->dbprefix("projects"), array('id' => $id));
        $result = $query->result_array();
        $this->setId($result[0]["id"]);
        $this->setProjectName($result[0]["project_name"]);
        $this->setProjectInfo($result[0]["project_description"]);
        $this->setProjectIsPublic($result[0]["project_ispublic"]);
    }

}
