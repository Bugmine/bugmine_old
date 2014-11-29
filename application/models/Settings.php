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
 * Description of Settings
 *
 * @author Stefan Schmid <stefanschmid35@googlemail.com>
 */
class Settings extends CI_Model
{

    private $title;
    private $projectInfo;
    private $defaultLanguage;

    function getDefaultLanguage()
    {
        return $this->defaultLanguage;
    }

    function setDefaultLanguage($defaultLanguage)
    {
        $this->defaultLanguage = $defaultLanguage;
    }

    function getProjectInfo()
    {
        return $this->projectInfo;
    }

    function setProjectInfo($projectInfo)
    {
        $this->projectInfo = $projectInfo;
    }

    function getTitle()
    {
        return $this->title;
    }

    function setTitle($title)
    {
        $this->title = $title;
    }

    function loadSettings()
    {
        $query = $this->db->get($this->db->dbprefix("settings"));
        $result = $query->result_array();
        foreach ($result as $item) {
            switch ($item["key"]) {
                case "general_defaultlang":
                    $this->setDefaultLanguage($item["value"]);
                    break;
                case "general_title":
                    $this->setTitle($item["value"]);
                    break;
                case "project_info":
                    $this->setProjectInfo($item["value"]);
                    break;
                default:
                    break;
            }
        }
    }

}
