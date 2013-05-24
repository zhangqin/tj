<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
class CBase extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        header("Content-Type:text/html;Charset=utf-8");
    }
    //获取的值GET POST等处理成数组
    protected function getData($table){
        $data = array();
        $fields = $this->db->list_fields($table);
        foreach ($_REQUEST as $k => $v){
            if(in_array($k, $fields))
                $data[$k] = $v;
        }
        return $data;
    }
    //性别的格式
    protected function sexFormat($sex){
        return ($sex == '男') ? 1 : 0;
    }
}