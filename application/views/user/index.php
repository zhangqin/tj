<table id="tj_user_grid" class="easyui-datagrid" toolbar="#tj_user_bar" idField="user_id"  fitColumns="true" singleSelect="true">  
    <thead>  
        <tr>  
            <th field="user_id" width="10">ID</th>
            <th field="user_name" width="100" editor="text">对象名</th>   
            <th field="user_unique" width="100" editor="text">对象唯一标识</th>   
            <th field="user_desc" width="100" editor="text">对象描述</th>          
        </tr>  
    </thead>  
</table>  
<div id="tj_user_bar">  
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#tj_user_grid').edatagrid('addRow')">新建</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:editUserContent()">编辑体检对象信息</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#tj_user_grid').edatagrid('destroyRow')">删除</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#tj_user_grid').edatagrid('saveRow')">保存</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#tj_user_grid').edatagrid('cancelRow')">取消</a>  
</div>
<script>
    $(function(){
        $('#tj_user_grid').edatagrid({  
            url: '<?php echo site_url('cuser/getUserJson')?>',  
            saveUrl: '<?php echo site_url('cuser/saveUser')?>',  
            updateUrl: '<?php echo site_url('cuser/updateUser')?>',  
            destroyUrl: '<?php echo site_url('cuser/deleteUser')?>'  
        }); 
    }); 
    //性别的格式化
    function sexFormat(val,row){
        return (val == 1) ? '男' : '女';
    }
    
    function editUserContent(){//编辑套餐内容
        var row = $('#tj_user_grid').datagrid('getSelected');
        if(!$('#tt').tabs('exists',row.user_name)){
            $('#tt').tabs('add',{
                    title:row.user_name,
                    href:'<?php echo site_url('cuser/editUserContent')?>?user_unique='+row.user_unique,
                    closable:true
            });
        }else{
            $('#tt').tabs('select',row.user_name);	
        }
    }
</script>
