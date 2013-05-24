<table id="tj_role_grid" toolbar="#tj_role_bar" idField="role_id"  fitColumns="true" singleSelect="true">  
    <thead>  
        <tr>  
            <th field="role_id" width="10">ID</th>
            <th field="role_name" width="100" editor="text">角色名</th>    
            <th field="role_weight" width="100" editor="text">角色权重值</th>    
            <th field="role_comment" width="200" editor="text">角色描述</th>    
        </tr>  
    </thead>  
</table>  
<div id="tj_role_bar">  
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#tj_role_grid').edatagrid('addRow')">新建</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#tj_role_grid').edatagrid('destroyRow')">删除</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#tj_role_grid').edatagrid('saveRow')">保存</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#tj_role_grid').edatagrid('cancelRow')">取消</a>  
</div>
<script>
    $(function(){
        $('#tj_role_grid').edatagrid({  
            url: '<?php echo site_url('admin/getRoleJson')?>',  
            saveUrl: '<?php echo site_url('admin/saveRole')?>',  
            updateUrl: '<?php echo site_url('admin/updateRole')?>',  
            destroyUrl: '<?php echo site_url('admin/deleteRole')?>'  
        }); 
    }); 
</script>
