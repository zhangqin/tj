<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=Content-Type content=text/html; charset=utf-8>
<title>管理页面</title>

<link href="<?php echo base_url();?>css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/easyui/themes/icon.css">
<link rel="stylesheet" href="<?php echo base_url();?>js/uploadify/uploadify.css" type="text/css"/>
<script type="text/javascript" src="<?php echo base_url();?>js/easyui/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/easyui/ext/jquery.edatagrid.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/easyui/ext/datagrid-detailview.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/easyui/locale/easyui-lang-zh_CN.js"></script>   
<script>
var base_url = 	"<?php echo base_url()?>";
var role_weight = <?php echo $role_weight?>;
var _menu = <?php echo json_encode($menu)?>;
</script>
<script src="<?php echo base_url();?>js/menu.js" type="text/javascript"></script>
</head>

<body class="easyui-layout">  
    <div region="north"   style="height:64px;" border="false">
    	<table width="100%" height="64" border="0" cellpadding="0" cellspacing="0" class="admin_topbg">
          <tr>
            <td width="61%" height="64"><img src="<?php echo base_url();?>images/logo.jpg" width="262" height="64"></td>
            <td width="39%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="74%" height="38" class="admin_txt"><?php echo $role_name?>：<b><?php echo $admin_xm?></b> 您好,感谢登陆使用！</td>
                <td width="22%"><a href="<?php echo site_url('cuser/logout')?>" target="_self" ><img src="<?php echo base_url();?>images/out.gif" alt="安全退出" width="46" height="20" border="0"></a></td>
                <td width="4%">&nbsp;</td>
              </tr>
              <tr>
                <td height="19" colspan="3">&nbsp;</td>
                </tr>
            </table></td>
          </tr>
        </table>
    </div> 
    <div region="west" split="true" title="网站常规管理" style="width:191px; ">
    	<div id="menu" class="easyui-accordion" fit="true" >  
		
        </div> 
    </div>  
    <div region="center"  style="padding:0px;background:#eee;">
    	<div id="tt" class="easyui-tabs" fit="true" data-options=""  style="margin:0px;">
		
    	</div>
    </div>  
    
	<div region="south"   style="height:30px;padding:0px">
		<div class="footer">copyright 2012 ncist</div>
	</div> 
</body>  

</html>
