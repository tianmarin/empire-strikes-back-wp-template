/*
jQuery(document).ready(function($) {
	$('.page_info').toggle();
	$('.more_info') .click(
		function() {
			$('.page_info').toggle("400","linear");
		}
	)
});
*/
window.addEvent('domready',function(){
	
	var status = {
		'true': 'open',
		'false': 'close'
	};
	
	var page_more_info = new Fx.Slide('page_info',{
		duration: 500,
		hideOverflow: true
	}).hide();
	
	$('more_info').addEvent('click', function(event){
		event.stop();
		page_more_info.toggle();
	});	

	page_more_info.addEvent('start', function() {
		if(!page_more_info.open){
			$('more_info').addClass('on');
		}else{
			$('more_info').removeClass('on');
		}
	});
	
	

/*
	var myAccordion = new Fx.Accordion($$('.more_info'), $$('.page_info'), {
		display: -1,
		alwaysHide: true,
		fixedHeight: '100px',
		opacity: false
	});
*/

});