<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends MY_Controller {
    public $table;
    public function __construct() { 
        parent::__construct();
    }
    //管理者
    public function index(){
        $this->load->view('admin/index');	
    }
    //管理者json数据获取
    public function getAdminJson(){
        $admin = $this->db->get('admin')->result();
        echo json_encode($admin);
    }
    //管理者保存
    public function saveAdmin(){
        $data = $this->getData('admin');
        $data['admin_sex'] = $this->sexFormat( $data['admin_sex']);
        $f = $this->db->insert('admin', $data);
        if($f){
            $data['admin_id'] = $this->db->insert_id();
            echo json_encode($data);
        }else{
            throw new Exception("插入数据失败");
        }     
    }
    //管理者更新
    public function updateAdmin(){
        $data = $this->getData('admin');
        $data['admin_sex'] = $this->sexFormat( $data['admin_sex']);
        $this->db->where('admin_id', $data['admin_id']);
        $f = $this->db->update('admin', $data); 
        if($f){
            echo json_encode($data);
        }else{
            throw new Exception("更新数据失败");
        }
    }
    //管理者删除
    public function deleteAdmin(){
        //exit(var_dump($_REQUEST));
        $admin_id = intval($_REQUEST['id']);  
        $f = $this->db->delete('admin', array('admin_id' => $admin_id));
        if($f){
            echo json_encode(array('success'=>true));  
        }else{
            throw new Exception("删除数据失败");
        }     
    }
    //角色管理
    public function role(){
            $this->load->view('admin/role');	
    }
    //角色管理json数据获取
    public function getRoleJson(){
        $role = $this->db->get('role')->result();
        echo json_encode($role);
    }
    //角色管理保存
    public function saveRole(){
        $data = $this->getData('role');
        $f = $this->db->insert('role', $data);
        if($f){
            $data['role_id'] = $this->db->insert_id();
            echo json_encode($data);
        }else{
            throw new Exception("插入数据失败");
        }     
    }
    //角色管理更新
    public function updateRole(){
        $data = $this->getData('role');
        $this->db->where('role_id', $data['role_id']);
        $f = $this->db->update('role', $data); 
        if($f){
            echo json_encode($data);
        }else{
            throw new Exception("更新数据失败");
        }
    }
    //角色管理删除
    public function deleteRole(){
        //exit(var_dump($_REQUEST));
        $role_id = intval($_REQUEST['id']);  
        $f = $this->db->delete('role', array('role_id' => $role_id));
        if($f){
            echo json_encode(array('success'=>true));  
        }else{
            throw new Exception("删除数据失败");
        }     
    }
}