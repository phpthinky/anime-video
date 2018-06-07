<?php 

/**
* 
*/
class Admin extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if (!$this->permission->is_loggedin())
		redirect();
	}
	public function index($value='')
	{
		# code...
		$this->load->model('statistics');
		$statistics = $this->statistics;
		$data['statistics'] = $statistics->getVideoStatitics();
		$data['site_title'] = 'Admin';
		$this->template->load('admin','admin/index',$data);
	}
	public function backupvideos($value='')
	{
		# code...
		$prefs = array(
        'tables'        => array('q_videos', 'q_video_episode','q_video_mirror','q_video_cover'),   // Array of tables to backup.
        'ignore'        => array(),                     // List of tables to omit from the backup
        'format'        => 'txt',                       // gzip, zip, txt
        'filename'      => 'backup-video-only.sql',              // File name - NEEDED ONLY WITH ZIP FILES
        'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
        'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
        'newline'       => "\n"                         // Newline character used in backup file
		);


		    // Load the DB utility class
		    $this->load->dbutil();

		    // Backup your entire database and assign it to a variable
		    $backup =& $this->dbutil->backup($prefs);

		    $fileName = 'backup-video-only-'.date('Y-m-d H:i:s').'.sql';
		    // Load the file helper and write the file to your server
		    //$this->load->helper('file');
		    //write_file(UPLOADPATH.'/admin/'.$fileName, $backup);

		    // Load the download helper and send the file to your desktop
		    $this->load->helper('download');
		    force_download($fileName, $backup);
			}

	public function create_zip()
	{

    // Load the DB utility class
    $this->load->dbutil();

    // Backup your entire database and assign it to a variable
    $backup =& $this->dbutil->backup();

    $fileName = 'anime-video-backup-'.date('Y-m-d H:i:s').'.zip';
    // Load the file helper and write the file to your server
    //$this->load->helper('file');
    //write_file(UPLOADPATH.'/admin/'.$fileName, $backup);

    // Load the download helper and send the file to your desktop
    $this->load->helper('download');
    force_download($fileName, $backup);

	}
}