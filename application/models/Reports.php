<?php 

/**
 * 
 */
 class Reports extends CI_Model
 {

 	public function brokenLink()
 	{
 		# code...
 		$query = $this->db->select('videos.video_id,title,video_reports.source_id,count(*) as reports')
 			->from('video_reports')
 			->join('videos','videos.video_id = video_reports.video_id','left')
 			->group_by('videos.video_id,video_reports.source_id')
 			->order_by('reports','desc')
 			->get();
 			return $query->result();
 	}

 } 

