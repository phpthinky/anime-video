<?php 

/**
* 
*/
class Userexam_m extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}
	public function start_user_exam($exam_id=0,$category_id=0,$user_id)
	{

		if($exam_id > 0 && $user_id > 0){
			$this->db->insert('user_exam',array('user_id'=>$user_id,'exam_id'=>$exam_id,'date_taken'=>date('Y-m-d h:i:s')));
			return $this->db->insert_id();
		}
	}
		public function start_new_exam($exam_id=0,$category_id=0,$user_id)
	{
		# code...
		if($exam_id > 0 && $category_id > 0 && $user_id > 0){
			$this->db->insert('user_exam',array('user_id'=>$user_id,'exam_id'=>$exam_id,'date_taken'=>date('Y-m-d h:i:s')));
			return $this->db->insert_id();
		}
	}


	public function saveAnswer($user_exam_id=0,$category_id=0,$user_id=0,$answer='',$quiz_id=0)
	{
		# code...
		if($user_exam_id > 0 && $category_id > 0 && $user_id > 0 && !empty($answer) && $quiz_id > 0){
			
			$this->db->select('choice_id');
			$query1 = $this->db->get_where('quiz_choices',array('choice_label'=>$answer,'quiz_id'=>$quiz_id));
			if($result = $query1->result()){

					$choice_id = $result[0]->choice_id;

					$if_exist = array('category_id'=>$category_id,'user_exam_id'=>$user_exam_id,'quiz_id'=>$quiz_id);
					
					//$this->db->select('count(*) as answered');
					$query2 = $this->db->get_where('user_exam_answer',$if_exist);

					if($query2->result()){
						$this->db->where($if_exist);
						return $this->db->update('user_exam_answer',array('answer_id'=>$choice_id));
					}else{
						$data2 = array('category_id'=>$category_id,'user_exam_id'=>$user_exam_id,'quiz_id'=>$quiz_id,'answer_id'=>$choice_id);
						return $this->db->insert('user_exam_answer',$data2);
					}
			}

		}
	}

	public function best_rating($user_id = 0)
	{
		if($user_id > 0){
			$query = $this->db->select('user_exam_id,user_exam.exam_id,quizes_title,count("user_exam.exam_id") as retake_total,MAX(result) as results,date_taken')
				->from('user_exam')
				->join('quizes_setting','quizes_setting.exam_id = user_exam.exam_id','LEFT')


				->where('user_id',$user_id)
				//->group_by('result')
				->order_by('result','DESC')
				->get();

				return $query->result();
				
		}
	}

	public function rating_by_exam_id($user_id = 0,$exam_id=0,$dsort=false,$rsort=false)
	{
		if($user_id > 0){
			$this->db->select('user_exam.*,user_exam.exam_id,quizes_title,result,date_taken')
				->from('user_exam')
				->join('quizes_setting','quizes_setting.exam_id = user_exam.exam_id','LEFT')


				->where(array('user_id'=>$user_id,'user_exam.exam_id'=>$exam_id));
				//->group_by('result')
				if (strtolower($rsort) == 'date_taken' || strtolower($rsort) == 'result' ) {
					# code...
					if (strtoupper($dsort) == 'ASC') {

					$this->db->order_by($rsort,$dsort);
					}else{

					$this->db->order_by($rsort,'DESC');
						}

				}elseif (strtoupper($dsort) == 'DESC' ||  strtoupper($dsort) == 'ASC') {
					# code...
				$this->db->order_by('date_taken',$dsort);

				}else{
				$this->db->order_by('date_taken','DESC');

				}
				$query = $this->db->get();

				return $query->result();
				
		}
	}
	public function exam_total($exam_id=0)
	{
		# code...
		$query = $this->db->select('sum(exam_total) as total_exam')
			->from('exam_setting')
			->where('exam_id',$exam_id)
			->get();
			if($result = $query->result()){
				return $result[0]->total_exam;
			}
			else{
				return 0;
			}
	}


	public function get_result($exam_id = 0,$category_id = 0,$user_exam_id = 0)
	{
		# code...
		$correct_answer = 0;
		$query = $this->db->select('*')
					->from('user_exam_answer')
					->where(array('user_exam_id'=>$user_exam_id,'category_id'=>$category_id))
					->get();
					if($result = $query->result()){
						foreach ($result as $key) {
							# code...
							if($correct_answer_id = $this->get_answerbyid($key->quiz_id)){
								if((int)$correct_answer_id == (int)$key->answer_id){
									$correct_answer ++;
								}
							}
						}
					}

					return $correct_answer;
	}
	public function get_answerbyid($quiz_id=0)
	{
		# code...
		if($quiz_id > 0){
			$query = $this->db->select('choice_id')
			->from('quiz')
			->where('quiz_id',$quiz_id)
			->get();
			if($result = $query->result()){
				return $result[0]->choice_id;
			}
		}else{
			return 0;
		}
	}
	public function save_result($exam_id = 0,$category_id = 0,$user_exam_id = 0,$result=0,$timer=false)
	{
		# code...
		if($user_exam_id > 0 && $category_id > 0){
			$this->save_final_result($exam_id,$category_id,$user_exam_id,$result);
			return $this->db->insert('user_exam_result',array('user_exam_id'=>$user_exam_id,'category_id'=>$category_id,'result'=>$result,'exam_id'=>$exam_id,'timer_finnish'=>$timer));
		}
		return false;
	}
	public function save_final_result($exam_id = 0,$category_id = 0,$user_exam_id = 0,$result=0)
	{
		# code...
		$this->db->set("result","result + $result", FALSE);
		$this->db->where('user_exam_id',$user_exam_id);
		return $this->db->update('user_exam');

	}

}