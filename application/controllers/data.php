<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Sys');
    }
    public function index(){
            $this->load->view('data/index');	
    }
    //数据库表信息JSON数据
    public function getTableJson(){
        $tableInfo = $this->Sys->getTableInfo();
        $count = count($tableInfo);
        for ($i=0; $i < $count; $i++) {
            $tableInfo[$i]->Data_length = $this->calcByte($tableInfo[$i]->Data_length);
        }
        echo json_encode($tableInfo);
    }
    //数据表优化
    public function tableOptimize(){
        $tables = $_REQUEST['tables'];
        $result = $this->Sys->tableOptimize($tables);
        echo json_encode($result);
    }
    //数据库的备份
    public function tableBackup(){
        // 加载数据库工具类
        $this->load->dbutil();
        $tables = !empty($_REQUEST['tables']) ? explode(',', $_REQUEST['tables']) : array();
        $filename = isset($_REQUEST['filename']) && !empty($_REQUEST['filename']) ? date('Y-m-d').$_REQUEST['filename'] : date('Y-m-d');
        $location = isset($_REQUEST['location']) && !empty($_REQUEST['location']) ? $_REQUEST['location'] : '';
        
        $prefs = array(
                'tables'      => $tables,   // 包含了需备份的表名的数组.
                'ignore'      => array(),           // 备份时需要被忽略的表
                'format'      => 'zip',             // gzip, zip, txt
                'filename'    => 'tj.sql',    // 文件名 - 如果选择了ZIP压缩,此项就是必需的
                'add_drop'    => TRUE,              // 是否要在备份文件中添加 DROP TABLE 语句
                'add_insert'  => TRUE,              // 是否要在备份文件中添加 INSERT 语句
                'newline'     => "\n"// 备份文件中的换行符
              );
        // 备份整个数据库并将其赋值给一个变量
        $backup = & $this->dbutil->backup($prefs); 
        
        if($location == 'server'){
            //判断文件是否已经存在
            if(file_exists('./data/'.$filename.'.zip')){
                $msg = array(
                    'success' => false,
                    'title' => '警告',
                    'text' => '今天已经有了文件名为'.(isset($_REQUEST['filename']) ? $_REQUEST['filename'] : '默认').'的备份'
                );
                exit(json_encode($msg));
            }
            
//            //测试路径是否存在
//            $this->load->helper('path');
//            echo set_realpath('data/');
            
            // 加载文件辅助函数并将文件写入你的服务器
            $this->load->helper('file');
            if(!write_file('./data/'.$filename.'.zip', $backup)){
                exit( '无法写入文件' );
            } 
            $msg = array(
                'success' => true,
                'title' => '提示',
                'text' => '备份到服务器成功'
            );
            echo json_encode($msg);
        }else{
            // 加载下载辅助函数并将文件发送到你的桌面
            $this->load->helper('download');
            force_download('tj.zip', $backup);
        }
    }
    //读取备份文件目录
    public function readBackupDir(){
        $this->load->helper('directory');
        $this->load->helper('file');
//        $map = directory_map('./data/',FALSE, TRUE);
//        echo '<pre>';
//        var_dump($map);
//        echo '</pre>';
        $files = get_dir_file_info('./data');
        $files = array_values($files);
        $count = count($files);
        for ($i=0; $i < $count; $i++) {
            $files[$i]['size'] = $this->calcByte($files[$i]['size']);
            $files[$i]['date'] = date('Y-m-d H:i:s' , $files[$i]['date']);
        }
        echo json_encode($files);
    }
    //删除备份记录
    public function deleteBackup(){
        $files = isset($_REQUEST['files']) && !empty($_REQUEST['files']) ? $_REQUEST['files'] : '';
        $msg = array(
            'success' => true,
            'title' => '提示',
            'text' => '文件删除成功'
        );
        if (is_array($files)) {
            foreach ($files as $file) {
                if(file_exists('./data/'.$file))
                    if(!unlink('./data/'.$file)){
                        $msg = array(
                            'success' => false,
                            'title' => '警告',
                            'text' => '文件'.$file.'删除失败!请重新删除！'
                        );
                        exit(json_encode($msg));
                    }
            }
        }
        exit(json_encode($msg));
    }
    //文件下载
    public function downBackup(){
        $filename = isset($_REQUEST['filename']) ? $_REQUEST['filename'] : 'file';
        if(file_exists('./data/'.$filename)){
            $this->load->helper('download');
            $data = file_get_contents( './data/'.$filename );
            force_download($filename, $data);
        }else{
            echo '文件不存在！';
        }
    }
    //读取备份文件目录
    public function readBackupFiles(){
        $this->load->helper('file');
        $files = get_filenames('./data');
        $filesArr = array();
        foreach ($files as $file){
            array_push($filesArr, array(
                'filename' => $file
            ));
        }
        echo json_encode($filesArr);
    }
    //备份文件的恢复
    public function restoreBackup(){
        $location = isset($_REQUEST['location']) ? $_REQUEST['location'] : 'server';//恢复方式：server服务器 local本地
//        $var = var_export($_FILES, TRUE);
//        file_put_contents('test1.php', $var);
//        return;
        $uploadPath = './data/';//上传路径
        if($location == 'server'){
            //服务器模式下
            $filename = isset($_REQUEST['filename']) ? $_REQUEST['filename'] : 'file';
            $targetFile = $uploadPath.$filename;//服务器的路径文件名
            
        }elseif($location == 'local'){
            //本地模式下
            if(!empty($_FILES) && $_POST['token'] == md5('tj'.$_POST['timestamp'])){
                $filetype = array('zip', 'sql', 'gzip', 'bzip2');//允许上传的文件类型
                $filename = $_FILES['Filedata']['name'];//文件名
                $targetFile = $uploadPath.$filename;//上传到服务器的路径文件名
                $fileinfo = pathinfo($_FILES['Filedata']['name']);//获取文件信息
//                $var = var_export($fileinfo, TRUE);
//                file_put_contents('test2.php', $var);
                
                if(in_array($fileinfo['extension'], $fileinfo)){    //上传文件类型是否在允许上传范围内
                    move_uploaded_file($_FILES['Filedata']['tmp_name'], $targetFile);                   
                }
                //var_export($_FILES);
            }else{
                throw new Exception('请不要执行非法操作');
            }
        }

//        $info = var_export($_FILES, true);
//        file_put_contents('./data/info.php', $info);
        //读取文件内容，并执行恢复操作
        if(isset($fileinfo) && $fileinfo['extension'] == 'sql'){
            $sql = file_get_contents($targetFile);
        }else{
            $sql = $this->readZip($targetFile);
        }
        
        $flag = true;
        $pattern = '/(DROP TABLE.*;)[^(CREATE)]*(CREATE TABLE.*\([^;]*)/i';
        preg_match_all($pattern, $sql, $matches);
        for ($i = 0; $i < count($matches[1]); $i++) {
            $this->db->simple_query($matches[1][$i]);
            $this->db->simple_query($matches[2][$i]);
        }
        
//        $pattern = '/DROP TABLE.*;/i'; //匹配dorp语句
//        $pattern = '/CREATE TABLE.*\([^;]*/i';//匹配create table语句
        $pattern = '/insert into.*;/i';//匹配insert语句
        preg_match_all($pattern, $sql, $matches);
        for($i = 0; $i < count($matches[0]); $i++){
            $this->db->simple_query($matches[0][$i]);
        }
//        exit(var_dump($matches));
//        echo '<pre>';
//        var_dump($matches);

//        如果是本地模式，则删除上传的文件
//        ($location == 'local') && unlink ($targetFile);
        
        echo json_encode(array('success' => true, 'title' => '提示','text' => '数据恢复成功'));
//            echo json_encode(array('success' => false, 'title' => '警告','text' => '数据恢复失败'));
        
    }
    //实验函数
    public function test(){
        //exec('');
         
        readfile('./data/tj.sql');
        $subject = ob_get_clean();
        $pattern = '/CREATE TABLE(.*\s)*/i';
        //$pattern = '/insert into.*;/i';
        preg_match_all($pattern, $subject, $matches);
        echo '<pre>';
        var_dump($matches);
        
    }
    public function test1(){
        echo getcwd().'<br>';
        echo __FILE__;
        var_dump($_SERVER);
    }
}