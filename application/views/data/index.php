<div id="tj_process" class="easyui-dialog" data-options="title:'',modal:true, closed: true" style="width: 204px; padding: 0px; overflow: hidden;">
    <img src="<?php echo base_url()?>images/jdt.gif"/>
</div>
<div class="easyui-tabs" data-options="fit:true,plain:true" style="margin-top:5px;">
    <div title="优化备份" >
        <table id="tj_data_grid" class="easyui-datagrid" idField="Name"  fitColumns="true" toolbar="#tj_data_bar"
               url="<?php echo site_url('data/getTableJson')?>">
             <thead>  
                 <tr>   
                     <th field="id" checkbox="true"></th> 
                     <th field="Name" width="20">表名</th> 
                     <th field="Engine" width="20">引擎</th> 
                     <th field="Data_length" width="20">大小</th>  
                     <th field="Version" width="20" >版本</th> 
                     <th field="Create_time" width="20" >创建时间</th>  
                     <th field="Update_time" width="20" >更新时间</th>  
                     <th field="Collation" width="20" >字符集</th>  
                     <th field="Comment" width="40">注释</th>
                 </tr>  
             </thead>  
         </table>  
        <div class="easyui-panel" style="padding:3px 20px; text-align: right">
            <!--<a href="#" class="easyui-linkbutton" iconCls="icon-blank"  onclick="javascript:tableExport()">表导出</a>-->  
            <a href="#" class="easyui-linkbutton" iconCls="icon-blank"  onclick="javascript:openBackupDialog()">表备份</a>  
            <a href="#" class="easyui-linkbutton" iconCls="icon-blank"  onclick="javascript:tableOptimize()">表优化</a>  
        </div>
        <!--备份选项选择对话框-->
        <div id="tj_backup" class="easyui-dialog" data-options="title:'备份选项',modal:true, closed: true, buttons:'#tj_backup_bar'" style="width:400px;height:280px;padding:10px 20px">
            <fieldset>
                <legend>需要备份</legend>
                <input type="radio" name="backup_range"/>全表 <input type="radio" name="backup_range" checked="ckecked"/>被选中的表
            </fieldset>
            <fieldset>
                <legend>备份至</legend>
                <input type="radio" name="backup_location" checked="checked"/>服务器 
                <label for="filename">文件名</label><input type="text" name="filename" style="width: 100px;"/>
                <input type="radio" name="backup_location"/>本地
            </fieldset>
