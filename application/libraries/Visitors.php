<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/**
* 
*/
class Visitors
{
	
	private $domain;
	private $cookieExist = false;

	public function __construct()
	{
		# code...
	        $this->ci =& get_instance();
	        $this->ci->load->database();
	        $this->ci->load->helper('cookie');
	        $this->ci->load->helper('url');

	}

	public function run($slug=false)
	{
		


		$userip =$this->get_ip();

		$url =  isset($slug)? $slug : $this->get_pageUrl();
		$agent = $this->get_agent();
		$machine =  $this->getOS($agent);
		$browser =  $this->getBrowser($agent);
		$page_id = $this->get_page_id($url);
		$date = date('Y-m-d h:m:s');
		$time = time();
		//$this->insertIP($userip,$date,$url,$browser,$agent);

		$newcookie = $this->setcookiedata('page', $url);
		//var_dump($newcookie);exit();
		if($newcookie === false){

	  		if($exist = $this->check_on_db($url)){
	  			//echo "Update today counter";
	  			if($this->last_update($userip,$url, $time)){
	  			$this->update_today_counter($userip,$url,$browser,$time);  				
	  			}

	  		}else{
	  			//echo "insert new visitor";
	  			 $this->insert_new_visitor($url,$page_id,$date,$machine,$browser,$userip,$time);
	  		}
	  	}
		}
public function setcookiedata($item='',$data='')
	{
		# code...
			$this->cookieExist = false;
        	$data = $this->encrypt_md($data);


		if(!isset($_COOKIE[$item])){
			$cookies = '';
			$cookies[] = $data;
			setcookie($item,json_encode($cookies), time() + 86200);
        	$this->cookieExist = true;
        	return false;
		}else{


        	$cookies = stripcslashes($_COOKIE[$item]);
        	$cookies = json_decode($cookies);
        	//echo "<br>";

        	foreach ($cookies as $key) {

        		if($key === $data){
        			$this->cookieExist = true;
        		}
        		$array[] = $key;
        	}



        	if($this->cookieExist === false){

        	$cookies[] = $data;
        	delete_cookie($item);
        	unset($_COOKIE[$item]);
        	setcookie($item,json_encode($cookies), time() + 86400);
        	$this->cookieExist = true;

        		return false;



        	}else{
        		return true;
        	}


		}

	}



	function deleteCookie($name, $domain = '', $path = '/', $prefix = '')
	{
		$this->setnewcookie($name, '', '', $domain, $path, $prefix);
	}
	function set_cookie($name, $value = '', $expire = '', $domain = '', $path = '/', $prefix = '', $secure = NULL, $httponly = NULL)
	{
		setcookie($name, $value, $expire, $domain, $path, $prefix, $secure, $httponly);
	}




	public function encrypt_md($value='')
	  {
	  	# code...
	  	$encrypted = md5($value);
	  	return $encrypted;
	}

	public function get_pageUrl()
	  {

	  	if(isset($_GET['i'])){
	  		return $_GET['i'];
	  	}

	  	return $_SERVER['PHP_SELF'];
	  	
	  }

 	public function check_bots($agent='')
	{
		# code...
		
	if (preg_match('/bot|crawl|curl|dataprovider|search|get|spider|find|java|majesticsEO|google|yahoo|teoma|contaxe|yandex|libwww-perl|facebookexternalhit/i', $agent)) {
    // is bot
		return true;
	}else {return false;}
	}





  /*
  *
  * Get machine information of visitors
  *
  *
  */
   public function get_ip()
  {

  $user_ip=$_SERVER['REMOTE_ADDR'];
    return $user_ip;
  }

  public function get_agent()
  {
   $userAgent = $_SERVER['HTTP_USER_AGENT'];
   return $userAgent;
  }


function getOS($user_agent='') { 

   // global $user_agent;

    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array(
                            '/windows nt 10/i'     =>  'Windows 10',
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );

    foreach ($os_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }   

    return $os_platform;

}

//Get browser info

function getBrowser($user_agent="") {

    //global $user_agent;

    $browser        =   "Unknown Browser";

    $browser_array  =   array(
                            '/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Firefox',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Chrome',
                            '/edge/i'       =>  'Edge',
                            '/opera/i'      =>  'Opera',
                            '/netscape/i'   =>  'Netscape',
                            '/maxthon/i'    =>  'Maxthon',
                            '/konqueror/i'  =>  'Konqueror',
                            '/mobile/i'     =>  'Handheld Browser'
                        );

    foreach ($browser_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }

    }

