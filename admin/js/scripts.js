// tinyMCE gives issues with the substr()
// tinymce.init({ selector:'textarea' });

// Bulk functionality
$(function(){

	$('#selectAll').click(function(event){
		if(this.checked){
			$('.checkBox').each(function(){
				this.checked = true;
			});
		} else{
			$('.checkBox').each(function(){
				this.checked = false;
			});
		}
	});
	
	// Prepend would be slower - It has been added to admin-header
	// var loading = '<div id="loading"><img src="img/loader.gif" alt="loader-gif"/></div>';
	// $('body').prepend(loading);
	$('#loading').delay(300).fadeOut(400, function(){
		$(this).remove();
	});
});