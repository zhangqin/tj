<table id="tj_menu_grid" class="easyui-datagrid"  toolbar="#tj_menu_bar" idField="m_id"  fitColumns="true" singleSelect="true" 
       sortName="m_id" sortOrder="asc" pagination="true" pageSize="15" pageList="[5,10,15,20]" showPageList="false"
       url="<?php echo site_url('cmenu/getMenuJson')?>"
       data-options="" >  
    <!--pageSize="5" pageList="[5,10,15,20]"-->
    <thead>  
        <tr>  
            <th field="m_id" width="10" order="asc" sortable="true">ID</th>  
            <th field="m_name" width="50">名字</th> 
            <th field="m_parent_id" width="50" hidden="true"></th>  
            <th field="m_category" width="50">分类</th>
            <th field="m_href" width="50">链接</th> 
            <th field="m_weight" width="50" >权重值</th>  
        </tr>  
    </thead>  
</table>  
<div id="tj_menu_bar">  
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:newMenu()">创建</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="javascript:editMenu()">编辑</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:deleteMenu()">删除</a>    
</div>
<script>
//$(function(){
//    var pager = $("#tj_menu_grid").datagrid("getPager"); 
//    pager.pagination({ 
//        showPageList:false,
//        pageSize : 12, 
//        pageList : [4,8,12,16]
//    });  
//});    
</script>

<!--创建编辑对话框-->
<div id="tj_menu_dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"  
        closed="true" buttons="#tj_menu_dlg_btns">  
    <form id="tj_menu_form" method="post">  
        <div class="fitem">  
            <label>名字</label>  
            <input name="m_name" class="easyui-validatebox" required="true">  
        </div> 
        <div class="fitem">  
            <label>分类</label>  
             <input class="easyui-combobox"   
                name="m_parent_id"  
                data-options="  
                    url:'<?php echo site_url('cmenu/getMemuCategoryJson')?>',  
                    valueField:'m_id',  
                    textField:'m_name',  
                    panelHeight:'auto'  
            ">
        </div>  
        <div class="fitem">  
            <label>链接</label>  
            <input name="m_href" class="easyui-validatebox" required="true">  
        </div> 
        <div class="fitem">  
            <label>权重值</label>  
            <input name="m_weight">  
        </div>  
    </form>  
</div>  
<div id="tj_menu_dlg_btns">  
    <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveMenu()">保存</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#tj_menu_dlg').dialog('close')">取消</a>  
</div> 
<script>
var url;
function newMenu(){//创建菜单
    $('#tj_menu_dlg').dialog('open').dialog('setTitle','新建菜单');  
    $('#tj_menu_form').form('clear');  
    url = '<?php echo site_url('cmenu/saveMenu')?>';
}  
function editMenu(){//编辑菜单
    var row = $('#tj_menu_grid').datagrid('getSelected');
    if (row){
        $('#tj_menu_dlg').dialog('open').dialog('setTitle','修改菜单');
        $('#tj_menu_form').form('load',row);
        url = '<?php echo site_url('cmenu/updateMenu')?>?id='+row.m_id;
    }
}
function saveMenu(){//保存菜单
    $('#tj_menu_form').form('submit',{  
        url: url,  
        onSubmit: function(){  
            return $(this).form('validate');  
        },  
        success: function(result){  
            var result = eval('('+result+')');  
            if (result.errorMsg){  
                $.messager.show({  
                    title: 'Error',  
                    msg: result.errorMsg  
                });  
            } else {  
                $('#tj_menu_dlg').dialog('close');      // close the dialog  
                $('#tj_menu_grid').datagrid('reload');    // reload the user data  
            }  
        }  
    });  
}  
function deleteMenu(){//删除菜单
        var row = $('#tj_menu_grid').datagrid('getSelected');
        if (row){
            $.messager.confirm('提示','确定要删除这条数据吗?',function(r){
                if (r){
                    $.post('<?php echo site_url('cmenu/deleteMenu')?>',{id:row.m_id},function(result){
                        if (result.success){
                            $('#tj_menu_grid').datagrid('reload');	
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
<style type="text/css">
#tj_menu_form{
        margin:0;
        padding:10px 30px;
}
.ftitle{
        font-size:14px;
        font-weight:bold;
        padding:5px 0;
        margin-bottom:10px;
        border-bottom:1px solid #ccc;
}
.fitem{
        margin-bottom:5px;
}
.fitem label{
        display:inline-block;
        width:80px;
}
</style>

