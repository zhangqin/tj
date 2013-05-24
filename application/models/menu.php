<?php 
class Menu extends CI_Model{
	public function __construct(){
            parent::__construct();
            $this->load->database();	
	}
        //获取menu的全部数据
	public function getMenu(){
            $result = $this->db->get('menu')->result();
            return $result;
	}
        //获取除分类之外的全部数据
	public function getMenuExceptCategory(){
            $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
            $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
            $offset = ($page-1)*$rows;
            $result = $this->db->where('m_parent_id != 0')->limit($rows, $offset)->get('menu')->result();
            $category = $this->getMemuCategory();    
            foreach ($result as $row) {
                $arr = $this->array_key_multi($category, $row->m_parent_id);
                $row->m_category = $arr['m_name'];
            }
            $data["total"] = $this->db->where('m_parent_id != 0')->count_all_results('menu');
            $data["rows"] = $result;
           // exit(var_dump($data));
            return $data;
	}
        //根据查找的值返回键名
        public function array_key_multi($arr, $search){
            foreach ($arr as $k => $v) {
                if(!is_array($v)) $v = (array) $v;
                $flag = array_search($search, $v);
                if($flag !== false) return $v;
            }
            return false;
        }

        //获取菜单的分类
        public function getMemuCategory(){
            $result = $this->db->select('m_id,m_name,m_weight')->where('m_parent_id = 0')->get('menu')->result();
            return $result;
        }
        //获取角色的分类
        public function getRoleCategory(){
            $result = $this->db->select('role_id,role_name')->get('role')->result();
            return $result;
        }
}