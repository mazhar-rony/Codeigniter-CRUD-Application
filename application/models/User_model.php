<?php
class User_model extends CI_Model {

    public function create_user($userData)
    {
        $result = $this->db->insert('users', $userData);

        return $result ? true : false;
    }

    public function get_user_list()
    {
        $users = $this->db->get('users')->result_array();
        
        return $users;
       
    }

    public function get_user($userId)
    {
        $this->db->where('user_id', $userId);
        $user = $this->db->get('users')->row_array();

        return $user;
    }

    public function update_user($userId, $userData)
    {
        $this->db->where('user_id', $userId);
        $result = $this->db->update('users', $userData);

        return $result ? true : false;
    }

    public function delete_user($userId)
    {
        $this->db->where('user_id', $userId);
        $result = $this->db->delete('users');

        return $result ? true : false;
    }

    function isEmailExist($id = '', $email) 
    {
        $this->db->select('user_id');
        $this->db->where('email', $email);
        if($id)
        {
            $this->db->where_not_in('user_id', $id);
        }

        $query = $this->db->get('users');
    
        if ($query->num_rows() > 0) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    function isNameExist($id = '', $name) 
    {
        $this->db->select('user_id');
        $this->db->where('name', $name);
        if($id)
        {
            $this->db->where_not_in('user_id', $id);
        }

        $query = $this->db->get('users');
    
        if ($query->num_rows() > 0) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

}
?>