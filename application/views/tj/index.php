<table id="tj_project_grid" class="easyui-datagrid"  toolbar="#tj_project_bar" idField="id"  fitColumns="true" singleSelect="true" 
       sortName="id" sortOrder="asc"
       url="<?php echo site_url('ctj/getProjectJson')?>">  
    <thead>  
        <tr>  
            <th field="id" width="10" order="asc" sortable="true">ID</th>  
            <th field="name" width="50">项目</th> 
            <th field="unique" width="50">唯一标识</th> 
            <th field="sort_id" hidden="true"></th>  
            <th field="sort_name" width="50" >分类</th>  
            <th field="comment" width="200">说明</th>
        </tr>  
    </thead>  
</table>  
<div id="tj_project_bar">  
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:newProject()">创建</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="javascript:editProject()">编辑</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:deleteProject()">删除</a>    
</div>
<!--创建编辑对话框-->
<div id="tj_project_dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"  
        closed="true" buttons="#tj_project_dlg_btns">  
    <form id="tj_project_form" method="post">  
        <div class="fitem">  
            <label>项目</label>  
            <input name="name" class="easyui-validatebox" required="true">  
        </div> 
        <div class="fitem">  
            <label>唯一标识</label>  
            <input name="unique" class="easyui-validatebox" required="true">  
        </div> 
        <div class="fitem">  
            <label>分类</label><br>  
             <input class="easyui-combobox"   
                name="sort_id"  
                data-options="  
                    url:'<?php echo site_url('ctj/getSortJson')?>',  
                    valueField:'sort_id',  
                    textField:'sort_name',  
                    panelHeight:'auto'  
            ">
        </div>  
        <div class="fitem">  
            <label>说明</label>  
            <input name="comment">  
        </div>  
    </form>  
</div>  
<div id="tj_project_dlg_btns">  
    <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveProject()">保存</a>  
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#tj_project_dlg').dialog('close')">取消</a>  
</div> 
<script>
var url;
function newProject(){//创建新项目
    $('#tj_project_dlg').dialog('open').dialog('setTitle','新建体检项目');  
    $('#tj_project_form').form('clear');  
    url = '<?php echo site_url('ctj/saveProject')?>';
}  
function editProject(){//编辑项目
    var row = $('#tj_project_grid').datagrid('getSelected');
    if (row){
        $('#tj_project_dlg').dialog('open').dialog('setTitle','编辑体检项目');
        $('#tj_project_form').form('load',row);
        url = '<?php echo site_url('ctj/updateProject')?>?id='+row.id;
    }
}
function saveProject(){//保存项目
    $('#tj_project_form').form('submit',{  
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
                $('#tj_project_dlg').dialog('close');      // close the dialog  
                $('#tj_project_grid').datagrid('reload');    // reload the user data  
            }  
        }  
    });  
}  
function deleteProject(){//删除项目
        var row = $('#tj_project_grid').datagrid('getSelected');
        if (row){
            $.messager.confirm('提示','确定要删除这条数据吗?',function(r){
                if (r){
                    $.post('<?php echo site_url('ctj/deleteProject')?>',{id:row.id},function(result){
                        if (result.success){
                            $('#tj_project_grid').datagrid('reload');	
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
#tj_project_form{
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

