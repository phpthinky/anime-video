<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Quiz_m extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}
	public function add_quiz($data=false)
	{

			$this->db->insert('quiz',$data);
			return $this->db->insert_id();

	}
	public function add_exam($data=false)
	{

			$this->db->insert('quizes_setting',$data);
			return $this->db->insert_id();

	}
	public function update_exam($data=false,$exam_id=0)
	{
			$this->db->where('exam_id',$exam_id);
			return $this->db->update('quizes_setting',$data);

	}
		public function update_quiz($data=false,$quiz_id=0)
	{
			$this->db->where('quiz_id',$quiz_id);
			return $this->db->update('quiz',$data);

	}

	public function add_to_exam($data=false)
	{

			return $this->db->insert('quizes',$data);

	}


	public function add_to_exam_setting($data=false)
	{

			return $this->db->insert('exam_setting',$data);

	}

	public function add_to_choices($data=false)
	{

			$this->db->insert('quiz_choices',$data);
			return $this->db->insert_id();

	}
	public function countExamById($exam_id=0)
	{
		

			$this->db->select('count(*) as total')
				->from('quizes')
				->where('exam_id',$exam_id);
			if($result = $this->db->get()->result()){
				return $result[0]->total;
			}else{
				return 0;
			}
	}




	public function countExamByCategory($exam_id=0,$category_id=0)
	{
		

			$this->db->select('count(*) as total')
				->from('quizes')
				->where(array('exam_id'=>$exam_id,'category_id'=>$category_id));
			if($result = $this->db->get()->result()){
				return $result[0]->total;
			}else{
				return 0;
			}
	}

	public function getCategoryName($category_id=0)
	{
		# code...
		if ($category_id > 0) {
			# code...
			$query = $this->db->select('cat_name')
				->from('category')
				->where('cat_id',$category_id)
				->get();
				if($result = $query->result()){
					return $result[0]->cat_name;
				}
				return false;


		}
		return false;
	}
	public function getCategoryDirection($category_id=0,$exam_id=0)
	{
		# code...
		if ($category_id > 0) {
			# code...
			$query = $this->db->select('directions')
				->from('exam_setting')
				->where(array('category_id'=>$category_id,'exam_id'=>$exam_id))
				->get();
				if($result = $query->result()){
					return $result[0]->directions;
				}
				return false;


		}
		return false;
	}


	public function getExamById($exam_id=0)
	{
		

		$this->db->select('quizes_setting.*,COUNT('.$this->db->dbprefix("exam_setting").'.exam_id) as totalexam,, SUM('.$this->db->dbprefix("exam_setting").'.exam_total) as exam_total')
				->from('quizes_setting')
				->join('exam_setting','exam_setting.exam_id = quizes_setting.exam_id','LEFT')
				->where('quizes_setting.exam_id',$exam_id)
				->group_by('exam_setting.exam_id')
				->order_by('quizes_setting.date_posted','DESC');
			$result =  $this->db->get()->result();
			$ar = '';
			foreach ($result as $key) {
				# code...
				//$ar[] = $key;
				$cat_names = '';
				$category = '';
				$categories = '';
				$sql = $this->db->select('exam_setting.category_id,category.cat_name')
					->from('exam_setting')
					->join('category','category.cat_id = exam_setting.category_id','left')
					->where('exam_id',$key->exam_id);
					$category = $this->db->get()->result();
					foreach ($category as $cat) {
						# code...
						$cat_names[] = $cat->cat_name;
						//$cat_ids[] = $cat->category_id;
						$categories[] =(object) array('category_id'=>$cat->category_id,'category_name'=>$cat->cat_name);
					}
					

					$ar[] =(object) array(
						'exam_id'=>$key->exam_id,		
						'quizes_title'=>$key->quizes_title,
						'e_description'=>$key->e_description,
						'slug'=>$key->slug,
						'shuffle_choices'=>$key->shuffle_choices,
						'suffle_questions'=>$key->suffle_questions,
						'date_posted'=>$key->date_posted,
						'status'=>$key->status,
						'category_names'=>$cat_names,
						//'category_ids'=>$cat_ids,
						'category'=>$categories,
						'totalexam'=>$key->totalexam,
						'exam_total'=>$key->exam_total
					);


			}
			return $ar;

	}

	public function getInfoBySlug($slug=false)
	{
				if($slug){
			$object =  false;
			$query = $this->db->select('exam_id,quizes_title,e_description,date_posted,status')
				->from('quizes_setting')
				->where('slug',$slug)
				->get();
				if($result =  $query->result()){


				$category = '';
				$categories = '';

				$sql = $this->db->select('exam_setting.category_id,category.cat_name')
					->from('exam_setting')
					->join('category','category.cat_id = exam_setting.category_id','left')
					->where('exam_id',$result[0]->exam_id);
					$category = $this->db->get()->result();
					foreach ($category as $cat) {

						$categories[] =(object) array('category_id'=>$cat->category_id,'category_name'=>$cat->cat_name);

					}
						$object[] =(object) array(
						'exam_id'=>$result[0]->exam_id,		
						'quizes_title'=>$result[0]->quizes_title,
						'e_description'=>$result[0]->e_description,
						'date_posted'=>$result[0]->date_posted,
						'status'=>$result[0]->status,
						'category'=>$categories,
					);



				}



				return $object;
		}
		return false;

	}
	public function getInfoByexamId($exam_id=false)
	{
				if($exam_id){
			$object =  false;
			$query = $this->db->select('exam_id,quizes_title,e_description,date_posted,status')
				->from('quizes_setting')
				->where('exam_id',$exam_id)
				->get();
				if($result =  $query->result()){


				$category = '';
				$categories = '';

				$sql = $this->db->select('exam_setting.category_id,category.cat_name')
					->from('exam_setting')
					->join('category','category.cat_id = exam_setting.category_id','left')
					->where('exam_id',$exam_id);
					$category = $this->db->get()->result();
					foreach ($category as $cat) {

						$categories[] =(object) array('category_id'=>$cat->category_id,'category_name'=>$cat->cat_name);

					}
						$object[] =(object) array(
						'exam_id'=>$result[0]->exam_id,		
						'quizes_title'=>$result[0]->quizes_title,
						'e_description'=>$result[0]->e_description,
						'date_posted'=>$result[0]->date_posted,
						'status'=>$result[0]->status,
						'category'=>$categories,
					);



				}



				return $object;
		}
		return false;

	}
	public function take_exam($exam_id='')
	{
		# code...
		$query = $this->db->select('quiz.*,quizes.category_id')
			->from('quiz')
			->join('quizes','quizes.quiz_id = quiz.quiz_id')
			->where('quizes.exam_id',$exam_id)
			->order_by('quizes.category_id','ASC')
			//->order_by('quizes.category_id','RANDOM')
			->get();
		if($result = $query->result()){
			$object = '';
			foreach ($result as $key) {
				# code...
				$choice = '';
				$s_choice = '';

				$choice = array(
					$key->post_answer,
					$key->post_choice1,
					$key->post_choice2,
					$key->post_choice3,
					$key->post_choice4);

				shuffle($choice);
				
				$object[] = (object) array(
					'question_id'=>$key->quiz_id,
					'question_title'=>$key->post_question,
					'choice_1' =>$choice[0],
					'choice_2' =>$choice[1],
					'choice_3' =>$choice[2],
					'choice_4' =>$choice[3],
					'choice_5' =>$choice[4],
					'category_id'=>$key->category_id
				);
			}
			return $object;
		}
		return false;

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

		//$query = $this->db->get_where('exam_setting',array('exam_id'=>$exam_id));
		//if($result = $query->result()){

			//foreach ($result as $cat) {
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
						//$object[] = $result2;
									//$object2 = '';
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
											'question_id'=>$key->quiz_id,
											'question_title'=>$key->post_question,
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

			//}
		//}
		return $object;

	}
	public function randomAllByCategory($exam_id='')
	{
		# code...
		$object = false;
		$is_shuffle = 0;
		/*if($q_shuffle = $this->db->get_where('exam_setting',array('exam_id'=>$exam_id,'category_id'=>$category_id))){

			if($shuffle = $q_shuffle->result()){

			$is_shuffle = $shuffle[0]->is_shuffle;
			}
		}

		*/
		$query = $this->db->get_where('exam_setting',array('exam_id'=>$exam_id));
		if($result = $query->result()){

			foreach ($result as $cat) {
				# code...
				$query2 = '';
				$result2 = '';
				$category_id = $cat->category_id;

		//*

		if($q_shuffle = $this->db->get_where('exam_setting',array('exam_id'=>$exam_id,'category_id'=>$cat->category_id))){

			if($shuffle = $q_shuffle->result()){

			$is_shuffle = $shuffle[0]->is_shuffle;
			}
		}

		/**/
				$query2 = $this->db->select('quiz.*,quizes.category_id,category.cat_name as category_name')
					->from('quiz')
					->join('quizes','quizes.quiz_id = quiz.quiz_id','left')
					->join('category','category.cat_id = quizes.category_id','left')
					->where(array('quizes.exam_id'=>$exam_id,'quizes.category_id'=>$cat->category_id))
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
											'question_id'=>$key->quiz_id,
											'question_title'=>$key->post_question,
											'choice_1' =>$choice[0],
											'choice_2' =>$choice[1],
											'choice_3' =>$choice[2],
											'choice_4' =>$choice[3],
											'choice_5' =>$choice[4],
											'category_id'=>$key->category_id,
											'category_name'=>$key->category_name
										);
									}
					}

			}
		}
		return $object;

	}
	public function exam_exist($question='')
	{
		# code...
		return $this->db->get_where('quizes_setting',array('quizes_title'=>$question))->result();
	}
		public function exam_category_exist($exam_id=0,$category_id=0)
	{
		# code...
		return $this->db->get_where('exam_setting',array('exam_id'=>$exam_id,'category_id'=>$category_id))->result();
	}


	public function set_category($data=false)
	{

			return $this->db->insert('quiz_category',$data);
	}

	public function question_exist($question='')
	{
		# code...
		return $this->db->get_where('quiz',array('post_question'=>$question))->result();
		//return $this->db->get()->result();
	}
	public function isAnswer($question=0, $answer = '')
	{

		if($this->db->get_where('quiz',array('quiz_id'=>$question,'post_answer'=>$answer))->result()){
			return true;
		}else{
			return false;
		}

	}

	public function list_exams($is_admin=false)
	{
		

			$this->db->select('quizes_setting.*,COUNT('.$this->db->dbprefix("exam_setting").'.exam_id) as totalexam,, SUM('.$this->db->dbprefix("exam_setting").'.exam_total) as exam_total')
				->from('quizes_setting')
				->join('exam_setting','exam_setting.exam_id = quizes_setting.exam_id','LEFT');
				if(!$is_admin)
				$this->db->where('status',1);

				$this->db->group_by('exam_setting.exam_id')
				->order_by('quizes_setting.date_posted','DESC');
			$result =  $this->db->get()->result();
			$ar = '';
			foreach ($result as $key) {
				# code...
				//$ar[] = $key;
				$cat_names = '';
				$category = '';
				$categories = '';
				$sql = $this->db->select('exam_setting.category_id,category.cat_name')
					->from('exam_setting')
					->join('category','category.cat_id = exam_setting.category_id','left')
					->where('exam_id',$key->exam_id);
					if($category = $this->db->get()->result()){
					foreach ($category as $cat) {
						# code...
						$cat_names[] = $cat->cat_name;
						//$cat_ids[] = $cat->category_id;
						$categories[] =(object) array('category_id'=>$cat->category_id,'category_name'=>$cat->cat_name);
					}
					}
					

					$ar[] =(object) array(
						'exam_id'=>$key->exam_id,		
						'quizes_title'=>$key->quizes_title,
						'e_description'=>$key->e_description,
						'slug'=>$key->slug,
						'shuffle_choices'=>$key->shuffle_choices,
						'suffle_questions'=>$key->suffle_questions,
						'date_posted'=>$key->date_posted,
						'status'=>$key->status,
						'category_names'=>$cat_names,
						//'category_ids'=>$cat_ids,
						'category'=>$categories,
						'totalexam'=>$key->totalexam,
						'exam_total'=>$key->exam_total
					);


			}
			return $ar;
			
		
	}

	public function list_question($category=false,$exam_id= false)
	{
		if($category && $exam_id){

			$this->db->select('quiz.*')
				->from('quiz')
				->join('quizes','quizes.quiz_id = quiz.quiz_id','LEFT')
				->where(array('quizes.category_id'=>$category,'quizes.exam_id'=>$exam_id));
			return $this->db->get()->result();

		
		}
		return false;
	}


	public function removeExam($exam_id=0)
	{
		# code...
		

		$query = $this->db->select('quiz_id')
					->from('quizes')
					->where('exam_id',$exam_id)
					->get();
					if($result = $query->result()){
						foreach ($result as $key) {
							# code...

							$this->db->delete(array('quiz','quiz_choices'),array('quiz_id'=>$key->quiz_id));

						}
					}

		$this->db->delete('exam_setting',array('exam_id'=>$exam_id));
		$this->db->delete('quizes',array('exam_id'=>$exam_id));

		return $this->db->delete('quizes_setting',array('exam_id'=>$exam_id));
	}


	public function removeExamCategory($exam_id=0,$category_id=0)
	{

			$this->db->delete('exam_setting',array('exam_id'=>$exam_id,'category_id'=>$category_id));
			$haveError =  $this->db->affected_rows();
			if($haveError > 0){
				return true;
			}else{
				return $this->db->error();
			}
		
	}






	//$parseStr = removeTag($html,'page-break','<hr','/>');

