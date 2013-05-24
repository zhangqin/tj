<?php
class Sys extends CI_Model{
	public function __construct(){
            parent::__construct();
            $this->load->database();	
	}
        //数据库表信息
        public function getTableInfo(){
            $sql = 'show table status';
            $result = $this->db->query($sql)->result();
            return $result;
        }
        //数据表优化
        public function tableOptimize($tables){
            $sql = 'optimize table '.$tables;
            $result = $this->db->query($sql)->result();
            return $result;
        }
        public function test(){
            $this->load->model('Tj');
        }
}
?>
