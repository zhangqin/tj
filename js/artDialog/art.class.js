function myArt(){}

function myArt(){
	this.id			=	null;
	this.title		=	'';
	this.content	=	'';
	this.width		=	'auto' ;
	this.height		=	'auto';
	//位置
	this.fixed		=	false;
	this.follow		=	null;
	this.left		=	'50%';
	this.top		=	'38.2%';
	//视觉
	this.lock		=	false;
	this.background	=	'#000';
	this.opacity	=	0.7,
	this.icon		=	null;
	this.padding	=	'20px 25px';
	//交互
	this.time		=	null;
	this.resize		=	true;
	this.drag		=	true;
	this.esc		=	true;
	//高级
	this.zIndex		=	1987;
	this.init		=	null;
	this.close		=	null;
	this.show		=	true;
	//按钮
	this.ok			=	null;
	this.cancel		=	null;
	this.okVal		=	'确实';
	this.cancelVal	=	'取消';
	this.button		=	null;
}

myArt.prototype.open = function(){
	var self	 = this,
		url		 = self.url,
		options = {
			'id' 		: self.id,
			'title' 	: self.title,
			'width'		: self.width,
			'height'	: self.height,
			//位置
			'fixed'		: self.fixed,
			'follow'	: self.follow,
			'left'		: self.left,
			'top'		: self.top,
			//视觉
			'lock'		: self.lock,
			'background': self.background,
			'opacity'	: self.opacity,
			'icon'		: self.icon,
			'padding'	: self.padding,
			//交互
			'time'		: self.time,
			'resize'	: self.resize,
			'drag'		: self.drag,
			'esc'		: self.esc,
			//高级
			'zIndex'	: self.zIndex,
			'init'		: self.init,
			'close'		: self.close,
			'show'		: self.show
		},
		cache = false;
	return art.dialog.open(url, options, cache);
	
}

myArt.prototype.dialog = function(){
		var	self = this, options = {
			'id' 		: self.id,
			'content'	: self.content,
			'title' 	: self.title,
			'width'		: self.width,
			'height'	: self.height,
			//位置
			'fixed'		: self.fixed,
			'follow'	: self.follow,
			'left'		: self.left,
			'top'		: self.top,
			//视觉
			'lock'		: self.lock,
			'background': self.background,
			'opacity'	: self.opacity,
			'icon'		: self.icon,
			'padding'	: self.padding,
			//交互
			'time'		: self.time,
			'resize'	: self.resize,
			'drag'		: self.drag,
			'esc'		: self.esc,
			//高级
			'zIndex'	: self.zIndex,
			'init'		: self.init,
			'close'		: self.close,
			'show'		: self.show
		};
		return art.dialog(options);
}

myArt.prototype.addUrl = function(url){
	this.url = url;
	return this;//为神马 return this.url会提示open is not a function
				//返回this成功是因为this中包含open() 方法
}

art.prototype.addId = function(id){
	this.id	=	id;
	return this;
}

art.prototype.addContent = function(content){
	this.content	=	content;
	return this;
}

myArt.prototype.addTitle = function(title){
	this.title = title;
	return this;
}

myArt.prototype.addContent = function(content){
	this.content = content;
	return this;
}

myArt.prototype.addWidth = function(width){
	this.width = width;
	return this;
}

myArt.prototype.addHeight = function(height){
	this.height = height;
	return this;
}
//位置控制
myArt.prototype.isFixed = function(fixed){
	this.fixed =(typeof(fixed) == 'boolean') ? fixed : false;
	return this;
}

myArt.prototype.addFollow = function(follow){
	this.follow = (typeof(follow) != null) ? follow : null;
	return this;
}

myArt.prototype.addLeft = function(left){
	this.left = left;
	return this;
}

myArt.prototype.addTop = function(top){
	this.top = top;
	return this;
}
//视觉控制
myArt.prototype.isLock = function(lock){
	this.lock =(typeof(lock) == 'boolean') ? lock : false;
	return this;
}

myArt.prototype.addBackground = function(background){
	this.background = background;
	return this;
}

myArt.prototype.addOpacity = function(opacity){
	this.opacity = opacity;
	return this;
}

myArt.prototype.addIcon = function(icon){
	this.icon = icon;
	return this;
}

myArt.prototype.addPadding = function(padding){
	this.padding = padding;
	return this;
}
//交互控制
myArt.prototype.addTime = function(time){
	this.time = (typeof(time) == 'number') ? time : null;
	return this;
}
myArt.prototype.isResize = function(resize){
	this.resize = (typeof(resize) == 'boolean') ? resize : true;
	return this;
}
myArt.prototype.isDrag = function(drag){
	this.drag = (typeof(drag) == 'boolean') ? drag : true;
	return this;
}
myArt.prototype.isEsc = function(esc){
	this.esc = (typeof(esc) == 'boolean') ? esc : true;
	return this;
}
//高级控制
myArt.prototype.addZIndex = function(zIndex){
	this.zIndex = zIndex;
	return this;
}

myArt.prototype.addInit = function(init){
	this.init = init;
	return this;
}

myArt.prototype.addClose = function(close){
	this.close = close;
	return this;
}

myArt.prototype.isShow = function(show){
	this.padding = (typeof(show) == 'boolean') ? padding : true;
	return this;
}
//按钮控制
myArt.prototype.addOk = function(ok){
	this.ok = ok;
	return this;
}

myArt.prototype.addCancel = function(cancel){
	this.cancel = cancel;
	return this;
}

myArt.prototype.addOkVal = function(okVal){
	this.okVal = okVal;
	return this;
}

myArt.prototype.addCancelVal = function(cancelVal){
	this.cancelVal = cancelVal;
	return this;
}

myArt.prototype.addButton = function(button){
	this.button = button;
	return this;
}
