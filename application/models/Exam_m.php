<?php 

/**
* 
*/
class Exam_m extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}
	public function examType()
	{
		# code...
		return $this->db->get('exam_type')->result();
	}

	public function getExamById($exam_id=0)
	{
		# code...
		if($exam_id > 0){
			$result = $this->db->get_where('quizes_setting',array('exam_id'=>$exam_id));
			
				return $result->result();

		}
		return false;
	}

	public function getExamCategories($exam_id=0)
	{
		if($exam_id > 0){
			$result = $this->db->get_where('exam_setting',array('exam_id'=>$exam_id));
			
				return $result->result();
		}
			return false;
	}

	public function randomByCategorysas($exam_id=0,$category_id = 0)
	{
		# code...
		//return  $category_id;

		$object = false;

		$is_shuffle = 0;
		if($q_shuffle = $this->db->get_where('exam_setting',array('exam_id'=>$exam_id,'category_id'=>$category_id))){

			if($shuffle = $q_shuffle->result()){
				
			$is_shuffle = $shuffle[0]->is_shuffle;
			}
		}

				# code...
				$query2 = '';
				$result2 = '';

				$query2 = $this->db->select('quiz.*,quizes.category_id,category.cat_name as category_name')
					->from('quiz')
					->join('quizes','quizes.quiz_id = quiz.quiz_id','left')
					->join('category','category.cat_id = quizes.category_id','left')
					->where(array('quizes.exam_id'=>$exam_id,'quizes.category_id'=>$category_id))
					->order_by('quizes.category_id','ASC')
					->get();
					if($result2 = $query2->result())
					{
						shuffle($result2);
									foreach ($result2 as $key) {
										# code...
										$choice = '';
										$s_choice = '';

										$choice = array(
											$key->post_answer,
											$key->post_choice1,
											$key->post_choice2,
											$key->post_choice3,
											$key->post_choice4);

										if((int)$is_shuffle == 0 && (int)$category_id != 17){

										shuffle($choice);
										}elseif ((int)$category_id == 17){
											$choice = array('No. 1','No. 2','No. 3','No. 4','No. 5');
										}
										
										
										$object[] = (object) array(
											'quiz_id'=>$key->quiz_id,
											'question'=>$key->post_question,
											'choice_1' =>$choice[0],
											'choice_2' =>$choice[1],
											'choice_3' =>$choice[2],
											'choice_4' =>$choice[3],
											'choice_5' =>$choice[4],
											'category_id'=>$key->category_id,
											'category_name'=>$key->category_name,
											'q_id'=>$key->token
										);
									}
					}

		return $object;

	}


	public function randomByCategory($exam_id=0,$category_id = 0)
	{
		# code...
		//return  $category_id;

		$object = false;

		$is_shuffle = 0;
		if($q_shuffle = $this->db->get_where('exam_setting',array('exam_id'=>$exam_id,'category_id'=>$category_id))){

			if($shuffle = $q_shuffle->result()){
				
			$is_shuffle = $shuffle[0]->is_shuffle;
			}
		}

				$query2 = '';
				$result2 = '';
				$query = $this->db->select('exam_id, quiz.quiz_id,quiz.post_question,GROUP_CONCAT('.$this->db->dbprefix('quiz_choices').
					'.choice_label separator "~") as choices')
					->from('quiz')
					->join('quiz_choices','quiz_choices.quiz_id = quiz.quiz_id','left')
					->join('quizes','quizes.quiz_id = quiz.quiz_id','left')
					->where(array('quizes.exam_id'=>$exam_id,'quizes.category_id'=>$category_id))
					->order_by('category_id')
					->group_by('quiz.quiz_id')
					->get();
					
					if($result2 = $query->result())
					{
						shuffle($result2);
									foreach ($result2 as $key) {
										$choices = '';
										$choices = explode('~', $key->choices);
										if($is_shuffle == 0){
											shuffle($choices);
										}
										$object[] = (object) array(
											'quiz_id'=>$key->quiz_id,
											'question'=>$key->post_question,
											'choices' =>$choices
										);

									}
					}
					//var_dump($object);
					//exit();
		return $object;

	}

	public function get_results($user_exam_id = 0,$category_id = 0,$exam_id = 0)
	{
		if($user_exam_id > 0 && $category_id > 0){
			$correct_answer = 0;
			$query = $this->db->get_where('user_exam_answer',array('user_exam_id'=>$user_exam_id,'category_id'=>$category_id));
				if($result = $query->result()){

						foreach ($result as $key) {
							# code...
							if($correct_answer_id = $this->get_answerbyid($key->quiz_id,$category_id)){
								if((int)$correct_answer_id == (int)$key->answer_id){
									$correct_answer ++;
								}

							//echo "$key->quiz_id | $category_id | $key->answer_id vs $correct_answer_id <br />";
							}
							usleep(50000);
						}
				}

				$this->save_result($user_exam_id,$category_id,$exam_id,$correct_answer);
				return $correct_answer;

			

		}else{
			return false;
		}
	}
	public function save_result($user_exam_id = 0,$category_id = 0,$exam_id = 0,$total = 0,$timer_finnish=false)
	{
		if(!empty($timer_finnish)){

			$data = array(
				'user_exam_id'=>$user_exam_id,
				'category_id'=>$category_id,
				'exam_id'=>$exam_id,
				'result'=>0,
				'timer_finnish'=>$timer_finnish
			);
			$this->db->insert('user_exam_result',$data);
			return true;

		}else{
			$data = array(
				'user_exam_id'=>$user_exam_id,
				'category_id'=>$category_id,
				'exam_id'=>$exam_id
			);
			return $this->db->set('result',$total)
				->where($data)
				->update('user_exam_result');
		}
	}
	public function save_final_result($user_exam_id = 0,$result=0)
	{
		# code...
		$this->db->set("result",$result);
		$this->db->where('user_exam_id',$user_exam_id);
		return $this->db->update('user_exam');

	}

	public function saveAnswer($user_exam_id=false,$category_id=false,$user_id=false,$answer=false,$quiz_id=false)
	{
		# code...


			$this->db->select('choice_id');
			$query1 = $this->db->get_where('quiz_choices',array('choice_label'=>$answer,'quiz_id'=>$quiz_id));
			if($result = $query1->result()){

			$data = array(
				'user_exam_id'=>$user_exam_id,
				'category_id'=>$category_id,
				'answer_id'=>$result[0]->choice_id,
				'quiz_id'=>$quiz_id
			);
			return $this->db->insert('user_exam_answer',$data);
			}
			return false;

	}


	public function get_answerbyid($quiz_id=0,$category_id = 0)
	{
		# code...
		if($quiz_id > 0){
			$query = $this->db->select('choice_id')
			->from('quiz')
			->join('quizes','quizes.quiz_id = quiz.quiz_id','left')
			->where(array('quiz.quiz_id'=>$quiz_id,'quizes.category_id'=>$category_id))
			->get();
			if($result = $query->result()){
				return $result[0]->choice_id;
			}
		}else{
			return 0;
		}
	}

	public function get_ratings($user_id=0)
	{
		
		if($user_id > 0){
			$query = $this->db->select('user_exam.exam_id,count("user_exam.exam_id") as retake_total,MAX(result) as results,quizes_title as exam_title')
				->from('user_exam')
				->join('quizes_setting','quizes_setting.exam_id = user_exam.exam_id','LEFT')


				->where('user_id',$user_id)
				->group_by('exam_id')
				//->order_by('result','DESC')
				->get();

				return $query->result();
				
		}
		return false;
	}

	public function is_publish($status = 0,$exam_id=0){
		if($exam_id > 0){

		$this->db->where('exam_id',$exam_id);
		return $this->db->update('quizes_setting',array('status'=>$status));
		}else{
			return false;
		}
	}

	public function update_exam($exam_id=0,$category_id=0,$total=0){
		if($exam_id > 0 && $category_id > 0){

		$this->db->where(array('exam_id'=>$exam_id,'category_id='=>$category_id));
		return $this->db->update('exam_setting',array('exam_total'=>$total));
		}else{
			return false;
		}
	}

	public function is_title_exist($title,$exam_id=0){
		if($exam_id > 0){
		$query =  $this->db->get_where('quizes_setting',array('quizes_title'=>$title,'exam_id != ' =>$exam_id));
		return $query->num_rows();
		}else{

		$query =  $this->db->get_where('quizes_setting',array('quizes_title'=>$title));
		return $query->num_rows();
		}
	}

	public function update($exam_id=0,$data=''){
		
		$this->db->where('exam_id',$exam_id);
		$this->db->update('quizes_setting',$data);
		$error = $this->db->error();
		if(!empty($error['code']) ){
			return $error['message'];
		}else{
			return true;
		}
	}
	


}



	/*
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
	*/