var clovertize_count = 0;
clovertize_add = function(clovertize_url) {
	clovertize_count += 1;
	var clovertize_url = clovertize_custom.plugin_url;
	var div = document.createElement('div');
	div.style.position = 'fixed';
	
	var numType = 'px';
	var heightRandom = Math.random()*.75;
	var windowHeight = 768;
	var windowWidth = 1024;
	var height = 0;
	var width = 0;
	var de = document.documentElement;
	if (typeof(window.innerHeight) == 'number') {
		windowHeight = window.innerHeight;
		windowWidth = window.innerWidth;
	} else if(de && de.clientHeight) {
		windowHeight = de.clientHeight;
		windowWidth = de.clientWidth;
	} else {
		numType = '%';
		height = Math.round( height*100 )+'%';
	}
	
	if( numType=='px' ) div.style.top = Math.round( windowHeight*heightRandom ) + numType;
	else div.style.top = height;
	div.style.left = Math.round( Math.random()*90 ) + '%';
	
	div.onclick = clovertize_add;
	div.style.zIndex = 10;
	div.style.outline = 0;
	
	var img = document.createElement('img');
	img.setAttribute('src',clovertize_url+'/images/'+Math.round(0.5+Math.random()*15)+'.png');
	var ease = "all .1s linear";
	div.style.WebkitTransition = ease;
	div.style.WebkitTransform = "rotate(1deg) scale(1.01,1.01)";
	div.style.transition = "all .1s linear";
	
	div.onmouseover = function() {
		var size = 1+Math.round(Math.random()*10)/100;
		var angle = Math.round(Math.random()*20-10);
		var result = "rotate("+angle+"deg) scale("+size+","+size+")";
		this.style.transform = result;
		//this.style['-webkit-transform'] = result;
		//this.style.webkitTransform = result;
		this.style.WebkitTransform = result;
		//this.style.MozTransform = result;
		//alert(this + ' | ' + result);
	}
	div.onmouseout = function() {
		var size = .9+Math.round(Math.random()*10)/100;
		var angle = Math.round(Math.random()*6-3);
		var result = "rotate("+angle+"deg) scale("+size+","+size+")";
		this.style.transform = result;	
		//this.style['-webkit-transform'] = result;
		//this.style.webkitTransform = result;
		this.style.WebkitTransform = result;
		//this.style.MozTransform = result;
	}
	
	var body = document.getElementsByTagName('body')[0];
	body.appendChild(div);
	div.appendChild(img);	
}