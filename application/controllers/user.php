<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'cbase.php';
class User extends CBase {
    public function __construct() {
        parent::__construct();
    }
    //体检者
    public function index(){
            $this->load->view('user/index');	
    }
    //体检者json数据获取
    public function getUserJson(){
        $user = $this->db->get('user')->result();
        echo json_encode($user);
    }
    //体检者保存
    public function saveUser(){
        $data = $this->getData('user');
        $data['user_sex'] = $this->sexFormat( $data['user_sex']);
        $f = $this->db->insert('user', $data);
        if($f){
            $data['user_id'] = $this->db->insert_id();
            echo json_encode($data);
        }else{
            throw new Exception("插入数据失败");
        }     
    }
    //体检者更新
    public function updateUser(){
        $data = $this->getData('user');
        $data['user_sex'] = $this->sexFormat( $data['user_sex']);
        $this->db->where('user_id', $data['user_id']);
        $f = $this->db->update('user', $data); 
        if($f){
            echo json_encode($data);
        }else{
            throw new Exception("更新数据失败");
        }
    }
    //体检者删除
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
}