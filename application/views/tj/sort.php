<table id="tj_sort_grid" toolbar="#tj_sort_bar" idField="sort_id"  fitColumns="true" singleSelect="true">  
    <thead>  
        <tr>  
            <th field="sort_id" width="10">ID</th>
            <th field="sort_name" width="100" editor="text">分类名</th>    
            <th field="sort_desc" width="200" editor="text">描述</th>    
        </tr>  
    </thead>  
</table>  
<div id="tj_sort_bar">  
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#tj_sort_grid').edatagrid('addRow')">新建</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#tj_sort_grid').edatagrid('destroyRow')">删除</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#tj_sort_grid').edatagrid('saveRow')">保存</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#tj_sort_grid').edatagrid('cancelRow')">取消</a>  
</div>
<script>
    $(function(){
        $('#tj_sort_grid').edatagrid({  
            url: '<?php echo site_url('ctj/getSortJson')?>',  
            saveUrl: '<?php echo site_url('ctj/saveSort')?>',  
            updateUrl: '<?php echo site_url('ctj/updateSort')?>',  
            destroyUrl: '<?php echo site_url('ctj/deleteSort')?>'  
        }); 
    }); 
</script>
