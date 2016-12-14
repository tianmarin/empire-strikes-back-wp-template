jQuery(document).ready(function($) {


	alert("hola");

	// slider
	var slider = new Swipe($$('.published ul li'), {
		auto:5000,
		speed:700,
		callback: function(e, pos) {
			var i = bullets.length;
				while (i--) {
					bullets[i].className = ' ';
				}
			bullets[pos].className = 'on';

		}
	});
	bullets = $$('#position em');
	
	//Previo y Next
	$('prev').addEvent('click', function(){
		slider.prev();
		return false;
	});
	$('next').addEvent('click', function(){
		slider.next();
		return false;
	});
	window.addEvent('keydown', function(event){
    	switch(event.key){
    		case 'right':
    			alert("derecha");
    			slider.next();
    			break;
    		case 'left':
    			alert("iquierda");
    			slider.prev();
    			break;
    		default:
    			break;
    	}
	});
});
