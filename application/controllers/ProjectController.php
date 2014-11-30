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
 * Time: 08:40
 */
class ProjectController extends MY_PublicController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("services/ProjectService");
    }

    function index()
    {
        $projects = $this->ProjectService->getAll();
        $this->setHeaderData("active_controller", "project_list");
        $this->setHeaderData("title", "Projects"); // TODO: Use language variable
        $this->setBodyData("projects", $projects);
        $this->loadView('public/projects/projectList');
    }

    function view($identifier)
    {
        $this->setHeaderData("active_controller", "project_info");
        $project = $this->ProjectService->Find("identifier", "=", $identifier);
        $this->setHeaderData("title", $project[0]->getName());
        $this->setBodyData("project", $project[0]);
        $this->load->view('include/header', $this->getHeaderData());
        $this->load->view('public/projects/viewProject', $this->getBodyData());
        $this->load->view('include/footer', $this->getFooterData());
    }
} 