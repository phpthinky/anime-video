<?php 

/**
* 
*/
class admin_m extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

	public function hosted_sites()
	{
		# code...

		
		//$query = $this->db->get('col_site');
		//return $query->result();
		return $this->permission->hosted_sites();
	}
	public function save_site($site_name=false,$site_path=false,$site_category=0)
	{
		if ($site_name && $site_path) {
			$data = array(
				'site_name'=>$site_name,
				'site_path'=>$site_path,
				'date_created'=>date('Y-m-d'),
				'site_category'=>$site_category
			);
			return $this->db->insert('col_site',$data);
		}
	}

	public function visitors($days)
	{
		$q = $this->db->select_sum('counter')
			->from('post_view')
			->where('complete_date',$days)
			->get();
		if($result  = $q->result()){
			return $result[0]->counter;
		}else{
			return 0;
		}

	}
	public function total_visitors()
	{
		$q = $this->db->select_sum('counter')
			->from('post_view')
			->get();
		if($result  = $q->result()){
			return $result[0]->counter;
		}else{
			return 0;
		}

	}








}