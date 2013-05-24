<?php
class User extends CI_Model{
	public function __construct(){
            parent::__construct();
            $this->load->database();	
	}
    /**
     * 用户登陆检查
     * 
     * @param type $name Description
     * @return boolean 登陆是否成功,并把用户数据存入session中
     */
    public function loginCheck(){
        $this->load->library('session');
        $captcha_code = $this->session->userdata('captcha_code');
        $captcha = $this->input->post('captcha');
        $admin_name = $this->input->post('admin_name');
        $admin_pwd = $this->input->post('admin_pwd');
        $flag = 2;//登陆成功
        
        if(strtolower($captcha) == strtolower($captcha_code)){
            $result  = $this->db->select('admin_id,role_id,admin_xm')
                    ->where("admin_name = '$admin_name' and admin_pwd = '$admin_pwd'")
                    ->get('admin')->result();
            
            if(count($result) > 0){
                $role_result = $this->db->where("role_id = {$result[0]->role_id}")
                                        ->get('role')->result();
                $admininfo = array(
                    'admin_id' => $result[0]->admin_id,
                    'admin_name' => $admin_name,
                    'admin_xm' => $result[0]->admin_xm,
                    'role_name' => $role_result[0]->role_name,
                    'role_weight' => $role_result[0]->role_weight,
                );
                $this->session->set_userdata($admininfo);
            }else{
                $flag = 1;//用户名密码错误
            }
            
        }else{
            $flag = 0;//验证码错误
        }
        return $flag;
    }

    /**
     * 添加表的字段
     * @param string $table_name 需要添加的表名
     * @param array $fields 需要添加的字段数组
     */
    public function addColumn($table_name, $fields){
        $this->load->dbforge();
        $this->dbforge->add_column('table_name', $fields);
    }
    /**
     * 删除一个新表
     * @param string $table_name 需要删除的表名
     */
    public function dropTable($table_name){
        $this->load->dbforge();
        $this->dbforge->drop_table($table_name);
    }
    /**
     * 修改表的字段
     * @param string $table_name 需要修改的表名
     * @param array $fields 需要修改的字段数组
     */
    public function modifyTable($table_name, $fields){
//        $fields = array(
//                        'old_name' => array(
//                                                         'name' => 'new_name',
//                                                         'type' => 'TEXT',
//                                                ),
//        );
        $this->load->dbforge();
        $this->dbforge->modify_column($table_name, $fields);
    }
    public function dropColumn($table_name, $column){
        $this->load->dbforge();
        $this->dbforge->drop_column($table_name, $column);
    }
}
?>