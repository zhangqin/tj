<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CMenu extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('menu');
    }	
    //菜单
    public function index(){
        $this->load->view("menu/menu");
    }
    //获取菜单的JSON数据
    public function getMenuJson(){
        $menu = $this->menu->getMenuExceptCategory();
        echo json_encode($menu);
    }
    
    //菜单保存
        public function saveMenu(){
            $data = $this->getData('menu');
            $f = $this->db->insert('menu', $data);
            if($f){
                $data['m_id'] = $this->db->insert_id();
                echo json_encode($data);
            }else{
                throw new Exception("插入数据失败");
            }     
        }
        //菜单更新
        public function updateMenu(){
            $id = intval($_REQUEST['id']);
            $data = $this->getData('menu');
            $this->db->where('m_id', $id);
            $f = $this->db->update('menu', $data); 
            if($f){
                echo json_encode($data);
            }else{
                throw new Exception("更新数据失败");
            }
        }
        //菜单删除
        public function deleteMenu(){
            $id = intval($_REQUEST['id']);  
            $f = $this->db->delete('menu', array('m_id' => $id));
            if($f){
                echo json_encode(array('success'=>true));  
            }else{
                throw new Exception("删除数据失败");
            }     
        }
        //菜单分类访问
        public function menuCategory(){
            $this->load->view('menu/category');
        }
        //获取菜单分类的JSON数据
    public function getMemuCategoryJson(){
        $data = $this->menu->getMemuCategory();
        echo json_encode($data);
    }
    //菜单分类保存
    public function saveMemuCategory(){
        $data = $this->getData('menu');
        $data['m_parent_id'] = 0;
        $f = $this->db->insert('menu', $data);
        if($f){
            $data['m_id'] = $this->db->insert_id();
            echo json_encode($data);
        }else{
            throw new Exception("插入数据失败");
        }     
    }
    //菜单分类更新
    public function updateMemuCategory(){
        $data = $this->getData('menu');
        $this->db->where('m_id', $data['m_id']);
        $f = $this->db->update('menu', $data); 
        if($f){
            echo json_encode($data);
        }else{
            throw new Exception("更新数据失败");
        }
    }
    //菜单分类删除
    public function deleteMemuCategory(){
        //exit(var_dump($_REQUEST));
        $menu_id = intval($_REQUEST['id']);  
        $f = $this->db->delete('menu', array('m_id' => $menu_id));
        if($f){
            echo json_encode(array('success'=>true));  
        }else{
            throw new Exception("删除数据失败");
        }     
    }
    
}