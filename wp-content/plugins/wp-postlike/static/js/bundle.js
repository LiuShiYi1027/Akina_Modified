 jQuery.fn.postLike = function() {
 	var __self = jQuery(this),
 	id = __self.data("id"),
 	action = __self.data('action'),
 	countWrapper = __self.children('.count'),
 	ajax_data = {
			action: "wpl_callback",
			id: id
		};
	if (__self.hasClass('is-active')) {
		alert('您已经赞过啦~');
	} else {
		__self.addClass('is-active');
		jQuery.ajax({
			url: wpl_ajax_url,
			type: "POST",
			data: ajax_data,
			dataType: "json",
			success: function(data) {
				if(data.code == 200){
					countWrapper.html(data.data);
				} else {
					alert(data.error);
				}
			}
		});
		return false;
	}
};
jQuery(document).on("click", ".wpl-button",
function() {
	var self = jQuery(this);
	self.postLike();
});