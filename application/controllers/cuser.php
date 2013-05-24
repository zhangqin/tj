<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CUser extends MY_Controller {
    public function __construct() {
        parent::__construct();
    }
    /**
     * action:登陆界面及登陆检测
     */
    public function login(){
        if($this->input->post()){
            $this->load->model('User');
            $msg = array(
                '验证码错误！',
                '用户名或密码错误！'
            );
            $flag = $this->User->loginCheck();
            if($flag == 2){
                redirect('ctj/index');
            }else{
                $data = array(
                    'msg' => $msg[$flag]
                );
                $this->load->view('/login', $data);
            }
        }else{
            $this->load->view('/login');
        }
    }
    /**
     * action:登出链接
     */
    public function logout(){
        $this->load->library('session');
        $this->session->sess_destroy();
        redirect('cuser/login');
    }
    /**
     * action:验证码生成链接
     */
    public function captcha(){
        $this->load->helper('captcha');
        $this->load->library('session');
//        $vals = array(
//            'word' => rand(1000, 10000),
//            'img_path' => './captcha/',//必须是存在的目录，用于保持验证码图片
//            'img_url' => base_url().'captcha/',//必须是存在的目录
//            'font_path' => './path/to/fonts/texb.ttf',
//            'img_width' => '150',
//            'img_height' => 30,
//            'expiration' => 7200//指定了验证码图片的超时删除时间. 默认是2小时.
//            );
        $vals = array(
            'img_path' => './captcha/',
            'img_url' => base_url().'captcha/',
            'img_width' => '100',
            'word' => rand(1000, 10000),
            );
        $cap = create_captcha($vals);
        $this->session->set_userdata('captcha_code', $cap['word']);
        echo $vals['img_url'].$cap['time'].'.jpg';

    }
    /**
     * 体检者
     */
    public function index(){
            $this->load->view('user/index');	
    }
    //体检者json数据获取
    public function getUserJson(){
        $user = $this->db->get('user')->result();
        echo json_encode($user);
    }
    /**
     * 
     */
    public function editUserContent(){
        $data['user_unique'] = $_REQUEST['user_unique'];
        $this->load->view('user/userContent', $data);
    }
    /**
     * 体检者保存
     */
    public function saveUser(){        
        $data = $this->getData('user');
        $f = $this->db->insert('user', $data);
        if($f){
            $this->load->library('func');
            $this->func->createTable($data['user_unique']);           
            $data['user_id'] = $this->db->insert_id();
            echo json_encode($data);
        }else{
            throw new Exception("插入数据失败");
        }     
    }
    /**
     * 体检者更新
     */
    public function updateUser(){
        $data = $this->getData('user');  
        $this->db->where('user_id', $data['user_id']);
        $f = $this->db->update('user', $data); 
        if($f){
            echo json_encode($data);
        }else{
            throw new Exception("更新数据失败");
        }
    }
    /**
     * 体检者删除
     */
    public function deleteUser(){
        //exit(var_dump($_REQUEST));
        $user_id = intval($_REQUEST['id']);  
        $f = $this->db->delete('user', array('user_id' => $user_id));
        if($f){
            echo json_encode(array('success'=>true));  
        }else{
            throw new Exception("删除数据失败");
        }     
    }
    public function test(){
        $this->benchmark->mark('code_start2');     
         $this->load->library('func');
        $this->benchmark->mark('code_end2');
       
        $this->benchmark->mark('code_start');     
        $this->func->createTable('sss');  
        $this->benchmark->mark('code_end');
        $this->benchmark->mark('code_start1');     
        $this->func->createTable('aaa');  
        $this->benchmark->mark('code_end1');
        
        echo $this->benchmark->elapsed_time('code_start2', 'code_end2').'<br>';
        echo $this->benchmark->elapsed_time('code_start', 'code_end').'<br>';
        echo $this->benchmark->elapsed_time('code_start1', 'code_end1');
    }
    public function test1(){
        $r = $this->db->list_fields('sort');
        var_dump($r);
    }
}