<?php 

/**
* 
*/
class Statistics extends CI_Model
{
	
	function saveViews($video_id=0)
	{
		# code...
		if($video_id > 0){
			//$query = $this->db->get_where('video_statistics',$video_id);
			$query = $this->db->select('*')->from('video_statistics')->where('video_id',$video_id)->get();
			if($query->result()) {
				# code...
				$this->db->set('counter','counter+1',false);
				$this->db->where('video_id',$video_id);
				$this->db->update('video_statistics');

				return $this->db->error();
			}else{
				$this->db->insert('video_statistics',array('video_id'=>$video_id,'counter'=>1));

				return $this->db->error();
			}
			
		}
	}
	public function getVideoStatitics($limit=50,$offset=0)
	{
		# code...
		$query = $this->db->select('videos.video_id,title,counter')
			->from('videos')
			->join('video_statistics','video_statistics.video_id = videos.video_id')
			->order_by('counter','desc')
			->limit($limit)
			->get();
			return $query->result();
	}

	public function restartliveChart($value='')
	{
		# code...
		$td = date('Y-m-d');
		$q1 = $this->db->select('video_id,expired_on')
				->from('video_cover')
				->where("date_format(date(expired_on),'%Y-%m-%d') < ", $td,true)
				->where('status',0)
				->get();
		if($r1 = $q1->result()){
			$q2 = sprintf("UPDATE q_video_cover set released_date = expired_on, expired_on = DATE_ADD(expired_on,INTERVAL 7 DAY) where video_id = %d ",$r1[0]->video_id);
			$this->db->query($q2);
		}

	}
}