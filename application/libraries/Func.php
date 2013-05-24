<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Func{
    private $CI;
    public function __construct() {
        $this->CI = & get_instance();
    }
    /**
     * 创建一个新表
     * @param string $table_name 需要创建的表名
     */
    public function createTable($table_name){
        $this->CI->load->dbforge();
        $this->CI->dbforge->add_field('id');
        //$this->CI->dbforge->add_key('id', TRUE);
        $this->CI->dbforge->create_table($table_name);
    }

}
?>