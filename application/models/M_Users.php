<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Users extends CI_Model {

    private $table = 'users';

    public function get_users(){
        return $this->db->get($this->table);
    }

    public function username_exists($username){

        $this->db->where('username',$username);
        $res = $this->db->get($this->table);

        if( $res->num_rows() == 0 ) return true;
        else return false;
    }

    public function insert($data){
        return $this->db->insert($this->table,$data);
    }

    public function getUserByUsernamePassword($username,$password){
        $this->db->where([
            'username'  => $username,
            'password'  => md5($password)
        ]);

        $res = $this->db->get('users');

        if( $res->num_rows() == 0 ) return false;
        else return $res->result()[0];
    }

    public function UpdateLastAndCountLogin($username){

        $this->db->where('username',$username);
        $this->db->set('login_count','login_count+1',FALSE);
        $this->db->set('last_login',date('Y-m-d H:i:s'));

        return $this->db->update($this->table);

    }
}
