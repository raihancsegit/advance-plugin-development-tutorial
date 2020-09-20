jQuery(function(){

	var ajaxurl = smc_book.ajaxurl;

	jQuery(document).on("click", "#btn-front-end-ajax", function(){

		var postdata = "action=public_ajax_request&param=first_ajax_request";

		jQuery.post(ajaxurl, postdata, function(response){

			console.log(response);
		})
	});
});