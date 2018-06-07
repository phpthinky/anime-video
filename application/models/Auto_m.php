<?php 

/**
* 
*/
class Auto_m extends CI_Model
{
    
    function __construct()
    {
        parent::__construct();
        $this->init();
    }
    public function init($value='')
    {
        # code...
        $this->load->library('minify');
        $this->load->library('session');
        $this->load->library('pagination');

                    // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        //$config['use_page_numbers'] = TRUE;
        $config['display_pages'] = FALSE;
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '<< PREV';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'NEXT >>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['query_string_segment'] = 'row';
        //$config['reuse_query_string'] = true;
        $config['page_query_string'] = true;
            
            $this->pagination->initialize($config);
            
        date_default_timezone_set('Asia/Manila');

        $this->load->library('visitors');
    }
    public function recent_post($value=10)
    {
        $this->load->model('post_m');
        $html = '';
        if($recents = $this->post_m->recent_post(false,5)){

            foreach ($recents as $key) {
                # code...
                $html.= "<li><a href='".site_url("$key->site_path/$key->slug")."' >$key->post_title</a></li>";
            }
        }
        return $html;
    }

    public function recent_post_footer($value=5)
    {
        $this->load->model('post_m');
        $html = '';
        if($recents = $this->post_m->recent_post(false,$value)){

            foreach ($recents as $key) {
                # code...
                $html.= "<li> <a href='".site_url("$key->site_path/$key->slug")."' >$key->post_title</a></li>";
            }
        }
        return $html;
    }

    public function getSites()
    {
        $this->load->model('admin_m');
        $html = '';
        if($hosted_sites = $this->admin_m->hosted_sites()){

            foreach ($hosted_sites as $key) {
                # code...
                //if($key->site_id != 1){

                $html.= "<li><a href='".site_url("$key->site_path/")."' >$key->site_name</a></li>";
                //}
            }
        }else{
            $html.= "<li><a href='".site_url()."' >Home</a></li>";
        }
        return $html;
    }
        public function getColleges($category = 0)
    {
        $this->load->model('site_m');
        $html = '';
        if($colleges = $this->site_m->getSiteColleges($category)){

            foreach ($colleges as $key) {
               
                    
                $html.= "<li><a href='".site_url("$key->site_path")."' >$key->site_name</a></li>";
               
            }
        }

        return $html;
    }


    public function free_space()
    {
        $this->load->model('post_m');
        $html = '';
        if($recents = $this->post_m->free_space(time())){

        }

    }

    public function limitext($string='')
    {
        # code...
                // strip tags to avoid breaking any html
        $string = strip_tags($string);

        if (strlen($string) >200) {

            // truncate string
            $stringCut = substr($string, 0, 200);

            // make sure it ends in a word so assassinate doesn't become ass...
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
        }
        return $string;
    }
    public function limit_300($string='')
    {
        # code...
                // strip tags to avoid breaking any html
        $string = strip_tags($string);

        if (strlen($string) >300) {

            // truncate string
            $stringCut = substr($string, 0, 300);

            // make sure it ends in a word so assassinate doesn't become ass...
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
        }
        return $string;
    }
    public function limit_title($string='')
    {
        # code...
                // strip tags to avoid breaking any html
        $string = strip_tags($string);

        if (strlen($string) >75) {

            // truncate string
            $stringCut = substr($string, 0, 75);

            // make sure it ends in a word so assassinate doesn't become ass...
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
        }
        return $string;
    }

    

    public function paging($total=0,$limit=0,$start=0)
    {
        
                        $config['base_url'] = site_url();
                        $config['total_rows']=$total;
                        $config['per_page'] = $limit;                       
                        $choice = $config["total_rows"]/$config["per_page"];
                        $config["num_links"] = floor($choice);             
             
                        $this->pagination->initialize($config);
                             
                        /*$data['links'] =*/ 
                        return $this->pagination->create_links();
    }

    public function subpaging($total=0,$limit=0,$start=0,$page='')
    {
        
                        $config['base_url'] = site_url("c=site&f=view&p=$page");
                        $config['total_rows']=$total;
                        $config['per_page'] = $limit;                       
                        $choice = $config["total_rows"]/$config["per_page"];
                        $config["num_links"] = floor($choice);             
             
                        $this->pagination->initialize($config);
                             
                        /*$data['links'] =*/ 
                        return $this->pagination->create_links();
    }

    public function listpaging($total=0,$limit=0,$start=0,$page='')
    {
        
                        $config['base_url'] = site_url("c=post&f=list_all");
                        $config['total_rows']=$total;
                        $config['per_page'] = $limit;                       
                        $choice = $config["total_rows"]/$config["per_page"];
                        $config["num_links"] = floor($choice);             
             
                        $this->pagination->initialize($config);
                             
                        /*$data['links'] =*/ 
                        return $this->pagination->create_links();
    }

    public function siteSetting(){
        $page = ($this->input->get('p')) ? $this->input->get('p') : 'bilar';
        $menu  = '';
        if($site_id  = $this->site_m->getSiteId($page)){
            if($menus = $this->site_m->getsiteSettings($site_id,0)){
                foreach ($menus as $key) {
                    $menu .= "<li><a href=''>".ucfirst($key->setting_name)."</a></li>";
                }
            }

        }
        //var_dump($menus);
        return $menu;
    }
    public function menu_top($value='')
    {
        
        $this->load->model('listmenu');
        $menus = $this->listmenu->get_menu_html();
        return $menus;
    }

    public function trim_sp($subject) {
        $regex = "/\s*(\.*)\s*/s";
        if (preg_match ($regex, $subject, $matches)) {
            $subject = $matches[1];
        }
        return $subject;
    }

    public function no_error($data='',$msg='')
    {
        # code...
        if(is_array($data)){
            if((int)$data['error'] > 0){
                $this->no_error($data['message']);
            }else{
                return true;
            }
        }else{
            if(is_bool($data) && $data == true){
            return true;
        }elseif(is_int($data)){
            return true;
            }else{
                return false;
            }
        }
        

    }

    public function mirror($mirror='')
    {
        # code...
        switch ($mirror) {
                        case '1':
                            # code...
                            $m_name = 'MP4UPLOAD';
                            break;

                        case '2':
                            # code...
                            $m_name = 'YOUTUBE';
                            break;

                        case '3':
                            # code...
                            $m_name = 'FACEBOOK';
                            break;

                        case '4':
                            # code...
                            $m_name = 'DAILYMOTION';
                            break;

                        case '5':
                            # code...
                            $m_name = 'OPENLOAD';
                            break;

                        case '6':
                            # code...
                            $m_name = 'GOOGLE DRIVE';
                            break;

                        
                        default:
                            # code...
                            $m_name = 'OTHERS';
                            break;
                    }
                    return $m_name;
    }

    public function getLatest($video_id=0)
    {
        # code...
        if($video_id > 0){

        $this->load->model('video_m');
        return $this->video_m->getlatestepisode($video_id);
        }
        return false;
    }
}