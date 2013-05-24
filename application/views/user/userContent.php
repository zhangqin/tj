<table id="tj_user_content_grid" class="easyui-datagrid" toolbar="#tj_user_content_bar" idField="id"  fitColumns="true" singleSelect="true">  
    <thead>  
        <tr>  
            <th field="id" width="10">ID</th>
            <th field="name" width="100" editor="text">信息</th>   
            <th field="unique" width="100" editor="text">唯一标识</th>   
            <th field="type" width="100" editor="text">类型</th>  
            <th field="lenght" width="100" editor="text">长度</th>  
        </tr>  
    </thead>  
</table>  
<div id="tj_user_content_bar">  
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#tj_user_content_grid').edatagrid('addRow')">新建</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#tj_user_content_grid').edatagrid('destroyRow')">删除</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#tj_user_content_grid').edatagrid('saveRow')">保存</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#tj_user_content_grid').edatagrid('cancelRow')">取消</a>  
</div>
<script>
    $(function(){
        $('#tj_user_content_grid').edatagrid({  
            url: '<?php echo site_url('cuser/getUserJson')?>',  
            saveUrl: '<?php echo site_url('cuser/saveUser')?>',  
            updateUrl: '<?php echo site_url('cuser/updateUser')?>',  
            destroyUrl: '<?php echo site_url('cuser/deleteUser')?>'  
        }); 
    }); 