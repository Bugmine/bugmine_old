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
 * Date: 23.11.2014
 * Time: 17:26
 */
class Authentication extends \MY_PublicController
{

    public function login()
    {
        $this->load->view('public/auth/login');
        $this->load->view('include/footer');
    }

    public function index()
    {
        redirect('authentication/login', 'refresh');
    }

    public function register()
    {
        $this->load->view('public/auth/register');
        $this->load->view('include/footer');
    }

    public function processregistration()
    {
        $this->lang->load('authentication/fields', $this->config->item('language'));
        //$this->form_validation->set_error_delimiters('<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>', '</div>');
        $this->form_validation->set_rules('username', 'lang:authentication_fields_username', 'trim|required|is_unique[' . $this->db->dbprefix("users") . '.username]|xss_clean');
        $this->form_validation->set_rules('firstname', 'lang:authentication_fields_firstname', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lastname', 'lang:authentication_fields_lastname', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'lang:authentication_fields_email', 'trim|required|valid_email|is_unique[' . $this->db->dbprefix("users") . '.email]|xss_clean');
        $this->form_validation->set_rules('password', 'lang:authentication_fields_password', 'trim|required|matches[passwordconfirmation]|xss_clean');
        $this->form_validation->set_rules('passwordconfirmation', 'lang:authentication_fields_passwordconfirmation', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('public/auth/register');
            $this->load->view('include/footer');
        } else {
            $this->load->view('public/auth/register');
            $this->load->view('include/footer');
        }
    }
}