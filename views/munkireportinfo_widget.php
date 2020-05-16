<div class="col-lg-4 col-md-6">
	<div class="panel panel-default" id="munkireportinfo-widget">
	  <div class="panel-heading">
	    <h3 class="panel-title"><i class="fa fa-clipboard"></i>
	        <span data-i18n="munkireportinfo.status"></span>
	        <list-link data-url="/show/listing/munkireportinfo/mrinfo"></list-link>
	    </h3>
	  </div>
		<div class="panel-body text-center">
		  <a href="#munkireportinfo.error_count" tag="error" class="btn btn-danger disabled">
			  <span class="bigger-150"> 0 </span><br>
			  <span class="count"></span>
		  </a>
		  <a href="#munkireportinfo.warnings_count" tag="warning" class="btn btn-warning disabled">
			  <span class="bigger-150"> 0 </span><br>
			  <span class="count"></span>
		  </a>
		</div>
	</div>
</div><!-- /col -->

<script>

$(document).on('appReady', function(){

	var panelBody = $('#munkireportinfo-widget div.panel-body');

	// Tags
	var tags = ['error', 'warning'];

	// Set url
	$.each(tags, function(i, tag){
		var hash = $('#munkireportinfo-widget a[tag="'+tag+'"]').attr('href')
		$('#munkireportinfo-widget a[tag="'+tag+'"]')
			.attr('href', appUrl + '/show/listing/munkireportinfo/mrinfo');
	});

	$(document).on('appUpdate', function(){

		var hours = 24 * 7;
		$.getJSON( appUrl + '/module/munkireportinfo/get_stats/'+hours, function( data ) {

			$.each(tags, function(i, tag){
				// Set count
				$('#munkireportinfo-widget a[tag="'+tag+'"]')
					.toggleClass('disabled', ! data[tag])
					.find('span.bigger-150')
						.text(+data[tag]);
				// Set localized label
				$('#munkireportinfo-widget a[tag="'+tag+'"] span.count')
					.text(i18n.t(tag, { count: +data[tag] }));
			});
		});
	});
});

</script>