<!--            <fieldset>
                <legend>是否启用分卷</legend>
                <input type="radio" name="isSubsection"/>不启用<input type="radio" name="isSubsection"/>启用  分卷大小<input type="text" style="width: 40px;"/>Mb
            </fieldset>-->
        </div>
        <div id="tj_backup_bar">
            <a href="#" class="easyui-linkbutton" onclick="javascript:tableBackup()">执行</a>
            <a href="#" class="easyui-linkbutton" onclick="javascript:closeBackupDialog()">取消</a>
        </div>
    </div>
    <script>
        var tj_backup = $('#tj_backup');
        $(function(){
            tj_backup.find('input[name="backup_location"]').first().click(function(){
                $(this).nextAll(':lt(2)').show();
            });
            tj_backup.find('input[name="backup_location"]').last().click(function(){
                $(this).prevAll(':lt(2)').hide();
            });
        });
        function tableSelections(){//获取被选中的行
            var rows = $('#tj_data_grid').datagrid('getSelections');
            if(rows.length == 0) return false;
            var names = [];
            for(var i=0;i<rows.length;i++){
                names.push(rows[i].Name);
            }
            return names;
        }
        function tableOptimize(){//数据表优化
            var names = tableSelections();
            if(!names){
                $.messager.show({  
                    title:'警告',  
                    msg:'请至少选择一个表',  
                    showType:'slide',
                    timeout: 2000
                });  
                return;
            } 
            $('#tj_process').dialog('open');
            $.post('<?php echo site_url('data/tableOptimize')?>', {tables : names.join(',') }, function(data){
                //data = eval('data');
                $('#tj_process').dialog('close');
                $.messager.show({  
                    title:'提示',  
                    msg:'优化成功',  
                    showType:'slide',
                    timeout: 2000
                });  
            });
        }
        function openBackupDialog(){//打开备份对话框
            var names = tableSelections();
            if(!names){
                $.messager.show({  
                    title:'警告',  
                    msg:'请至少选择一个表',  
                    showType:'slide',
                    timeout: 2000
                });  
                return;
            } 
            $('#tj_backup').dialog('open');
        }
        function closeBackupDialog(){
            $('#tj_backup').dialog('close');
        }
        function tableBackup(){
            var tables = tableSelections(),
                server_flag = tj_backup.find('input[name="backup_location"] ').first().is(':checked'),
                table_flag = tj_backup.find('input[name="backup_range"] ').first().is(':checked'),
                filename = tj_backup.find('input[name="filename"]').val();
               
            if(table_flag) tables = '';//为空代表备份全表
            var url = '<?php echo site_url('data/tableBackup')?>?tables='+tables;;
            if(server_flag){
                url+='&location=server';
                if(filename !='') url+='&filename='+filename;
                
                $('#tj_process').dialog('open');
                $.get(url, function(data){
                    var data = eval('('+data+')');
                    $('#tj_process').dialog('close');
                    $('#tj_data_backup_grid').datagrid('reload'); 
                    $('#backup_files').combobox('reload');
                    $.messager.show({  
                        title:data.title,  
                        msg: data.text,  
                        showType:'slide',
                        timeout: 2000
                    });  
                });
            }else{
                window.location.href = url;
            } 
            $('#tj_backup').dialog('close');
            
        }
    </script>
    <div title="备份记录">
        <table id="tj_data_backup_grid" class="easyui-datagrid" idField="name"  fitColumns="true" toolbar="#tj_data_backup_bar"
               url="<?php echo site_url('data/readBackupDir')?>">
             <thead>  
                 <tr>   
                     <th field="bid" checkbox="true"></th> 
                     <th field="name" width="20">备份名字</th> 
                     <th field="date" width="20">创建时间</th> 
                     <th field="size" width="20">备份大小</th>  
                 </tr>  
             </thead>  
         </table>  
        <div class="easyui-panel" style="padding:3px 20px; text-align: right">
            <!--<a href="#" class="easyui-linkbutton" iconCls="icon-blank"  onclick="javascript:tableExport()">表导出</a>-->  
            <a href="#" class="easyui-linkbutton" iconCls="icon-blank"  onclick="javascript:deleteBackup()">删除</a>  
            <a href="#" class="easyui-linkbutton" iconCls="icon-blank"  onclick="javascript:downBackup()">下载</a>  
        </div>           
    </div>
    <script>
    function filesSelections(){//获取被选中的行 //?会一直叠加，即使已经reload数据表格控件
        var rows = $('#tj_data_backup_grid').datagrid('getSelections');
        if(rows.length == 0) return false;
        var files = [];
        for(var i=0;i<rows.length;i++){
            files.push(rows[i].name);
        }
        return files;
    }
    function deleteBackup(){//删除备份记录
        var files = filesSelections();
        files = files ? files : '';
        if(files != ''){
            $.post('<?php echo site_url('data/deleteBackup')?>', {"files": files},function(msg){
                msg = eval('('+msg+')');
                $.messager.show({  
                    title:msg.title,  
                    msg: msg.text,  
                    showType:'slide',
                    timeout: 2000
                });
                if(msg.success) {
                    $('#tj_data_backup_grid').datagrid('reload'); 
                    $('#backup_files').combobox('reload');
                }
            });
        }else{
            $.messager.show({  
                title:'警告',  
                msg: '请选择至少一个文件！',  
                showType:'slide',
                timeout: 2000
            });
        }
    }
    function downBackup(){//下载备份记录
        var files = filesSelections();
        files = files ? files : '';
        if(files != ''){
            for(var i in files){
                window.open('<?php echo site_url('data/downBackup')?>?filename='+files[i]);
            }
        }else{
            $.messager.show({  
                title:'警告',  
                msg: '请选择至少一个文件！',  
                showType:'slide',
                timeout: 2000
            });
        } 
        
    }
    </script>
    <div title="数据恢复" style="padding:10px;">
        <fieldset>
            <legend>从服务器恢复</legend>
            <div>
                <label>文件列表</label>
                <input class="easyui-combobox" 
                    id="backup_files"
                    name="filename"  
                    data-options="  
                        url:'<?php echo site_url('data/readBackupFiles')?>',  
                        valueField:'filename',  
                        textField:'filename',  
                        panelHeight:'auto'  
                ">
                <input type="button" value="开始恢复" onclick="javascript:restoreServer()"/>
            </div>
        </fieldset>
        <fieldset>
            <legend>从本地恢复</legend>
            <div>
               <form > <!-- method="post" enctype="multipart/form-data"-->
                    <p>文件可能已压缩 (gzip, bzip2, zip) 或未压缩。</p>
                    <p>压缩文件名必须以 .[sql]或.[压缩方式] 结尾。如：.sql或.zip</p>
                    <p>本功能在恢复备份数据的同时，将全部覆盖原有数据，请确定是否需要恢复，以免造成数据损失</p>
<!--                    <p>数据恢复功能只能恢复由dShop导出的数据文件，其他软件导出格式可能无法识别</p>-->
                    <p>从本地恢复数据需要服务器支持文件上传并保证数据尺寸小于允许上传的上限，否则只能使用从服务器恢复</p>
<!--                    <p>如果您使用了分卷备份，只需手工导入文件卷1，其他数据文件会由系统自动导入</p> -->
                    <input type="file" id="local_filename" name="local_filename"/>
                    <input type="button" id="btn_backup_upload" value="开始恢复" onclick="javascript:$('#local_filename').uploadify('upload');"/>
                </form>            
            </div>
        </fieldset>
        
    </div>
    <script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#local_filename').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('tj' . $timestamp);?>'
				},
				'swf'      : '<?php echo base_url()?>js/uploadify/uploadify.swf',
                'cancelImg': '<?php echo base_url()?>js/uploadify/uploadify-cancel.png',
				'uploader' : '<?php echo site_url('data/restoreBackup?location=local')?>',
                'auto'  :   false,
                'multi' :   false,
                'buttonText' : '选择文件',
                'onUploadComplete' : function(file) {
//                        alert('The file ' + file.name + ' finished processing.');
                    },
                'onUploadSuccess' : function(file, data, response) {
//                        alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
                        data = eval('('+data+')');
                        $.messager.show({  
                            title:data.title,  
                            msg: data.text,  
                            showType:'slide',
                            timeout: 2000
                        });
                    }
			});
		});
        function restoreServer(){//从服务器恢复数据
            var filename = $('#backup_files').combobox('getValue');
//            alert(filename);
            $.post('<?php echo site_url('data/restoreBackup?location=server')?>',{"filename" : filename},function(data){
                data = eval('('+data+')');
                $.messager.show({  
                    title:data.title,  
                    msg: data.text,  
                    showType:'slide',
                    timeout: 2000
                });
            });
        }
	</script>
</div>
