<div class="col-lg-4 col-md-6">
	<div class="panel panel-default" id="munkireportinfo-errors-widget">
		<div class="panel-heading" data-container="body">
			<div class="panel-title"><i class="fa fa-times-circle"></i>
			    <span data-i18n="munkireportinfo.munkireport_errors"></span>
			    <list-link data-url="/show/listing/munkireportinfo/mrinfo"></list-link>
			</div>
		</div>
		<div class="list-group scroll-box">
			<span class="list-group-item"><span data-i18n="machine.new_clients.no_new_clients"></span></span>
		</div>
	</div><!-- /panel -->
</div><!-- /col -->

<script>
$(document).on('appUpdate', function(){
	$.getJSON( appUrl + '/module/munkireportinfo/get_errors/10', function( data ) {

		var scrollBox = $('#munkireportinfo-errors-widget .scroll-box').empty();

		$.each(data, function(index, obj){
			scrollBox
				.append($('<a>')
                    .addClass('list-group-item')
                    .attr('href', appUrl + '/show/listing/munkireportinfo/mrinfo')
                    .append($('<span>')
						.addClass('badge pull-right')
						.text(obj.count))
					.append(obj.log_error.replace(/\\n/g, "<br>").replace(/\\/g, ""))
                )
		});

		if( ! data.length){
			scrollBox
				.append($('<span>')
					.addClass('list-group-item')
					.text(i18n.t('no_errors')))
		}
	});
});
</script>