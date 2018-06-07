<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Pagecounter
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
  public function run_counter($value='')
  {
  	# code...


		$userip =$this->get_ip();
		$url =  $this->get_pageUrl();
		$agent = $this->get_agent();
		$machine =  $this->getOS($agent);
		$browser =  $this->getBrowser($agent);
		$page_id = $this->get_page_id($url);
		$date = date('Y-m-d h:m:s');
		$time = time();

		$this->insertIP($userip,$date,$url,$browser,$agent);

	$newcookie = $this->setcookiedata('page','hello');

  	if($newcookie === false){

  		$url = $this->get_pageUrl();
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


  		$this->cron_counter(); //update table col_page_visits every 6 hours;


  }

	public function setcookiedata($item='',$data='')
	{
		# code...


        	$data = $this->encrypt_md($this->get_pageUrl());


		if(!isset($_COOKIE[$item])){
			$cookies[] = $data;
			setcookie($item,json_encode($cookies), time() + 43200);
        	$this->cookieExist = true;
        	return false;
		}else{


        	$cookies = stripcslashes($_COOKIE[$item]);
        	$cookies = json_decode($cookies);
        	//var_dump($cookies);
        	//echo "<br>";

        	foreach ($cookies as $key=>$value) {
        		# code...
        		//echo "$key. $value<br>";
        		if($value === $data){
        			$this->cookieExist = true;
        		}
        		$array[] = $value;
        	}



        	if($this->cookieExist === false){

        	$cookies[] = $data;
        	delete_cookie($item);
        	unset($_COOKIE[$item]);
        	setcookie($item,json_encode($cookies), time() + 43200);
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

  	$session_page_url = str_replace('/', '-', $_SERVER['PHP_SELF']);
  	return $session_page_url;

  }









  public function check_bots($agent='')
	{
		# code...
		
	if (preg_match('/bot|crawl|curl|dataprovider|search|get|spider|find|java|majesticsEO|google|yahoo|teoma|contaxe|yandex|libwww-perl|facebookexternalhit/i', $agent)) {
    // is bot
		return true;
	}else {return false;}
	}
public function insertIP($ip='',$date=false,$url=false,$browser=false,$agent)
{
$date = date('Y-m-d');
$new_file = $date.'.log';
$myfile = fopen("visitor/".$new_file, "a") or die("Unable to open file!");
$txt = "\n $ip $date $browser $url $agent";
fwrite($myfile, $txt);
fclose($myfile);

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







/*****
******
******
******
*******This line of code used to call in manual cron job*********
******
******/

	public function cron_counter()
	{ 
		
    $time = date("h");
      $mod = $time%2;
      if($mod > 0){
			$this->run_cron_job();

      }

	}
	public function run_cron_job()
		{
			# code...
		$this->ci->db->select('*');
		$result = $this->ci->db->get('pageview')->result();
		foreach ($result as $key) {
			$this->ci->db->select('sum(counter) as counter');
			$this->ci->db->where('page',$key->page);
			$this->ci->db->where('complete_date',$key->complete_date);
			$row = $this->ci->db->get('pageview')->result();
			$counter = $row[0]->counter;
			
			$this->update_pagevisit($key->page,$key->page_id,$counter, $key->complete_date,'');

			$this->del_on_pageview($key->page,$key->complete_date);
		}
		$this->ci->db->reset_query();

	}

	public function update_pagevisit($page='',$page_id=0,$counter = 0, $date = '',$country='')
	{
		# code...
		if($page != ''){

			//$page = $this->ci->db->escape_str($page);
			$sql = sprintf("SELECT * FROM col_page_visits WHERE page = '%s' AND date_visited = '%s'",$page,$date);
			$query = $this->ci->db->query($sql);
			$result = count($query->result());
			if($result > 0){
				$sql2 = sprintf("UPDATE col_page_visits SET count = count + ".$counter." WHERE page = '%s' AND date_visited = '%s'",$page,$date);
				$query = $this->ci->db->query($sql2,$page,$date);
			}else{
				$array = array(
					'page' =>$page,
					'page_id' =>$page_id,
					'count' =>$counter,
					'date_visited' =>$date,
					'country'=>$country );
				$this->ci->db->set($array);
				$this->ci->db->insert('col_page_visits');
			}

		}
		return;

	}
	public function del_on_pageview($page='',$date='')
	{
		# code...
		if($page != ''){
			$this->ci->db->where('page',$page);
			$this->ci->db->where('complete_date',$date);
			$this->ci->db->delete('pageview');
		}
		return;

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
 		$result = $this->ci->db->get_where('pageview',$array)->result();
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
		        'page_id' => $page_id,
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
		  	return $this->ci->db->insert('pageview',$data);
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
		return $this->ci->db->update('pageview');

	}
	public function last_update($userip='',$url, $time=0)
	{
		# code...
  		$array = sprintf("page = '%s' AND userip = '%s' ",$url,$userip);
		//var_dump($array);
 		$this->ci->db->select('timeUpdate');
 		$result = $this->ci->db->get_where('pageview',$array)->result();
 		//var_dump(count($result));

 			$lastupdatetime = $result[0]->timeUpdate + 43200;
 			//var_dump($lastupdatetime);

 		if(count($result) > 0){
 			$lastupdatetime = $result[0]->timeUpdate + 43200;
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
 		if ($this->ci->db->table_exists('pages') ){

 		$this->ci->db->select('page_id');
 		if($result = $this->ci->db->from('pages')->where('page_url',$value)->get()->result()){
 			return $result[0]->page_id;
 		}
 		return 0;
 		}
 		return 0;
 	}



	public function pagesoncounter($value='')
	{
		# code...
		if($value !== ''){
			return $this->ci->db->select('*')->get('col_page_visits')->where('page_id',$value)->result();
		}
		$sql = "SELECT page_id, page, sum(count) as count from col_page_visits group by page";
		$result = $this->ci->db->query($sql)->result();
		return $result;
		//return $this->ci->db->select('*')->get('col_page_visits')->result();
		//return "List of all pages";
	}











 	/*
 	*
 	*
 	*
 	*    Show visitors list
 	*
 	*
 	*/
 	public function visit_today($value='')
	{
		# code...

		$page = $value;
		$year = date('y');
		$month = date('m');
		$today = date('Y-m-d');
		$sql = sprintf("SELECT sum(count) as total from col_page_visits where page='%s' AND date_visited = '%s'  AND year(date_visited) = year(now())",$page,$today);
		// var_dump($sql);exit();
		$result = $this->ci->db->query($sql)->result();

		return isset($result[0]->total) ? $result[0]->total : 0;
		
	}
	public function visit_thisweek($value='')
	{
		# code...

		$page = $value;
		$year = date('y');
		$month = date('m');
		$today = date('Y-m-d');
		$sql = sprintf("SELECT sum(count) as total from col_page_visits where page='%s' AND week(date_sub(date_visited, interval + 7 day)) <= week(now()) AND week(date_visited) >= week(now()) AND year(date_visited) = year(now()) ",$page,$today,$today);
		// var_dump($sql);exit();
		$result = $this->ci->db->query($sql)->result();
		return isset($result[0]->total) ? $result[0]->total : 0;
	}
	public function visit_thismonth($value='')
	{
		# code...
		$page = $value;
		$year = date('y');
		$month = date('m');
		$sql = sprintf("SELECT sum(count) as total from col_page_visits where page='%s' AND month(date_visited) = month(now()) AND year(date_visited) = year(now()) ",$page);
		// var_dump($sql);exit();
		$result = $this->ci->db->query($sql)->result();
		return isset($result[0]->total) ? $result[0]->total : 0;
	}
	public function visit_thisyear($value='')
	{
		# code...
		$page = $value;

		$year = date('y');
		$month = date('m');
		$sql = sprintf("SELECT sum(count) as total from col_page_visits where page='%s' AND year(date_visited) = year(now()) ",$page);
		// var_dump($sql);exit();
		$result = $this->ci->db->query($sql)->result();
		return isset($result[0]->total) ? $result[0]->total : 0;
	}

	public function visit_total($page='')
	{
		# code...
		//echo $page;
		if($page !== ''){
		$page = $page;

		$year = date('y');
		$month = date('m');
		$sql = sprintf("SELECT sum(count) as total from col_page_visits where page='%s' group by page ",$page);
		// var_dump($sql);exit();
		$result = $this->ci->db->query($sql)->result();
		return isset($result[0]->total) ? $result[0]->total : 0;

		}else{
			//return 0;


		$sql = sprintf("SELECT sum(count) as total from col_page_visits ");
		// var_dump($sql);exit();
		$result = $this->ci->db->query($sql)->result();
		return isset($result[0]->total) ? $result[0]->total : 0;
		}
	}




}







