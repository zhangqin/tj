<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller{
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
    //字节单位转换
    protected function calcByte($byte){
        $i = 0;
        while ($byte > 1024 && $i < 5){
            $byte = round($byte/1024, 2);           
            $i++;
        }
        $unit = array('B', 'KB', 'MB', 'GB', 'TB');
        return $byte.$unit[$i];
    }
    //zip读取文件内容
    protected function readZip($filename){
        $zip = zip_open($filename);
        if($zip){
            while($zip_entry = zip_read($zip)){
                if(zip_entry_open($zip, $zip_entry)){
                    $sql = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
                }
            }
        }else{
            throw new Exception('无法打开ZIP文件');
        }
        zip_close($zip);
        return $sql;
    }
    //数据库恢复函数
    
    //获取文件名后缀
    protected function getExt($filename){
        $extend =explode("." , $file_name);  
        $va=count($extend)-1;  
        return $extend[$va];  
    }
}