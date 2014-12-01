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
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthenticationController extends \MY_PublicController
{
    function __construct()
    {
        parent::__construct();
        $this->lang->load('authentication/fields', $this->config->item('language'));
        $this->lang->load('authentication/general', $this->config->item('language'));
        $this->load->model('services/UserService');
    }

    public function login()
    {
        $this->setHeaderData("active_controller", "login");
        $this->setHeaderData("title", $this->lang->line('authentication_general_login'));
        $this->loadView('public/auth/login');
    }

    public function index()
    {
        redirect('authenticationcontroller/login', 'refresh');
    }

    public function processRegistration()
    {
        $this->setHeaderData("active_controller", "register");
        $this->setHeaderData("title", $this->lang->line('authentication_general_register'));
        $this->form_validation->set_rules('username', 'lang:authentication_fields_username', 'trim|required|is_unique[' . $this->db->dbprefix("users") . '.username]|xss_clean');
        $this->form_validation->set_rules('firstName', 'lang:authentication_fields_firstname', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lastName', 'lang:authentication_fields_lastname', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'lang:authentication_fields_email', 'trim|required|valid_email|is_unique[' . $this->db->dbprefix("users") . '.email]|xss_clean');
        $this->form_validation->set_rules('password', 'lang:authentication_fields_password', 'trim|required|matches[passwordconfirmation]|xss_clean');
        $this->form_validation->set_rules('passwordconfirmation', 'lang:authentication_fields_passwordconfirmation', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->register();
        } else {
            $this->load->helper('string');
            $user = new User();
            $user->setUsername($this->input->get_post('username'));
            $user->setEmail($this->input->get_post('email'));
            $user->setFirstName($this->input->get_post('firstName'));
            $user->setLastName($this->input->get_post('lastName'));
            $salt = random_string('alnum', $this->config->item("salt_length"));
            $user->setSalt($salt);
            $password = $this->input->get_post('password');
            $password = $salt . $password . $salt;
            $this->load->helper('security');
            $password = hash($this->config->item("hash_algorithm"), $password);
            $user->setPassword($password);
            $this->UserService->Save($user);
            $user->setPassword("");
            $this->setBodyData("user", $user);
            $this->loadView('public/auth/registrationComplete');
        }
    }

    public function register()
    {
        $this->setHeaderData("active_controller", "register");
        $this->setHeaderData("title", $this->lang->line('authentication_general_register'));
        $this->loadView('public/auth/register');
    }
}