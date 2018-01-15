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
});