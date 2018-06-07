<?php 

/**
* 
*/
class Livechart extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}
	public function index($value='')
	{
		# code...
		//$this->restart();
		$livechart = $this->cover();
			$desc = false;
		if(is_array($livechart)){
			$desc = '';
			$i=0;
			foreach ($livechart as $key) {
				# code...
				$desc .= $key->cover_title;
				$i++;
				if($i < count($livechart)){
					$desc .= ', ';
				}
			}
		}


		//$data['fbshare'] = true;

		$data['description'] = $desc;
		$data['meta_title'] ='Watch School XYZ anime live Chart';
		$data['link'] = site_url('livechart');
		$data['featured_image'] = 'https://myanimelist.cdn-dena.com/images/anime/1866/91270.jpg';


		$data['livechart'] = $livechart ;
		$data['site_title'] = 'Watch School XYZ anime live Chart';
		$this->template->load('default','home/livechart',$data);
	}


	function cover($value='')
	{
		# code...
		$this->load->model('video_m');
		$video = $this->video_m;
		return $video->displayCoverpage();

	}
	public function restart($value='')
	{
		# code...
		if (!$this->permission->is_loggedin())
		redirect();
		$this->load->model('statistics');
		$stat = $this->statistics;
		if($status = $stat->restartliveChart()){
			$data['message'] = 'Live chart restarted.' ;
		}else{

			$data['message'] = $status ;
		}

		//redirect('admin');
		$data['site_title'] = 'Restart live chart';
		$this->template->load('admin','admin/livechart/reset',$data);
	}
}