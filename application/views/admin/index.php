<table id="tj_admin_grid" class="easyui-datagrid" toolbar="#tj_admin_bar" idField="admin_id"  fitColumns="true" singleSelect="true">  
    <thead>  
        <tr>  
            <th field="admin_id" width="10">ID</th> 
            <th field="admin_name" width="100" editor="text">用户名</th>    
            <th field="admin_pwd" width="100" editor="text">密码</th>   
            <th field="role_id" hidden="true"></th>
            <th field="admin_role" width="200" editor="text">角色</th>           
        </tr>  
    </thead>  
</table>  
<div id="tj_admin_bar">  
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#tj_admin_grid').edatagrid('addRow')">新建</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#tj_admin_grid').edatagrid('destroyRow')">删除</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#tj_admin_grid').edatagrid('saveRow')">保存</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#tj_admin_grid').edatagrid('cancelRow')">取消</a>  
</div>
<script>
    $(function(){
        $('#tj_admin_grid').edatagrid({  
            url: '<?php echo site_url('admin/getAdminJson')?>',  
            saveUrl: '<?php echo site_url('admin/saveAdmin')?>',  
            updateUrl: '<?php echo site_url('admin/updateAdmin')?>',  
            destroyUrl: '<?php echo site_url('admin/deleteAdmin')?>'  
        });
    }); 
    //性别的格式化
    function sexFormat(val,row){
        return (val == 1) ? '男' : '女';
    }
</script>
