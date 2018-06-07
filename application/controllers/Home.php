<?php 

/**
* 
*/
class Home extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}
	public function index($value='')
	{
		# code...
		$this->load->model('video_m');
		$views = $this->video_m->list_most_views();
		$data['list_mostviews'] = $views;
		$data['livechart'] = $this->cover();
		$data['site_title'] = 'Watch Video Chart';
		$this->template->load('default','home/index',$data);
	}
	public function login($page='home')
	{

		if($this->permission->is_loggedIn()){

			redirect($page);
		}
		


		$data['site_title'] = 'Login';
		$this->template->load(false,'home/login',$data);

	}

	public function check_login($value='')
	{
		if ($this->input->post()) {
			$user = $this->input->post('user_name');
			$pass = $this->input->post('user_pass');
			//$is_found = $this->permission->login($user,$pass);

			//var_dump($is_found);
			if($is_found = $this->permission->login($user,$pass)){
				$this->session->userdata['is_logged_in'] = true;

				echo json_encode(array('stats'=>true,'msg'=>'Login successful.'));
			}else{
				$this->session->userdata['is_logged_in'] = false;
				echo json_encode(array('stats'=>false,'msg'=>'Login unsuccessful.','loginned'=>$this->permission->is_loggedin()));

			}



		}
	}
	public function logout($value='')
	{
		$this->permission->logout();
		redirect();
	}

	public function search($value='')
	{
		# code...
		$this->load->model('video_m');
		if($this->input->get()){
			$q = $this->input->get('q');
			$slug = $this->slug->create($q);

			$keywords = explode('-', $slug);
			$infos = false;
			$keys = false;
			$_SESSION['tbltemp'] = 0;

			$drop = 'DROP TABLE IF EXISTS `q_mytemp`';
			$this->db->query($drop);

			foreach ($keywords as $key) {
				# code...
				if($videos = $this->video_m->searchVideo($key)){

					//$infos[] = $videos;
					foreach ($videos as $value) {
						# code...
						if($keys){
							if(in_array($value->video_id, $keys)){

							}else{

							$infos[] = $value;
							}
						}else{

						$infos[] = $value;
						}
						

						$keys[] = $value->video_id;

						$this->video_m->temp(array('video_id'=>$value->video_id));
					}

					}
				}


				$data['search_result'] = $this->video_m->tempOutput();

			
		}
		$data['site_title'] = "Search Video";
		$this->template->load('default','home/search',$data);
	}

	public function policy($value='')
	{
		# code...
		$data['site_title'] = 'Disclaimer & Policy';
		$this->template->load('default','home/policy',$data);
	}

	function cover($value='')
	{
		# code...
		$this->load->model('video_m');
		$video = $this->video_m;
		return $video->displayCoverpage();

	}

	public function reader($video=false)
	{
		if($video){
			$this->load->model('video_m');
			$link = $this->video_m->getLink($video);
			$base = base_url();
		    $file=str_replace($base,'',$video);

			header('Content-Type: video/mp4'); #Optional if you'll only load it from other pages
			header('Accept-Ranges: bytes');
			header('Content-Length:'.filesize($file));

			readfile($file);
		}
	    


	}
	public function viewer(){
		$url = 'black-clover-18.mp4';
		//$video = $this->reader($url);
		$url = site_url('home/reader?file='.urlencode($url));//exit();
		$data['video'] =  "<iframe src='".$url."'>
			</iframe>";
		$this->template->load('default','watch/viewer',$data);
	}
	function _mime_content_type($filename) {
    $result = new finfo();

    if (is_resource($result) === true) {
        return $result->file($filename, FILEINFO_MIME_TYPE);
    }

    return false;
	}
	public function video_url(){
		//echo base_url('public/uploads/video/black-clover-18.mp4');
		$video = $this->input->post('video');
		echo site_url('home/reader/'.$video);
	}
}