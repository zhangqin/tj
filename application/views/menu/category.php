<!--菜单分类表-->
<table id="tj_menu_category_grid" class="easyui-datagrid"  toolbar="#tj_menu_category_bar" idField="m_id"  fitColumns="true" singleSelect="true" 
       url="<?php echo site_url('cmenu/getMemuCategoryJson')?>" >  
    <thead>  
        <tr>  
            <th field="m_id" width="10" order="asc" sortable="true">ID</th>  
            <th field="m_name" width="50" editor="text">名字</th> 
            <th field="m_weight" width="50" editor="text">权重值</th> 
        </tr>  
    </thead>  
</table>  
<div id="tj_menu_category_bar">  
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#tj_menu_category_grid').edatagrid('addRow')">新建</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#tj_menu_category_grid').edatagrid('destroyRow')">删除</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#tj_menu_category_grid').edatagrid('saveRow')">保存</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#tj_menu_category_grid').edatagrid('cancelRow')">取消</a>    
</div>
<script>
    $(function(){
        $('#tj_menu_category_grid').edatagrid({  
            url: '<?php echo site_url('cmenu/getMemuCategoryJson')?>',  
            saveUrl: '<?php echo site_url('cmenu/saveMemuCategory')?>',  
            updateUrl: '<?php echo site_url('cmenu/updateMemuCategory')?>',  
            destroyUrl: '<?php echo site_url('cmenu/deleteMemuCategory')?>'  
        }); 
    }); 
</script>