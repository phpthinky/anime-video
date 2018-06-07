<?php 

/**
* 
*/
class Video extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if (!$this->permission->is_loggedin())
		redirect();

		$this->load->model('video_m');

	}
	public function index($value='')
	{
		# code...
		$data['site_title'] = 'Add new of video.';
		$this->template->load('admin','admin/anime/new',$data);
	}
	public function info($video_id=0)
	{
		# code...
		$_SESSION['newepisode'] = 0;
		$data['video_id'] = $video_id;
		$info = $this->video_m->getVideo($video_id);
		//var_dump($info);

		//if($videos = $this->video_m->getEpisodes($video_id)){

		//}else{
			$parent = $this->video_m->getParent($video_id);
			$videos = $this->video_m->getEpisodes($parent);
			$data['parent_video_id'] = $parent;
		//}
//var_dump($videos);exit();
		$data['total_episodes'] = count($videos);
		$data['list_episodes'] = $videos;

		$data['links'] = $this->video_m->list_link($video_id);

		$data['infos'] = isset($info[0]) ? $info[0] : false;

		$data['site_title'] = 'Information';
		$this->template->load('admin','admin/anime/info',$data);
	}
	public function episodes($video_id=false)
	{
		# code...
		$episodes = false;
		if($video_id){

			$parent = $this->video_m->getParent($video_id);
			$episodes = $this->video_m->getEpisodes($parent);

		}
		$data['parent'] = $parent;
		$data['episodes'] = $episodes;
		$data['site_title'] = 'Arrange episodes';
		$this->template->load('admin','admin/anime/episodes',$data);

	}
	public function changeParent($value='')
	{
				# code...
		if($this->input->post()){

		$oldparent = $this->input->post('parent');
		$parent_video_id = $this->input->post('parent_video_id');
		$info = array('parent_video_id'=>$parent_video_id);
		$isupdated = $this->video_m->update_episode($oldparent,$info);
		 		echo json_encode(array('stats'=>true));
		}else{
				echo $this->noinput();
			}
	}
	public function new_video($value='')
	{
		# code...

		$_SESSION['newepisode'] = 0;
		$data['site_title'] = 'Add new video';
		$this->template->load('admin','admin/anime/new',$data);

	}

	public function add($video_id='')
	{
		$_SESSION['newepisode'] = 0;
		# code...
		//$data['video_id'] = 11;
		$data['site_title'] = 'Add video';
		$this->template->load('admin','admin/anime/add',$data);
	}
	public function saveepisode()
	{
		

		# code...
		if($this->input->post() && $_SESSION['newepisode'] == 0){
		$post = $this->input->post();
		$obj = (object)$post;

		if(empty($obj->txtepisodetitle)){
			echo json_encode(array('stats'=>false,'msg'=>'Video title is required.'));
			exit();
		}
		if(empty($obj->txtlink) && empty($obj->txtembed)){

			echo json_encode(array('stats'=>false,'msg'=>'Video source url or embed is required.'));
			exit();
		}

		if($obj->videosource == 0){

			echo json_encode(array('stats'=>false,'msg'=>'No video source selected.'));
			exit();
		}
		$embed = $obj->txtembed;
		$thumbnail = '';
		if(!empty($obj->txtlink)){
			if($obj->videosource == 1){
				$link_id = str_replace('https://www.mp4upload.com/', '', $obj->txtlink);
			$embed = '<iframe class="watch watch-pc" src="https://www.mp4upload.com/embed-'.$link_id.'.html"></iframe>';

			}
			if($obj->videosource == 2){
				$link_id = str_replace('https://youtu.be/', '', $obj->txtlink);
				if($link_id != $obj->txtlink){
					$link_id = strstr($link_id, '?', true) ? : $link_id;
				}
				if($link_id == $obj->txtlink){

					$link_id = str_replace('https://www.youtube.com/watch?', '', $link_id);
					parse_str($link_id,$arr);
					$link_id = $arr['v'];
				}

			$embed = '<iframe class="watch watch-pc" src="https://www.youtube.com/embed/'.$link_id.'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
			$thumbnail =  "https://img.youtube.com/vi/$link_id/hqdefault.jpg";
			}

			if($obj->videosource == 3){
				$link_id = urlencode($obj->txtlink);

			$embed = '<iframe class="watch watch-pc" src="https://www.facebook.com/plugins/video.php?href='.$link_id.'&mute=0" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe>';

			}

			
			if($obj->videosource == 4){

				$link_id = str_replace('https://www.dailymotion.com/video/', '', $obj->txtlink);

			$embed = '<iframe class="watch watch-pc" src="https://www.dailymotion.com/embed/video/'.$link_id.'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

			}

			if($obj->videosource == 5){

				$link_id = str_replace('https://openload.co/f/', '', $obj->txtlink);

			$embed = '<iframe class="watch watch-pc" src="https://openload.co/embed/'.$link_id.'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>';

			}
			if($obj->videosource == 6){
				$link_id = str_replace('https://drive.google.com/open?id=', '', $obj->txtlink);
				if($obj->txtlink != $link_id){

					$embed = '<iframe class="watch watch-pc" src="https://drive.google.com/file/d/'.$link_id.'/preview?autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

				}else{
					$link_id =  str_replace('view?usp=sharing', '', $obj->txtlink);

					$embed = '<iframe class="watch watch-pc" src="'.$link_id.'/preview" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

				}
				
			}
			}
			$vid = $this->video_m->getVideo($obj->video_id);


			$input = array(
				'title'=>$obj->txtepisodetitle,
				'slug'=>$this->slug->create($obj->txtepisodetitle.' no '.$obj->txtepisodenumber),
				'tags'=>$obj->txttags,
				'embed'=>$embed,
				'link'=>$obj->txtlink,
				'thumbnail'=>$thumbnail,	
				'source_id'=>$obj->videosource,			
				'date_added'=>date('Y:m:d h:j:s'),
				'episode_number'=>$obj->txtepisodenumber,
				'sypnosis'=>$obj->syspnosis,
				'video_type'=>(isset($vid[0]->video_type) ? $vid[0]->video_type: 1),
				);
			usleep(2000000);
			if($is_added = $this->video_m->save($input)){
			    $_SESSION['newepisode'] = 1;
				$parent_video_id = $obj->video_id;
				if($hasparent = $this->video_m->getParent($obj->video_id)){
				
				$parent_video_id = $hasparent;
				}
				$input2 = array(
					'video_id'=>$is_added,
					'parent_video_id'=>$parent_video_id,
					'source_id'=>$obj->videosource,
					'episode'=>$obj->txtepisodenumber
					);
				$saveEp = $this->video_m->addEpisodes($input2);
				echo json_encode(array('stats'=>true,'msg'=>"Video added successfully.",'video_id'=>$is_added));
				exit();
			}else{
				echo json_encode(array('stats'=>false,'msg'=>"Video is not added.",'video_id'=>$is_added));
			}


		exit();
		}

		echo $this->noinput();
	}
	public function noinput()
	{
		# code...
		return  json_encode(array('stats'=>false,'msg'=>'No input received'));
	}
	public function savevideo()
	{
		# code...
		if($this->input->post()){
		$post = $this->input->post();
		$obj = (object)$post;

		if(empty($obj->txttitle)){
			echo json_encode(array('stats'=>false,'msg'=>'Video title is required.'));
			exit();
		}
		if(empty($obj->txtlink) && empty($obj->txtembed)){

			echo json_encode(array('stats'=>false,'msg'=>'Video source url or embed is required.'));
			exit();
		}

		if($obj->videosource == 0){

			echo json_encode(array('stats'=>false,'msg'=>'No video source selected.'));
			exit();
		}
		$embed = $obj->txtembed;
		if(!empty($obj->txtlink)){
			if($obj->videosource == 1){
				$link_id = str_replace('https://www.mp4upload.com/', '', $obj->txtlink);
			$embed = '<iframe class="watch watch-pc" src="https://www.mp4upload.com/embed-'.$link_id.'.html"></iframe>';

			}
			if($obj->videosource == 2){
				$link_id = str_replace('https://youtu.be/', '', $obj->txtlink);
				if($link_id != $obj->txtlink){
					$link_id = strstr($link_id, '?', true) ? : $link_id;
				}
				if($link_id == $obj->txtlink){

					$link_id = str_replace('https://www.youtube.com/watch?', '', $link_id);
					parse_str($link_id,$arr);
					$link_id = $arr['v'];
				}

			$embed = '<iframe class="watch watch-pc" src="https://www.youtube.com/embed/'.$link_id.'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

			}

			if($obj->videosource == 3){
				$link_id = urlencode($obj->txtlink);

			$embed = '<iframe class="watch watch-pc" src="https://www.facebook.com/plugins/video.php?href='.$link_id.'" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe>';

			}

			if($obj->videosource == 4){

				$link_id = str_replace('https://www.dailymotion.com/video/', '', $obj->txtlink);

			$embed = '<iframe class="watch watch-pc" src="https://www.dailymotion.com/embed/video/'.$link_id.'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

			}
									
			if($obj->videosource == 5){

				$link_id = str_replace('https://openload.co/f/', '', $obj->txtlink);

			$embed = '<iframe class="watch watch-pc" src="https://openload.co/embed/'.$link_id.'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>';

			}
			if($obj->videosource == 6){
				$link_id = str_replace('https://drive.google.com/open?id=', '', $obj->txtlink);
				if($obj->txtlink != $link_id){

					$embed = '<iframe class="watch watch-pc" src="https://drive.google.com/file/d/'.$link_id.'/preview?autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

				}else{
					$link_id =  str_replace('view?usp=sharing', '', $obj->txtlink);

					$embed = '<iframe class="watch watch-pc" src="'.$link_id.'/preview" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

				}
				
			}
			}
			$input = array(
				'title'=>$obj->txttitle,
				'slug'=>$this->slug->create($obj->txttitle.' no '.$obj->episodenumber),
				'tags'=>$obj->txttags,
				'embed'=>$embed,
				'link'=>$obj->txtlink,
				'source_id'=>$obj->videosource,
				'thumbnail'=>$obj->thumbnail,				
				'date_added'=>date('Y:m:d h:j:s'),
				'video_type'=>$obj->videotype,
				'episode_number'=>$obj->episodenumber,
				'sypnosis'=>$obj->sypnosis
				);
				
			usleep(2000000);
			//$is_added
			if($is_added  = $this->video_m->save($input)){

				$input2 = array(
					'video_id'=>$is_added,
					'parent_video_id'=>$is_added,
					'source_id'=>$obj->videosource,
					'episode'=>$obj->episodenumber
					);
				$saveEp = $this->video_m->addEpisodes($input2);
				echo json_encode(array('stats'=>true,'msg'=>"Video added successfully.",'video_id'=>$is_added));
			}else{
				echo json_encode(array('stats'=>false,'msg'=>"Video is not added.",'video_id'=>0));
			}

		exit();
		}
			echo json_encode(array('stats'=>false,'msg'=>'No input received.'));

	}

	public function save_source($value='')
	{
		# code...
		$obj = (object)$this->input->post();

		$embed = $obj->txtembed;
		if(!empty($obj->txtlink)){
			if($obj->videosource == 1){
				$link_id = str_replace('https://www.mp4upload.com/', '', $obj->txtlink);
			$embed = '<iframe class="watch watch-pc" src="https://www.mp4upload.com/embed-'.$link_id.'.html"></iframe>';

			}
			if($obj->videosource == 2){
				$link_id = str_replace('https://youtu.be/', '', $obj->txtlink);
				if($link_id != $obj->txtlink){
					$link_id = strstr($link_id, '?', true) ? : $link_id;
				}
				if($link_id == $obj->txtlink){

					$link_id = str_replace('https://www.youtube.com/watch?', '', $link_id);
					parse_str($link_id,$arr);
					$link_id = $arr['v'];
				}

			$embed = '<iframe class="watch watch-pc" src="https://www.youtube.com/embed/'.$link_id.'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

			}

			if($obj->videosource == 3){
				$link_id = urlencode($obj->txtlink);

			$embed = '<iframe class="watch watch-pc" src="https://www.facebook.com/plugins/video.php?href='.$link_id.'&mute=0" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe>';

			}

			if($obj->videosource == 4){

				$link_id = str_replace('https://www.dailymotion.com/video/', '', $obj->txtlink);

			$embed = '<iframe class="watch watch-pc" src="https://www.dailymotion.com/embed/video/'.$link_id.'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

			}
									
			if($obj->videosource == 5){

				$link_id = str_replace('https://openload.co/f/', '', $obj->txtlink);

			$embed = '<iframe class="watch watch-pc" src="https://openload.co/embed/'.$link_id.'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>';

			}
			if($obj->videosource == 6){
				$link_id = str_replace('https://drive.google.com/open?id=', '', $obj->txtlink);
				if($obj->txtlink != $link_id){

					$embed = '<iframe class="watch watch-pc" src="https://drive.google.com/file/d/'.$link_id.'/preview?autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

				}else{
					$link_id =  str_replace('view?usp=sharing', '', $obj->txtlink);

					$embed = '<iframe class="watch watch-pc" src="'.$link_id.'/preview" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

				}
				
			}


		if($if_not_exist = $this->video_m->mirrorExist($obj->video_id,$obj->videosource)){

		}else{
		$input = array('video_id'=>$obj->video_id,'link'=>$obj->txtlink,'embed'=>$embed,'source_id'=>$obj->videosource);
		$mirror = $this->video_m->saveMirror($input);
		//var_dump($mirror);
		redirect("video/info/$obj->video_id");
		}
		}
	}

	public function saveEmbed()
	{
		# code...
		if($this->input->post()){

		$video_id = $this->input->post('video_id');
		$embed = $this->input->post('embed');
		$embeded = array('embed'=>$embed);
		$isupdated = $this->video_m->update_video($video_id,$embeded);
		 		echo json_encode(array('stats'=>true));
		}else{
				echo $this->noinput();
			}
	}
	public function change_link($value='')
	{
		# code...
		if($this->input->post()){
			$obj = (object)$this->input->post();

			if($obj->video_link == 1){
				$link_id = str_replace('https://www.mp4upload.com/', '', $obj->txtlink);
			$embed = '<iframe class="watch watch-pc" src="https://www.mp4upload.com/embed-'.$link_id.'.html"></iframe>';

			}
			if($obj->video_link == 2){
				$link_id = str_replace('https://youtu.be/', '', $obj->txtlink);
				if($link_id != $obj->txtlink){
					$link_id = strstr($link_id, '?', true) ? : $link_id;
				}
				if($link_id == $obj->txtlink){

					$link_id = str_replace('https://www.youtube.com/watch?', '', $link_id);
					parse_str($link_id,$arr);
					$link_id = $arr['v'];
				}

			$embed = '<iframe class="watch watch-pc" src="https://www.youtube.com/embed/'.$link_id.'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
			$thumbnail =  "https://img.youtube.com/vi/$link_id/hqdefault.jpg";
			}

			if($obj->video_link == 3){
				$link_id = urlencode($obj->txtlink);

			$embed = '<iframe class="watch watch-pc" src="https://www.facebook.com/plugins/video.php?href='.$link_id.'&mute=0" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe>';

			}

			
			if($obj->video_link == 4){

				$link_id = str_replace('https://www.dailymotion.com/video/', '', $obj->txtlink);

			$embed = '<iframe class="watch watch-pc" src="https://www.dailymotion.com/embed/video/'.$link_id.'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

			}

			if($obj->video_link == 5){

				$link_id = str_replace('https://openload.co/f/', '', $obj->txtlink);

			$embed = '<iframe class="watch watch-pc" src="https://openload.co/embed/'.$link_id.'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>';

			}
			if($obj->video_link == 6){
				$link_id = str_replace('https://drive.google.com/open?id=', '', $obj->txtlink);
				if($obj->txtlink != $link_id){

					$embed = '<iframe class="watch watch-pc" src="https://drive.google.com/file/d/'.$link_id.'/preview?autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

				}else{
					$link_id =  str_replace('view?usp=sharing', '', $obj->txtlink);

					$embed = '<iframe class="watch watch-pc" src="'.$link_id.'/preview" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

				}
				
			}

			if($obj->video_link == 7){
				$link_id = $obj->txtlink;//str_replace('https://drive.google.com/open?id=', '', $obj->txtlink);
				

					$embed = '<video controls autoplay style="width;100%;"><source src="">Not supported</video>';

				
				
			}

			if($obj->video_link == 8){
				$link_id = str_replace('https://vimeo.com/', '', $obj->txtlink);
				$embed ='<iframe src="https://player.vimeo.com/video/273708634" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
<p><a href="https://vimeo.com/273708634">BC-21</a> from <a href="https://vimeo.com/user85930978">Roy Rita</a> on <a href="https://vimeo.com">Vimeo</a>.</p>';
			}


				$embeded = array('embed'=>$embed,'link'=>$obj->txtlink,'source_id'=>$obj->video_link);
				if($isupdated = $this->video_m->update_video($obj->video_id,$embeded)){
					echo json_encode(array('stats'=>true));
				}else{
					echo json_encode(array('stats'=>false));
				}

		}else{
			return $this->noinput();
		}
	}
	public function ytthumb()
	{
		# code...
		if($this->input->post()){

		$post = $this->input->post();
		$obj = (object)$post;
			if($obj->videosource == 2){
				$link_id = str_replace('https://youtu.be/', '', $obj->txtlink);
				if($link_id != $obj->txtlink){
					$link_id = strstr($link_id, '?', true) ? : $link_id;
				}
				if($link_id == $obj->txtlink){

					$link_id = str_replace('https://www.youtube.com/watch?', '', $link_id);
					parse_str($link_id,$arr);
					$link_id = $arr['v'];
				}

				echo "https://img.youtube.com/vi/$link_id/hqdefault.jpg";
			}

			exit();
		}
	}

	public function upload(){

		if($this->input->post()) {
			$dir = $this->input->post('type');
			$target_dir = UPLOADPATH."/$dir/";
			$target_file = $target_dir . basename($_FILES["upload"]["name"]);
			//$image_name = basename($_FILES["upload"]["name"]);
			$uploadOk = 1;
			$error = '';

    		$check = getimagesize($_FILES["upload"]["tmp_name"]);

				$image = basename($_FILES["upload"]["name"]);
				$info = pathinfo($image);		
				// get the filename without the extension
				$image_name =  basename($image,'.'.$info['extension']);
				// get the extension without the image name
				$exp = explode('.', $image);
				$ext = end($exp);

    			$image_url = $image_name.'.'.$ext;
    			
		    if($check !== false) {
		        //$error .= "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        $error .= "File is not an image.<br />";
		        $uploadOk = 0;
		    }

			// Check file size
			if ($_FILES["upload"]["size"] > 1500000) {
			    $error .= "Sorry, your file is too large.<br />";
			    $uploadOk = 0;
			}

		    // Check if file already exists
			if (file_exists($target_file)) {
			  
    			$uniqid = uniqid();
    			$target_file = $target_dir.$image_name.'-'.$uniqid.'.'.$ext;
    			$image_url = $image_name.'-'.$uniqid.'.'.$ext; 
			}
			if($uploadOk == 0){
				echo json_encode(array('stats'=>false,'msg'=>$error));
			}else{

				 if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
			       
				echo json_encode(array('stats'=>true,'msg'=>base_url('public/'.$dir.'/'.urlencode($image_url))));
			    } else {
			        
				echo json_encode(array('stats'=>false,'msg'=>"Sorry, there was an error uploading your file."));

			    }
			}
		}
	}

	public function change_thumb($value='')
	{
		# code...
		$video_id = $this->input->post('video_id');
		$thumb = $this->input->post('thumbnail');
		$thumbnail = array('thumbnail'=>$thumb);
		$isupdated = $this->video_m->update_video($video_id,$thumbnail);
		echo json_encode(array('stats'=>true));
	}

	public function search($value='')
	{
		# code...
		if($this->input->post()){
			$q = $this->input->post('q');
			$slug = $this->slug->create($q);

			$keywords = explode('-', $slug);
			$infos = false;
			$keys = false;
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
					}

					}
				}




			echo json_encode(array('stats'=>true,'msg'=>$infos));

			/*if($video = $this->video_m->searchVideo($key)){
			echo json_encode(array('stats'=>true,'msg'=>$video));
				}
		}
			else{

			echo json_encode(array('stats'=>false,'msg'=>'No existing video found'));
			}*/
		}
	}


		public function cover_page($video_id=0)
	{
		# code...
		$info = false;
		$data['cover_page'] = false;
		if($video_id > 0){

			$video = $this->video_m->getVideo($video_id);
			$data['video_info'] = $video[0];

			if($cover_page = $this->video_m->getCoverInfo($video_id)){

			$data['cover_page'] = $cover_page[0];
			}
			
		}
		$data['video_id'] = $video_id;
		$data['site_title'] = 'Cover page';
		$this->template->load('admin','admin/anime/cover',$data) ;
	}
	public function save_cover($value='')
	{
		# code...

		//echo json_encode(array('stats'=>true,'cover'=>$_FILES['cover']));
		//exit();
		if($this->input->post()){
			$obj = (object)$this->input->post();
			$video_id = $obj->video_id;

			//echo "$video_id";exit();
			$data = array(
				'video_id'=>$video_id,
				'cover_title'=>$obj->cover_title,
				'thumbnail'=>$obj->cover_thumbnail,
				'synopsis'=>$obj->cover_synopsis,
				'genre'=>$obj->cover_genre,
				'released_date'=>$obj->release_date.' '.$obj->release_time,
				'expired_on'=>$obj->expired_date.' '.$obj->expired_time
				);
			$update = $this->video_m->saveCoverInfo($video_id,$data);
			redirect('video/cover_page/'.$video_id);
			
		}
	}
		public function anime($value='')
	{
		# code...
		$data['list_video'] = $this->video_m->list_anime();
		$data['site_title'] = 'List uploaded videos by letters';
		$this->template->load('admin','admin/anime/list',$data) ;
	}
	public function movies($value='')
	{
		# code...
		$data['list_video'] = $this->video_m->list_movies();
		$data['site_title'] = 'List uploaded videos by letters';
		$this->template->load('admin','admin/anime/list',$data) ;
	}


	public function reports(){
		$this->load->model('reports');
		$data['brokenlink'] = $this->reports->brokenLink();
		$data['site_title'] = 'List of reported video';
		$this->template->load('admin','admin/reports/video_error',$data);
	}


}

