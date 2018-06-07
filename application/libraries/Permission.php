<?php 

/**
* 
*/
class Permission
{
	public $ci;
	public $prefix;
	public $salt = '_salt-';
	public function __construct()
	{
		# code...
	        $this->ci =& get_instance();
	        $this->ci->load->database();
			$this->ci->load->library('session');
	        $this->ci->load->helper('cookie');
	        $this->ci->load->helper('url');

	}

	public function list_user($site_id=false)
	{
		if($this->is_admin()){
			return $this->ci->db->get('users')->result();
		}
		if($site_id){
			$query = $this->ci->db->select('users.*')
				->from('users')
				->join('site_users','site_users.user_id = users.user_id','left')
				->where('site_id',$site_id)
				->get();
				return $query->result();
		}else{
			return false;
		}
	}
	public function create_user($username=false,$password=false,$user_type=0,$email='')
	{
		if($username && $password){
			$data = array(
				'user_name'=>$username,
				'user_pass'=>$this->e_pass($this->salt . $password),
				'status'=>$user_type,
				'user_email'=>$email
			);
			$this->ci->db->insert('users',$data);
			return  $this->ci->db->insert_id();
		}else{
			return false;
		}
	}

	public function update_user($username=false,$password=false,$user_type=0,$email='')
	{
		if($username && $password){
			$data = array(
				'user_pass'=>$this->e_pass($this->salt . $password),
				'status'=>$user_type,
				'user_email'=>$email
			);
			$this->ci->db->where('user_name',$username);
			return $this->ci->db->update('users',$data);
		}else{
			return false;
		}
	}
	public function allow_user($user_id=false,$site_id=false,$user_type=0)
	{
		if($user_id && $site_id){
			$query = $this->ci->db->get_where('site_users',array('user_id'=>$user_id,'site_id'=>$site_id));
			if($result = $query->result()){
				return true;
			}else{
				return $this->ci->db->insert('site_users',array('user_id'=>$user_id,'site_id'=>$site_id,'status'=>$user_type));
			}
		}else{
			return false;
		}
	}
	public function e_pass($password='')
	{
		return md5($password);
	}
	public function login($user=false, $pass=false)
	{

		if ($user && $pass) {
			$pass = md5($this->salt.$pass);
			$query =  $this->ci->db->get_where('users',array('user_name'=>$user,'user_pass'=>$pass));
			//return $query->result();
			if($result = $query->result()){
				$this->ci->session->userdata['id'] = $result[0]->user_id;
				$this->ci->session->userdata['username'] = $result[0]->user_name;
				//$this->ci->session->userdata['is_logged_in'] = true;
				/*if($sites = $this->list_user_sites($result[0]->user_id)){
					//var_dump(json_encode($sites));
					$this->ci->session->userdata['sites'] = json_encode($sites);
				}else{
					$this->ci->session->userdata['sites'] = false;
				}*/

				return true;
			}
			//$this->ci->session->userdata['is_logged_in'] = false;
		return false;
		}
		return false;
	}
	public function logout($value='')
	{
				session_destroy();
				$this->ci->session->userdata['id'] = 0;
				$this->ci->session->userdata['username'] = '';
				$this->ci->session->userdata['is_logged_in'] = false;
	}
	public function is_admin($user_id = false)
	{

		$user_id = $this->ci->session->userdata['id'];
		if($user_id == 1){
			return true;
		}else{
			return false;
		}
	}
	public function is_loggedIn()
	{
		if(isset($this->ci->session->userdata['is_logged_in'])){
			if($this->ci->session->userdata['is_logged_in'] == true){
			return true;
			}else{
				return false;
			}
		}
		return false;
	}
	public function is_subadmin($user_id =  false,$site_id = false)
	{

		if($user_id && $site_id){
			$query = $this->ci->db->get_where('site_users',array('user_id'=>$user_id,'site_id'=>$site_id,'status'=>1));
			if($result = $query->result()){
				return true;
			}else{
				return false;
			}
		}else{
				return false;
			}
	}
	public function is_allowed($user_id =  false,$site_id = false)
	{
		if($user_id && $site_id){
			$query = $this->ci->db->get_where('site_users',array('user_id'=>$user_id,'site_id'=>$site_id));
			if($result = $query->result()){
				return true;
			}else{
				return false;
			}
		}else{
				return false;
			}
	}
	public function list_user_sites($user_id = false)
	{

		if($user_id){
			if($this->is_admin()){
				return $this->hosted_sites();
			}
			$query = $this->ci->db->select('site.*,site_users.status as user_type ')
							->from('site')
							->join('site_users','site_users.site_id = site.site_id','LEFT')
							//->where(array('user_id'=>$user_id))
							->get();
			//$query = $this->ci->db->get_where('site_users',array('user_id'=>$user_id));
			if($result = $query->result()){
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function hosted_sites()
	{
		# code...

		
		$query = $this->ci->db->get('site');
		return $query->result();
	}






















}