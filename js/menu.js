$(function(){
$.each(_menu, function(k, val){
	//console.log(_menu);
	if(val.m_parent_id == 0 && (role_weight > val.m_weight) ){
		var submenu = getsubmenu(val.m_id);	
       
            if(k == 0){	
                $('#menu').accordion('add', {
                    title: val.m_name,
                    content: submenu,
                    selected : true
                });
            }else{
                $('#menu').accordion('add', {
                    title: val.m_name,
                    content: submenu,
                    selected : false
                });
            }		
	}
});
function getsubmenu(m_id){
	var submenu = '<ul class="MM">';
	$.each(_menu,function(k, val){
		if(val.m_parent_id == m_id){
			submenu += ' <li><a href="javascript:;" link="'+val.m_href+'" class="addTab">'+val.m_name+'</a></li>';
		}
	});
	submenu += '</ul>';
	return submenu;
}

$('.easyui-accordion li a').click(function(){
	var title = $(this).text();
	var link = $(this).attr('link');
	if(!$('#tt').tabs('exists',title)){
		$('#tt').tabs('add',{
				title:title,
				href:base_url+link,
				closable:true,
		});
	}else{
		$('#tt').tabs('select',title);	
	}
});
});
