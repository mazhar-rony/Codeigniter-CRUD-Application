<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model');
    }

    public function index()
    {
        $users = $this->User_model->get_user_list();
       
        $data = array();

        $data['users'] = $users;

        $this->load->view('list', $data);
    }

    public function isEmailExist($email) 
    {
        if($this->input->post('user_id'))
            $id = $this->input->post('user_id'); // get hidden field value from edit form
        else
            $id = '';

        $is_exist = $this->User_model->isEmailExist($id, $email);
    
        if ($is_exist) 
        {
            $this->form_validation->set_message('isEmailExist', 'Email address is already exist.');    
            return false;
        } 
        else 
        {
            return true;
        }
    }

    public function isNameExist($name) 
    {
        if($this->input->post('user_id'))
            $id = $this->input->post('user_id'); // get hidden field value from edit form
        else
            $id = '';

        $is_exist = $this->User_model->isNameExist($id, $name);
    
        if ($is_exist) 
        {
            $this->form_validation->set_message('isNameExist', 'This Name is already taken.');    
            return false;
        } 
        else 
        {
            return true;
        }
    }

    public function create()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|is_unique[users.name]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_isEmailExist');

        //To change the error message color from default to RED
        //All errors will now be wrapped in a <div> with the CSS class 'error'
        //Now, in your CSS, just define: .error { color: red;}
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if($this->form_validation->run() == false)
        {
            $this->load->view('create');
        }
        else
        {
            $userData = array();
            
            $userData['name'] = $this->input->post('name');
            $userData['email'] = $this->input->post('email');
            $userData['created_at'] = date('Y-m-d H:i:s');

            $result = $this->User_model->create_user($userData);

            if(!empty($result))
            {
                $this->session->set_flashdata('success', 'User Created successfully !');

            }
            else
            {
                $this->session->set_flashdata('error', 'Some error occured. Can not create user...');
            }

            redirect(base_url().'user/index');

        }
        
    }

    public function edit($userId)
    {
        $user = $this->User_model->get_user($userId);

        $data = array();
        $data['user'] = $user;

        $this->form_validation->set_rules('name', 'Name', 'required|callback_isNameExist');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_isEmailExist');

        //To change the error message color from default to RED
        //All errors will now be wrapped in a <div> with the CSS class 'error'
        //Now, in your CSS, just define: .error { color: red;}
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if($this->form_validation->run() == false)
        {
            $this->load->view('edit', $data);
        }
        else
        {
            $userData = array();
            
            $userData['name'] = $this->input->post('name');
            $userData['email'] = $this->input->post('email');

            $result = $this->User_model->update_user($userId, $userData);
            
            if(!empty($result))
            {
                $this->session->set_flashdata('success', 'User updated successfully !');

            }
            else
            {
                $this->session->set_flashdata('error', 'Some error occured. User data not updated...');
            }

            redirect(base_url().'user/index');

        }
    }

    public function delete($userId)
    {
        $user = $this->User_model->get_user($userId);

        if(empty($user))
        {
            $this->session->set_flashdata('error', 'Record not found in database...');
        }
        else
        {

            $result = $this->User_model->delete_user($userId);

            if(!empty($result))
            {
                $this->session->set_flashdata('success', 'User deleted successfully !');

            }
            else
            {
                $this->session->set_flashdata('error', 'Some error occured. User not deleted...');
            }
        }
        
        redirect(base_url().'user/index');
    }

}
