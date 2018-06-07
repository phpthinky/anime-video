<?php 

/**
* 
*/
class Site_m extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

	public function get_content($id=false)
	{
		# code...
		if(is_numeric($id)){

			$sql = sprintf("SELECT content FROM static_page WHERE id= %d",$id);
			$query = $this->db->query($sql);
			if($result =  $query->result()){
				return $result[0]->content;
			}else{
				return false;
			}

		}
	}

	public function insert($id=false,$content=false)
	{
		# code...
		

		$sql = sprintf("UPDATE static_page SET content = '%s' WHERE id = %d",$content,$id);
		return $this->db->query($sql);

	}


	public function getSiteCategory($category = false){
		if($category){

		return $this->db->where('site_category',$category)->get('site_category')->result();

		}
		return $this->db->get('site_category')->result();

	}

	public function getSiteColleges($category = false){
		if($category){

		return $this->db->where('site_category',$category)->get('site')->result();

		}
		return false;

	}


	public function getSiteName($path=false,$site_id = false)
	{
		if($path){

			$query = $this->db->select('*')
				->from('site')
				->where('site_path',$path)
				->get();
			return $query->result();
		}elseif($site_id){

			$query = $this->db->select('*')
				->from('site')
				->where('site_id',$site_id)
				->get();
			return $query->result();
		}else{
			return false;
		}


	}
	public function getSiteId($path='')
	{
		$query = $this->db->select('site_id')
			->from('site')
			->where('site_path',$path)
			->get();
		if($r = $query->result()){
			return $r[0]->site_id;
		}else{
			return false;
		}


	}

	public function getSettingNameById($id='')
	{
		$query = $this->db->select('setting_name')
			->from('site_setting')
			->where('id',$id)
			->get();
		if($r = $query->result()){
			return $r[0]->setting_name;
		}else{
			return false;
		}


	}
	public function getSettings($info=false,$siteId = 1)
	{
		if ($info && is_string($info)) {

			$query = $this->db->select('page_content')
				->from('pages')
				->where(array('page_title'=>$info,'site_id'=>$siteId))
				->get();
			return $query->result();
			}
		return false;


	}

	public function getsiteSettings($siteId = 1,$parent = 0)
	{

			$query = $this->db->select('*')
				->from('site_setting')
				->where(array('parent_id'=>$parent,'site_id'=>$siteId))
				->get();
			return $query->result();


	}
	public function getallSettings($info=false,$siteId = 1)
	{
		if($this->permission->is_admin()){
			$query =  $this->db->get_where('site_setting',array('parent_id <>'=>0));
			return $query->result();

		}
		if ($info && is_string($info)) {

			$query = $this->db->select('*')
				->from('site_setting')
				->where(array('site_id'=>$siteId))
				->get();
			return $query->result();
			}
		return false;


	}

	public function getaboutSettings($info=false,$siteId = 1)
	{
		if($this->permission->is_admin()){
			$query =  $this->db->get_where('site_setting',array('parent_id '=>1));
			return $query->result();

		}
		if ($info && is_string($info)) {

			$query = $this->db->select('*')
				->from('site_setting')
				->where(array('site_id'=>$siteId))
				->get();
			return $query->result();
			}
		return false;


	}


	public function getservicesSettings($info=false,$siteId = 1)
	{
		if($this->permission->is_admin()){
			$query =  $this->db->get_where('site_setting',array('parent_id '=>2));
			return $query->result();

		}
		if ($info && is_string($info)) {

			$query = $this->db->select('*')
				->from('site_setting')
				->where(array('site_id'=>$siteId))
				->get();
			return $query->result();
			}
		return false;


	}


}