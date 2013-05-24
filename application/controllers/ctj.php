<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CTj extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Tj');
    }
    /**
     * action:首页
     */
    public function index(){
        $this->load->model('menu');
        $menu = $this->menu->getMenu();
        $data = array(
                'menu' => $menu,
                'role_name' => $this->session->userdata('role_name'),
                'role_weight' => $this->session->userdata('role_weight'),
                'admin_xm' => $this->session->userdata('admin_xm')
        );
        $this->load->view('index', $data);
    }
        //项目管理
	public function project(){
		$this->load->view('tj/index');
	}
	//体检项目json数据获取
        public function getProjectJson(){
            $sql = 'select id,tj_project.sort_id,sort_name,name,tj_project.unique,comment from tj_project,tj_sort where tj_project.sort_id=tj_sort.sort_id';
            $project = $this->db->query($sql)->result();
            echo json_encode($project);
        }
	//体检项目保存
        public function saveProject(){
            $data = $this->getData('project');
            $f = $this->db->insert('project', $data);
            if($f){
                $data['sort_id'] = $this->db->insert_id();
                echo json_encode($data);
            }else{
                throw new Exception("插入数据失败");
            }     
        }
        //体检项目更新
        public function updateProject(){
            $id = intval($_REQUEST['id']);
            $data = $this->getData('project');
            $this->db->where('id', $id);
            $f = $this->db->update('project', $data); 
            if($f){
                echo json_encode($data);
            }else{
                throw new Exception("更新数据失败");
            }
        }
        //体检项目删除
        public function deleteProject(){
            $id = intval($_REQUEST['id']);  
            $f = $this->db->delete('project', array('id' => $id));
            if($f){
                echo json_encode(array('success'=>true));  
            }else{
                throw new Exception("删除数据失败");
            }     
        }
	//体检分类管理
	public function tsort(){
            $this->load->view('tj/sort');
	}
	//体检分类json数据获取
        public function getSortJson(){
            $sort = $this->db->get('sort')->result();
            echo json_encode($sort);
        }
        //体检分类保存
        public function saveSort(){
            $data = $this->getData('sort');
            $f = $this->db->insert('sort', $data);
            if($f){
                $data['sort_id'] = $this->db->insert_id();
                echo json_encode($data);
            }else{
                throw new Exception("插入数据失败");
            }     
        }
        //体检分类更新
        public function updateSort(){
            $data = $this->getData('sort');
            $this->db->where('sort_id', $data['sort_id']);
            $f = $this->db->update('sort', $data); 
            if($f){
                echo json_encode($data);
            }else{
                throw new Exception("更新数据失败");
            }
        }
        //体检分类删除
        public function deleteSort(){
            //exit(var_dump($_REQUEST));
            $sort_id = intval($_REQUEST['id']);  
            $f = $this->db->delete('sort', array('sort_id' => $sort_id));
            if($f){
                echo json_encode(array('success'=>true));  
            }else{
                throw new Exception("删除数据失败");
            }     
        }
	//体检套餐
	public function package(){
		$this->load->view('tj/package');
	}
	//体检套餐json数据获取
        public function getPackJson(){
            $pack = $this->db->get('package')->result();
            echo json_encode($pack);
        }
        //体检套餐保存
        public function savePack(){
            $data = $this->getData('package');
            $f = $this->db->insert('package', $data);
            if($f){
                $sql = 'CREATE TABLE `tj_'.$data['pack_database'].'` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            PRIMARY KEY (`id`)
                          ) ENGINE=MyISAM DEFAULT CHARSET=utf8;';
                $this->db->simple_query($sql);
                $data['id'] = $this->db->insert_id();
                echo json_encode($data);
            }else{
                throw new Exception("插入数据失败");
            }     
        }
        //体检套餐更新
        public function updatePack(){
            $data = $this->getData('package');
            $this->db->where('pack_id', $data['pack_id']);
            $f = $this->db->update('package', $data); 
            if($f){
                echo json_encode($data);
            }else{
                throw new Exception("更新数据失败");
            }
        }
        //体检套餐删除
        public function deletePack(){
            $id = intval($_REQUEST['id']);  
            $pack_database =  $this->Tj->getPackDatabase($id);
            $f = $this->db->delete('package', array('pack_id' => $id));
            if($f){
                $sql = 'DROP TABLE IF EXISTS `'.$pack_database.'`';
                $this->db->simple_query($sql);
                echo json_encode(array('success'=>true));  
            }else{
                throw new Exception("删除数据失败");
            }     
        }
        //体检项目tree json数据获取
        public function getProjectTreeJson(){
            $tree = $this->Tj->getProjectTreeJson();
            echo $tree;
        }
        //体检套餐内容
        public function getPackContent(){
            $pack_database = $_REQUEST['pack_database'];
            $fields = $this->db->list_fields($pack_database);
            $packContent = array();
            foreach ($fields as $field){
                if($field == 'id')  continue;
                $result = $this->db->select('name,comment')->where("unique ='".$field."'")->get('project')->result();
                array_push($packContent, array(
                    'unique' => $field,
                    'name' => $result[0]->name,
                    'comment' => $result[0]->comment
                    ));
            }
            echo json_encode($packContent);
        }
        //体检套餐内容编辑
        public function editPackContent(){
            $data['pack_database'] = $_REQUEST['pack_database'];
            $this->load->view('tj/packContent', $data);
        }
        //保存套餐内容，即创建数据库字段
        public function newPackContent(){
            $table = 'tj_'.$_POST['table'];
            $packContent = array();
            foreach ($_POST['ids']  as $id){
                if(empty($id))  continue;
                $result = $this->Tj->createField($id, $table);
                if($result['f']){
                    $data = array(
                        'unique' => $result['project']->unique,
                        'name' => $result['project']->name,
                        'comment' => $result['project']->comment
                        );
                }  
                array_push($packContent, $data);
            }
            echo json_encode($packContent);
  
        }
        //删除套餐内容，即删除数据库字段
        public function deletePackContent(){
            $table = 'tj_'.$_POST['table'];
            $unique = $_REQUEST['unique'];  
            $sql = 'ALTER TABLE '.$table.' DROP COLUMN '.$unique;
            $f = $this->db->simple_query($sql);
            if($f){
                echo json_encode(array('success'=>true));  
            }else{
                throw new Exception("删除数据失败");
            }     
        }
        //体检结果
	public function tresult(){
            $table = isset($_REQUEST['table']) ? $_REQUEST['table'] : '';
            $this->session->set_userdata('table', $table);
            if(!empty($table))
                $data['fields'] = $this->Tj->getFieldName($table);
            else{
                $data = array();
            }
            $data['table'] = $table;
            $this->load->view('tj/result', $data);
	}
        //体检结果json数据获取
        public function getResultJson(){
           $table = $this->session->userdata('table');
           $result = $this->db->get($table)->result();
           echo json_encode($result);
        }
        //保存套餐内容，即创建数据库字段
        public function saveResult(){
           $table = $this->session->userdata('table');
           $data = $this->getData($table);
           $f = $this->db->insert($table, $data);
            if($f){
                $data['id'] = $this->db->insert_id();
                echo json_encode($data);
            }else{
                throw new Exception("插入数据失败");
            }     
        }
        //更新套餐内容
        public function updateResult(){
            $table = $this->session->userdata('table');
            $data = $this->getData($table);
            $this->db->where('id', $data['id']);
            $f = $this->db->update($table, $data); 
            if($f){
                echo json_encode($data);
            }else{
                throw new Exception("更新数据失败");
            }
        }
        //删除套餐内容，即删除数据库字段
        public function deleteResult(){
            $table = $this->session->userdata('table');
            $id = intval($_REQUEST['id']);  
            $f = $this->db->delete($table, array('id' => $id));
            if($f){
                echo json_encode(array('success'=>true));  
            }else{
                throw new Exception("删除数据失败");
            }     
        }

        /**
     * action:art插件的演示
     */
    public function artDemo(){
        $this->load->view('art_demo');
    }
    /**
     * action:测试使用
     */
    public function test(){
        $arr = array(
            'aaa'=>'aaa',
            'b'=>'b'
        );
        $arr1 = array('aaa','bbb');
        echo json_encode($arr);
        echo json_encode($arr1);
        $str = '[{"id": 1,"text": "Languages","children": [{"id": 11,"text": "Java"},{"id": 12,"text": "C++"}]}]';
        echo $str;
        var_dump( json_decode($str,true) );
    }
}
