<table id="tj_result_grid" class="easyui-datagrid" toolbar="#tj_result_bar" 
       idField="id"  fitColumns="true" singleSelect="true" >  
    <thead>  
        <tr>  
            <?php if(isset($fields)){
                foreach ($fields as $field) {
                    if($field['field'] == 'id'){
                        echo "<th field=\"$field[field]\" width='100' >$field[name]</th>";  
                    }else{
                        echo "<th field=\"$field[field]\" width='100' editor='text'>$field[name]</th>";  
                    }   
                }
            }?>
        </tr>
    </thead>  
</table>  
<div id="tj_result_bar">  
    <span>套餐选择</span>
    <select id="tj_pack" class="easyui-combobox" data-options="
            valueField:'pack_database',
            textField:'pack_name',
            url:'<?php echo site_url('ctj/getPackJson')?>',
            onSelect : function(rec){
                var tab = $('#tt').tabs('getSelected');
                tab.panel('refresh', '<?php echo site_url('ctj/tresult')?>?table=tj_'+rec.pack_database);   
            }" ></select>
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#tj_result_grid').edatagrid('addRow')">新建</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#tj_result_grid').edatagrid('destroyRow')">删除</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#tj_result_grid').edatagrid('saveRow')">保存</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#tj_result_grid').edatagrid('cancelRow')">取消</a>  
</div>
<script>
$(function(){
    var table = "<?php echo $table?>";
    if(table == ""){
        $.messager.show({	
                        title: '提醒',
                        msg: '请选择套餐'
                    });
        return;
    } 
//        $('#tj_result_grid').edatagrid({  
//            url: 'index.php/ctj/getResultJson?table=<?php echo $table?>',  
//            saveUrl: 'index.php/ctj/saveResult?table=<?php echo $table?>',  
//            updateUrl: 'index.php/ctj/updateResult?table=<?php echo $table?>',  
//            destroyUrl: 'index.php/ctj/deleteResult?table=<?php echo $table?>'  
//        }); 
    $('#tj_result_grid').edatagrid({  
        url: '<?php echo site_url('ctj/getResultJson')?>',  
        saveUrl: '<?php echo site_url('ctj/saveResult')?>',  
        updateUrl: '<?php echo site_url('ctj/updateResult')?>',  
        destroyUrl: '<?php echo site_url('ctj/deleteResult')?>'  
    }); 
    }); 
</script>