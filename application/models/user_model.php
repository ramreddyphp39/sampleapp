<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {
public function __construct()
{
parent::__construct();
$this->load->database();
}
public function register_user()
{
$data=array(
'username'=>$this->input->post('username'),
'email'=>$this->input->post('email'),
'password'=>md5($this->input->post('password')),
'gender'=>$this->input->post('gender'),
'registered'=>time()
);
$this->db->insert('users',$data);
return true;
}
function login($email,$password)
{
$this->db->where("email",$email);
$this->db->where("password",md5($password));
$query=$this->db->get("users");
if($query->num_rows()>0)
{
$row=$query->row();
$userdata = array(
'user_id'  => $row->id,
'username'  => $row->username,
'email'    => $row->email,
);
$this->session->set_userdata($userdata);
return true;
}
return false;
}
function display_users(){
 
//$query=$this->db->get("users");
$q = $this->db->get("users");
            if($q->num_rows() > 0)
            {
                return $q->result();
            }
            return array();


}
function del_user($id)
{
    $this->db->where('id', $id);
    $this->db->delete('users');
}
function get_user($id) {
		$this->db->select('id, username, email, gender');
		$this->db->where('id', $id);
		$query = $this->db->get('users');

		return $query->row_array();
	}
function update_user($id, $data){
$this->db->where('id', $id);
$this->db->update('users', $data);
}

function searchByName($name)

{
$this->db->like('username', $name);
$res = $this->db->get('users');

 //$query = $this->db->get_where('users', array('username'=>$name)); 
 if($res->num_rows() > 0)
 return $res->result(); 
}
function get_auto_user($q){
    $this->db->select('username');
    $this->db->like('username', $q);
    $query = $this->db->get('users');
    if($query->num_rows > 0){
      foreach ($query->result_array() as $row){
        $row_set[] = htmlentities(stripslashes($row['username'])); //build an array
      }
      echo json_encode($row_set); //format the array into json data
    }
  }


}