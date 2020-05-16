<div class="col-lg-4 col-md-6">
	<div class="panel panel-default" id="munkireportinfo-protocol-widget">
	  <div class="panel-heading" data-container="body">
	    <h3 class="panel-title"><i class="fa fa-plug"></i>
	        <span data-i18n="munkireportinfo.protocol"></span>
	        <list-link data-url="/show/listing/munkireportinfo/mrinfo"></list-link>
	    </h3>
	  </div>
	  <div class="panel-body text-center">
        <a tag="http" class="btn btn-danger">
            <span class="bigger-150"> 0 </span><br>
            <span data-i18n="munkireportinfo.http"></span>
        </a>
        <a tag="https" class="btn btn-success">
            <span class="bigger-150"> 0 </span><br>
            <span data-i18n="munkireportinfo.https"></span>
        </a>
        <a tag="local" class="btn btn-info">
            <span class="bigger-150"> 0 </span><br>
            <span data-i18n="munkireportinfo.local"></span>
        </a>
	  </div>
	</div><!-- /panel -->
</div><!-- /col -->

<script>
$(document).on('appReady', function(){

	var panelBody = $('#munkireportinfo-protocol-widget div.panel-body');

	// Tags
	var tags = ['http', 'https', 'local'];

	// Set url
	$.each(tags, function(i, tag){
		$('#munkireportinfo-protocol-widget a[tag="'+tag+'"]')
			.attr('href', appUrl + '/show/listing/munkireportinfo/mrinfo/#'+tag);
	});

	$(document).on('appUpdate', function(){

		$.getJSON( appUrl + '/module/munkireportinfo/get_protocol_stats', function( data ) {

			$.each(tags, function(i, tag){
				// Set count
				$('#munkireportinfo-protocol-widget a[tag="'+tag+'"]')
					.toggleClass('hidden',  data[tag] == 0)
					.find('span.bigger-150')
						.text(+data[tag]);
				// Set localized label
				$('#munkireportinfo-protocol-widget a[tag="'+tag+'"] span.count')
					.text(i18n.t(tag, { count: +data[tag] }));
			});
		});
	});
});

</script>