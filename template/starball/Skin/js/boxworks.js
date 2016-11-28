var tyn = {
	wheeled : false,
	browser : function(){
		var ua=navigator.userAgent, ie=ua.match(/msie ([0-9])+/i);
		var b={
			firefox : (/firefox/i).test(ua),
			webkit : (/applewebkit/i).test(ua),
			chrome : (/chrome/i).test(ua),
			opera : (/opera/i).test(ua),
			ios : (/ip(ad|hone|od)/i).test(ua),
			android : (/android/i).test(ua),
			support : {
				fixed : true,
				opacity : true,
				placeholder : 'placeholder' in document.createElement('input')
			}
		};
		b.mobile=document.hasOwnProperty && document.hasOwnProperty('ontouchstart') && (b.ios || b.android);

		if(b.webkit && !b.chrome){
			b.safari=true;
		}

		if(ie){
			ie=parseInt(ie[1]);
			if(7>ie){
				b.support.fixed=false;
			}
			if(9>ie){
				b.support.opacity=false;
			}
			b.ie=ie;
		}

		return b;

	}(),

	gnb : {
		//existed.
		hashGet:function(){
			if(window.location.hash) {
				var hash=window.location.hash.split('#')[1];
				if($('[name='+hash+']').length){
					$('[name='+hash+']').trigger('click');
				}else if($('[name=to-'+hash+']').length){
					$('[name=to-'+hash+']').click();
				}
			}
		},
		initialize : function(){
			$('.sublist li a').on('click',function(e){
				var url = $(this).attr('href'), id = url.split('#')[1];
				location.href = url;
				tyn.gnb.hashGet();
				return false;
			});
		}

	},

	brand :  function(){

		var $wrap=$('#mColum'),

			$items=$wrap.find('>li'),
			$itemsgroup=[],
			$lists=$wrap.find('div.base'),
			$masks=$wrap.find('div.mask'),
			$covers=$wrap.find('div.mask'),
			$contents=$wrap.find('div.expand-box'),
			$slidecontent,

			minheight=$('.lobby-list').height(),
			toppositions=[], containertop=$('#lobby')[0].offsetTop,
			i=0, groupindex=-1, nowindex=-1, max=$items.length,
			$opengroup, $closegroup,

			anioption=[
				{ queue:false, duration:750, easing:'easeInOutQuart', step:onopening, complete:onopen },//open
				{ queue:false, duration:750, easing:'easeInOutQuart', step:onclosing, complete:onclose },//close
				{ queue:false, duration:650, easing:'easeInQuad' },//cover show
				{ queue:false, duration:500, easing:'linear' },//cover hide
				{ queue:false, duration:750, easing:'easeInOutQuart' }//browser scroll
			];

		for(; i<max; i++){

			if(i%4==0){
				groupindex++;
				$itemsgroup[groupindex]=[];
				toppositions.push($items[i].offsetTop+containertop-1000);
			}

			$items[i]=$($items[i]);
			$lists[i]=$($lists[i])
				.attr('data-index', i)
				.mouseenter(over)
				.mouseleave(out)
				.click(click);
			$itemsgroup[groupindex].push($items[i]);

			$masks[i]=$($masks[i]).attr('data-index', i);
			$covers[i]=$('<div class="cover" />');
		}

		function over(){
			$items[this.getAttribute('data-index')].addClass('hover');
		}

		function out(){
			$items[this.getAttribute('data-index')].removeClass('hover');
		}

		function click(){
			var mygroup, openedindex,
				openedgroup=Math.floor(nowindex/4);
			for(i=0; i<max; i++){
				mygroup=Math.floor(i/4);
				if($lists[i][0]==this && !$items[i].hasClass('act')){
					$items[i].addClass('act');
					$opengroup=$itemsgroup[mygroup];
					$masks[i].stop().css('height', (mygroup==openedgroup)? $contents[nowindex].offsetHeight+6 : 0)//set opened height
						.animate({ height:$contents[i].offsetHeight+6 }, anioption[0]);
					$covers[i].css('opacity', 1).appendTo($masks[i]).animate({ opacity:0 }, anioption[2]);
					nowindex=i;
				}else if($items[i].hasClass('act')){
					openedindex=i;
				}
			}
			if(openedindex!=undefined){
				mygroup=Math.floor(openedindex/4);
				if(nowindex!=openedindex && mygroup==Math.floor(nowindex/4)){
					$items[openedindex].removeClass('act');
					$masks[openedindex].stop().css('height', 0);
				}else{
					$closegroup=$itemsgroup[mygroup];
					if(nowindex==openedindex){
						nowindex=-1;
						$covers[openedindex].css('opacity', 0).appendTo($masks[openedindex]).animate({ opacity:1 }, anioption[3]);
					}
					$masks[openedindex].stop().animate({ height:0 }, anioption[1]);
				}
			}
			tyn.nameGet($(this));
		}

		function onopening(v){
			var i=0, max=$opengroup.length;
			for(; i<max; i++){
				$opengroup[i][0].style.marginBottom=v+20+'px';
			}
		}

		function onopen(){
			$covers[nowindex].remove();
			$("html,body").stop().animate({ scrollTop:toppositions[Math.floor(nowindex/4)] }, anioption[4]);
		}

		function onclosing(v){
			var i=0, max=$closegroup.length;
			for(; i<max; i++){
				$closegroup[i][0].style.marginBottom=v+20+'px';
			}
		}

		function onclose(){
			var index=this.getAttribute('data-index');
			$covers[index].remove();
			$items[index].removeClass('act');
		}

		if(tyn.browser.ie===6 || tyn.browser.ie===7){
			$items[0].parent().append('<li class="blankforoldie" />');
		}

	},
	//to top button
	totop : {

		$box : null,
		showup : false,
		showheight : 199,
		visualheight : 275,
		anioption : [
			{ queue:false, duration:300, easing:'linear' }
		],

		remove : function(){
			this.parentNode.removeChild(this);
		},

		reposition : function(){

			var totop=tyn.totop,
				$box=totop.$box,
				maxtop=totop.visualheight+161,
				bodywidth=document.body.clientWidth,
				bodyheight=document.documentElement.clientHeight,
				scrolltop=$window.scrollTop();

			if(bodywidth>940){
				$box.show().css('right', (bodywidth>1280)? (bodywidth-1280)/2 : '');
			}else{
				$box.hide();
			}

			if(scrolltop>totop.showheight){
				if(!totop.showup){
					totop.showup=true;
					totop.anioption[0].complete=null;
					$box.appendTo(document.body);
					$box.stop().animate({ opacity:1 }, totop.anioption[0]);
				}
			}else{
				if(totop.showup){
					totop.showup=false;
					totop.anioption[0].complete=totop.remove;
					$box.stop().animate({ opacity:0 }, totop.anioption[0]);
				}
			}

			if(maxtop>bodyheight){
				$box.css('bottom', (maxtop>scrolltop+bodyheight)? scrolltop+bodyheight-maxtop : 0);
			}else{
				$box.css('bottom', 0);
			}

		},

		go : function(){
			$("html,body").stop().animate({ scrollTop:0 }, { queue:false, duration:1000, easing:'easeInOutQuart' });
			return false;
		},

		initialize : function(){
			this.$box=$('#totop').remove().css('opacity', 0).click(this.go);
			$window.load(this.reposition)
				.scroll(this.reposition)
				.resize(this.reposition);
		}

	},
	
	//existed.
	nameGet : function(obj){
		var ids = obj.attr('name').replace('to-', '');
		var loc = location.href;
		loc = loc.split('#')[0];
		location.replace(loc+'#'+ids);
	},

	initialize : function(){
		window.$window=$(window);
		//navi
		this.gnb.initialize();
		this.brand();
		//top button
		this.totop.initialize();
		//hash
		this.gnb.hashGet();
	}


};

$(function() {

	tyn.initialize();
	window.onready && onready();

});
