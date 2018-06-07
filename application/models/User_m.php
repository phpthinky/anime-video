<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class User_m extends CI_Model
{
public function update_user($username,$data=false)
{
	# code...
	if($data){
		$this->db->where('user_name',$username);
		return $this->db->update('users',$data);
	}
	return false;

}
public function user($user=false,$pass=false)
{
	if ($user && $pass) {


		$query =  $this->db->get_where('users',array('user_name'=>$user,'user_pass'=>$pass));
		return $query->result();


	}
	return false;

}

public function info($user_id=false)
{
	if ($user_id) {


		$query =  $this->db->get_where('users',array('user_id'=>$user_id));
		if($result = $query->result()){
			
				
			return $result;

			
		}


	}
	return false;

}
public function settings($title = false,$user_id = false)
{
	if($user_id == false){
		$user_id = $this->session->userdata['id'];
	}
			$query = $this->db->get_where('user_settings',array('user_id'=>$user_id,'title'=>$title));
				if($result = $query->result()){
					return $result[0]->value;

				}
			
		return false;
}



}