<?php 

/**
* 
*/
class Email_m extends CI_Model
{


	
	function __construct()
	{
		parent::__construct();
		//$this->load->library('email');
	}
	public function verify_email($toemail=false,$code=false)
	{
		# code...
		if($toemail && $code){
			$myemail = '----';
			//config email settings
/*       	
       	//config email settings
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = '----';
        $config['smtp_crypto'] = 'ssl';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = $myemail;
        $config['smtp_pass'] = '-----';  //sender's password
*/

        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = 'TRUE';
        $config['newline'] = "\r\n"; 
        
        $this->load->library('email', $config);
		$this->email->initialize($config);
	
		$subject = 'Coloftech Verification Code';
		$message = 'This is your verification code: <b>'.$code .'</b> \r\n Enter in the the registration area.';
//send email
        $this->email->from($myemail,'Coloftech : ORC');
        $this->email->to($toemail);
        $this->email->subject($subject);
        $this->email->message($message);
        
        $this->email->send();

		}
	}
	public function verify_code($code=false,$user_name=false)
	{
		# code...
		if($code && $user_name){
			if($this->db->get_where('users',array('verify_code'=>$code,'user_name'=>$user_name))){
				$this->db->where('user_name',$user_name);
				return $this->db->update('users',array('is_verify'=>2));


		}else{
			return false;
		}

		}
		return false;
	}
}