    return $browser;

}










  /*
  *
  *
  *This function below are use to call data on the database
  *
  *
  */
  public function check_on_db($url='')
  {
  	# code...
  		$userip = $this->get_ip();
  		$array = sprintf("page = '%s' AND userip = '%s' ",$url,$userip);
		//var_dump($array);
 		$this->ci->db->select('*');
 		$result = $this->ci->db->get_where('post_view',$array)->result();
 		//var_dump(count($result));
 		if(count($result) > 0){

 			return true;
 		}else{

 			return false;
 		}

  }
  public function insert_new_visitor($url='',$page_id='',$date='',$machine='',$browser='',$userip='',$time = 0)
  {
  	# code...

		  	$now = date('Y-m-d');
		  	$year = date('Y');
		  	$day = date('d');
		  	$tday = date('D');
		  	$month = date('m');

  			  $data = array(
		        'userip' => $userip,
		        'page' => $url,
		        'post_id' => $page_id,
		        'counter' => 1,
		        'complete_date' => $now,
		        'machine'=>$machine,
		        'browser'=>$browser,
		        'year'=>$year,
		        'month'=>$month,
		        'day'=>$day,
		        'tday'=>$tday,
		        'timeUpdate'=>$time,
			);

		  	//return $data;
		  	return $this->ci->db->insert('post_view',$data);
  }


	public function update_today_counter($userip='',$url='',$browser='Unknown browser',$time = 0)
	{
		# code...

		$array = sprintf("page = '%s' AND userip = '%s' ",$url,$userip);
		$this->ci->db->set('counter', 'counter+1', FALSE);
		$this->ci->db->set('last_used_browser', 'browser', FALSE);
		$this->ci->db->set('browser', $browser, true);
		$this->ci->db->set('timeUpdate', $time, true);
		$this->ci->db->where($array);
		return $this->ci->db->update('post_view');

	}
	public function last_update($userip='',$url, $time=0)
	{
		# code...
  		$array = sprintf("page = '%s' AND userip = '%s' ",$url,$userip);
		//var_dump($array);
 		$this->ci->db->select('timeUpdate');
 		$result = $this->ci->db->get_where('post_view',$array)->result();
 		//var_dump(count($result));

 			$lastupdatetime = $result[0]->timeUpdate + 86400;
 			//var_dump($lastupdatetime);

 		if(count($result) > 0){
 			$lastupdatetime = $result[0]->timeUpdate + 86400;
 			if($lastupdatetime <= $time){
 				return true;
 			}else{
 				return false;
 			}
 		}else{

 			return false;
 		}

	}


   	public function get_page_id($value='')
 	{
 		# code...
 		if ($this->ci->db->table_exists('post') ){

 		$this->ci->db->select('post_id');
 		if($result = $this->ci->db->from('post')->where('slug',$value)->get()->result()){
 			return $result[0]->post_id;
 		}
 		return 0;
 		}
 		return 0;
 	}



	public function pagesoncounter($value='')
	{
		# code...
		if($value !== ''){
			return $this->ci->db->select('*')->get('page_visits')->where('post_id',$value)->result();
		}
		$sql = "SELECT post_id, page, sum(count) as count from page_visits group by page";
		$result = $this->ci->db->query($sql)->result();
		return $result;
		//return $this->ci->db->select('*')->get('page_visits')->result();
		//return "List of all pages";
	}





	public function unique_visitor()
	{
		# code...
		$visitors = 0;
		$query = $this->ci->db->select('userip,count(id) as unique_visitor')
				->from('post_view')
				->group_by('userip')
				->get();
				if($result = $query->result()){
					//$result[0]->unique_visitor;
					foreach ($result as $key) {
						# code...
						$visitors++;// = (int)$visitors + (int)$key->unique_visitor;
						//echo "$key->userip ($key->unique_visitor) <br/>";
					}
					//exit();

					return $visitors;
				}else{
					return $visitors;
				}

	}




	public function total_visitors()
	{
		# code...
		$query = $this->ci->db->select('sum(counter) as total_visitors')
				->from('post_view')
				->get();
				if($result = $query->result()){
					return $result[0]->total_visitors;
				}else{
					return 0;
				}

	}







}