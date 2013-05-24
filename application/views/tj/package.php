<table id="tj_pack_grid" toolbar="#tj_pack_bar" idField="pack_id"  fitColumns="true" singleSelect="true">  
    <thead>  
        <tr>  
            <th field="pack_id" width="15">ID</th>
            <th field="pack_name" width="100" editor="text">套餐名</th>   
            <th field="pack_database" width="100" editor="text">套餐唯一标识</th> 
            <th field="pack_comment" width="200" editor="text">套餐描述</th>   
            <th field="pack_create_time" width="100" >创建时间</th>   
            <th field="pack_create_uid" width="80" >创建人</th>   
            <th field="pack_update_time" width="100">更新时间</th>   
            <th field="pack_update_uid" width="80" >更新人</th>             
        </tr>  
    </thead>  
</table>  
<div id="tj_pack_bar">  
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#tj_pack_grid').edatagrid('addRow')">新建</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="javascript:editPackContent()">编辑套餐内容</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#tj_pack_grid').edatagrid('destroyRow')">删除</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#tj_pack_grid').edatagrid('saveRow')">保存</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#tj_pack_grid').edatagrid('cancelRow')">取消</a>  
</div>
<script>
    function editPackContent(){//编辑套餐内容
        var row = $('#tj_pack_grid').datagrid('getSelected');
        if(!$('#tt').tabs('exists',row.pack_name)){
		$('#tt').tabs('add',{
				title:row.pack_name,
				href:'<?php echo site_url('ctj/editPackContent')?>?pack_database='+row.pack_database,
				closable:true
		});
	}else{
		$('#tt').tabs('select',row.pack_name);	
	}
    }
    $(function(){
        $('#tj_pack_grid').edatagrid({  
            url: '<?php echo site_url('ctj/getPackJson')?>',  
            saveUrl: '<?php echo site_url('ctj/savePack')?>',  
            updateUrl: '<?php echo site_url('ctj/updatePack')?>',  
            destroyUrl: '<?php echo site_url('ctj/deletePack')?>'  
        }); 
        
        
//        $('#tj_pack_grid').datagrid({  
//                view: detailview,  
//                detailFormatter:function(index,row){  
//                    return '<div style="padding:2px"><table id="ddv-' + index + '"></table></div>';  
//                },  
//                onExpandRow: function(index,row){  
//                    $('#ddv-'+index).datagrid({  
//                        url:'datagrid22_getdetail.php?itemid='+row.itemid,  
//                        fitColumns:true,  
//                        singleSelect:true,  
//                        rownumbers:true,  
//                        loadMsg:'',  
//                        height:'auto',  
//                        columns:[[  
//                            {field:'orderid',title:'Order ID',width:200},  
//                            {field:'quantity',title:'Quantity',width:100,align:'right'},  
//                            {field:'unitprice',title:'Unit Price',width:100,align:'right'}  
//                        ]],  
//                        onResize:function(){  
//                            $('#tj_pack_grid').datagrid('fixDetailRowHeight',index);  
//                        },  
//                        onLoadSuccess:function(){  
//                            setTimeout(function(){  
//                                $('#tj_pack_grid').datagrid('fixDetailRowHeight',index);  
//                            },0);  
//                        }  
//                    });  
//                    $('#tj_pack_grid').datagrid('fixDetailRowHeight',index);  
//                }  
//            });  
        });  
</script>
