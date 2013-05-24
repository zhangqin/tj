<?php
class Tj extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();	
	}
        //体检分类数据的字段获取
        public function getFields(){
            $fields = $this->db->list_fields('sort');
            return $fields;
        }
        //体检分类数据的获取
	public function getSort(){
		$result = $this->db->get('sort')->result();
		return $result;
	}
        //体检分类数据的保存
        public function saveSort($data){
           $this->db->insert('sort', $data); 
        }
        //体检分类更新
        //体检分类删除
        //体检套装数据库名获取
        public function getPackDatabase($id){
            $result = $this->db->select('pack_database')->where('pack_id ='.$id)->get('package')->result();
            $pack_database = 'tj_'.$result[0]->pack_database;
            return $pack_database;
        }
        //体检项目树TREE获取
        public function getProjectTreeJson(){
            $sorts = $this->db->get('sort')->result();
            $tree = array();
            foreach ($sorts as $sort) {
                $projects = $this->db->where('sort_id ='.$sort->sort_id)->get('project')->result();
                $childrens = array();
                foreach ($projects as $project){
                    $children = array(
                        'id' => $project->id,
                        'text' => $project->name 
                    );
                    array_push($childrens, $children);
                }
                array_push($tree, array(
                    'sid' => $sort->sort_id,
                    'text' => $sort->sort_name,
                    'children' => $childrens
                ));
            }
            return json_encode($tree);
        }
        //通过id获取项目唯一标识 然后创建套餐字段
        public function createField($id, $table){
            $project = $this->db->where('id ='.$id)->get('project')->result();
            $field = $project[0]->unique;
            $fields = $this->db->list_fields($table);
            if(!in_array($field, $fields)){
                $sql = 'alter table '.$table.' add '.$field.' varchar(30)';
                $f = $this->db->simple_query($sql);
            }
            return array('project' => $project, 'f' => $f);
        }
        //体检套餐的字段相应名字获取
        public function getFieldName($table){
            $fieldArr = array();
            $fields = $this->db->list_fields($table);
            foreach ($fields as $field){
                if($field == 'id'){ 
                    array_push($fieldArr, array(
                        'field' => 'id',
                         'name' => 'ID'
                     ));
                     continue;
                }
                $project = $this->db->where("unique ='".$field."'")->get('project')->result();
                array_push($fieldArr, array(
                   'field' => $field,
                    'name' => $project[0]->name
                ));
            }
            return $fieldArr;
        }

}
?>
