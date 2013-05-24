<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Log extends CI_controller {
    public function __construct() {
        parent::__construct();
    }
	public function index(){
        $ctrl = '<br>';
        $this->load->helper('url');
        echo base_url().'data/'.$ctrl;
        echo site_url('ctj/getProjectJson').$ctrl;
        echo current_url().$ctrl;
        echo uri_string().$ctrl;
        echo index_page().$ctrl;
		echo "it's a test function!";	
	}
}
