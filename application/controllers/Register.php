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
 * Description of Register
 *
 * @author Stefan Schmid <stefanschmid35@googlemail.com>
 */
class Register extends MY_PublicController
{

    function index()
    {

    }

    function test()
    {
        echo "Test";
    }

    function doRegister()
    {
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
        $this->form_validation->set_rules('username', $this->lang->line('auth_username'), 'trim|required|is_unique[' . $this->db->dbprefix("users") . '.username]|xss_clean');
        $this->form_validation->set_rules('firstname', $this->lang->line('auth_firstname'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('lastname', $this->lang->line('auth_lastname'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', $this->lang->line('auth_password'), 'trim|required|matches[confirmpassword]|xss_clean');
        $this->form_validation->set_rules('confirmpassword', $this->lang->line('auth_passwordconfirm'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', $this->lang->line('auth_email'), 'trim|required|valid_email|is_unique[' . $this->db->dbprefix("users") . '.email]|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('public/auth/register');
            $this->load->view('include/footer');
        } else {
            $this->load->model('user');
            $this->load->helper('string');
            $salt = random_string('unique');
            $pass = hash('sha512', $salt . $this->input->post('password') . $salt);
            // Create user
            $user = new User();
            $user->setUsername($this->input->post('username'));
            $user->setFirstname($this->input->post('firstname'));
            $user->setLastname($this->input->post('lastname'));
            $user->setPassword($pass);
            $user->setSalt($salt);
            $user->setEmail($this->input->post('email'));
            $user->setRegistrationdate(mdate("%Y-%m-%d %H:%i:%s", now()));
            $user->add_user();
            // Send E-Mail
            $this->load->library('email');
            $this->email->from('bugmine@stefan-schmid.com', 'Bugmine');
            $this->email->to("stefanschmid35@googlemail.com");
            $this->email->subject('Your Bugmine Registration');
            $this->email->message("Hello " . $user->getFirstname() . " " . $user->getLastname() . ",<br />your Bugmine Account has been created.<br />Your username is: " . $user->getUsername());
            $this->email->send();
            $this->load->view('public/auth/register');
            $this->load->view('include/footer');
        }
    }

}