function removeTag($str,$id,$start_tag,$end_tag)
 {
    //str - string to search 
    //id - text to search for
    //start_tag - start delimiter to remove
   //end_tag - end delimiter to remove

 //find position of tag identifier. loops until all instance of text removed
 while(($pos_srch = strpos($str,$id))!==false)
 {
         //get text before identifier
         $beg = substr($str,0,$pos_srch);
         //get position of start tag
         $pos_start_tag = strrpos($beg,$start_tag);
         //echo 'start: '.$pos_start_tag.'<br>';
         //extract text up to but not including start tag
         $beg = substr($beg,0,$pos_start_tag);
         //echo "beg: ".$beg."<br>";
        
         //get text from identifier and on
         $end = substr($str,$pos_srch);
        
         //get length of end tag
         $end_tag_len = strlen($end_tag);
         //find position of end tag
         $pos_end_tag = strpos($end,$end_tag);
         //extract after end tag and on
         $end = substr($end,$pos_end_tag+$end_tag_len);
        
         $str = $beg.$end;
 }

 //return processed string
 return $str;
 }
}


/*

SELECT s.exam_id,s.quizes_title,q.*,c.cat_id FROM q_quiz as q LEFT JOIN q_quiz_category as c ON c.quiz_id = q.quiz_id LEFT JOIN q_quizes as qq ON q.quiz_id = qq.quiz_id LEFT JOIN q_exam_setting as e ON e.exam_id = qq.exam_id LEFT JOIN q_quizes_setting as s ON e.exam_id = s.exam_id ORDER BY s.exam_id DESC

*/