<table id="tj_packContent_grid" class="easyui-datagrid" toolbar="#tj_packContent_bar" idField="pack_id"
       fitColumns="true" singleSelect="true" 
       url="<?php echo site_url('ctj/getPackContent')?>?pack_database=<?php echo $pack_database;?>">  
    <thead>  
        <tr>  
            <th field="unique" width="100">项目唯一标识</th>
            <th field="name" width="100" >项目</th>   
            <th field="comment" width="200" >项目描述</th> 
        </tr>  
    </thead>  
</table>  
<div id="tj_packContent_bar">  
    <select id="tj_project_tree" class="easyui-combotree" data-options="url:'<?php echo site_url('ctj/getProjectTreeJson')?>'" multiple style="width:200px;"></select>
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:newPackContent()">新建</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:deletePackContent()">删除</a>    
</div>

<script>
$(function(){
    
});   
var $table = "<?php  echo $pack_database;?>";
function newPackContent(){//新建套餐内容
    $ids = $('#tj_project_tree').combotree('getValues');
    $.post('<?php echo site_url('ctj/newPackContent')?>',{ids : $ids, table : $table}, function(data){
         $('#tj_packContent_grid').datagrid('reload');
         $('#tj_project_tree').combotree('clear');
    });
    
}
function deletePackContent(){//删除套餐内容
    var row = $('#tj_packContent_grid').datagrid('getSelected');
        if (row){
            $.messager.confirm('提示','确定要删除这条数据吗?',function(r){
                if (r){
                    $.post('<?php echo site_url('ctj/deletePackContent')?>',{unique:row.unique, table : $table},function(result){
                        if (result.success){
                            $('#tj_packContent_grid').datagrid('reload');	
                        } else {
                            $.messager.show({	
                                title: '错误',
                                msg: result.errorMsg
                            });
                        }
                    },'json');
                }
            });
        }
}
</script>
