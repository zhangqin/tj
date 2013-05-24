<?php
/** 
 * 登陆相关 
 * 
 *  
 */  
class Login {  

    private $CI;  

    public function __construct() {  
        $this->CI = & get_instance();  
    }  
    /** 
     * 检测是否已经登陆
     */  
    public function isLogin() {  
        $this->CI->load->helper('url');  
        $this->CI->load->library('session'); 

        if ( !preg_match("/cuser\/[(login$)|(captcha$)]/i", uri_string()) ) {  
            if( !$this->CI->session->userdata('admin_id') ) {
                redirect('cuser/login');  
                return;  
            }  
        }
    }     

}  