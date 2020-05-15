<h2 data-i18n="munkireportinfo.clienttabtitle"></h2>
<div id="munkireportinfo-tab"></div>

<div id="munkireportinfo-msg" data-i18n="listing.loading" class="col-lg-12 text-center"></div>

<script>
$(document).on('appReady', function(){
	$.getJSON(appUrl + '/module/munkireportinfo/get_data/' + serialNumber, function(data){
        // Check if we have data
        if(!data[0].version && data[0].version !== null && data[0].version !== 0){
            $('#munkireportinfo-msg').text(i18n.t('no_data'));
            $('#munkireportinfo-header').removeClass('hide');

        } else {

            // Hide
            $('#munkireportinfo-msg').text('');
            $('#munkireportinfo-view').removeClass('hide');

            var skipThese = ['id','serial_number'];
            $.each(data, function(i,d){

                // Generate rows from data
                var rows = ''
                for (var prop in d){
                    // Skip skipThese
                    if(skipThese.indexOf(prop) == -1){
                        // Do nothing for empty values to blank them
                        if (d[prop] == '' || d[prop] == null){
                            rows = rows

                        // Format date
                        } else if((prop == "start_time" || prop == "end_time") && d[prop] > 0){
                            var date = new Date(d[prop] * 1000);
                            rows = rows + '<tr><th>'+i18n.t('munkireportinfo.'+prop)+'</th><td><span title="'+moment(date).fromNow()+'">'+moment(date).format('llll')+'</span></td></tr>';

                        // Format version
                        } else if(prop == "version"){
                            rows = rows + '<tr><th style="min-width:180px;">'+i18n.t('munkireportinfo.'+prop)+'</th><td>'+mr.integerToVersion(d[prop])+'</td></tr>';

                        // Format log
                        } else if(prop == "log" || prop == "log_warning" || prop == "log_error"){
                            rows = rows + '<tr><th>'+i18n.t('munkireportinfo.'+prop)+'</th><td>'+d[prop].replace(/\n/g, "<br>").replace(/\\/g, "")+'</td></tr>';

                        // Else, build out rows from entries
                        } else {
                            rows = rows + '<tr><th>'+i18n.t('munkireportinfo.'+prop)+'</th><td>'+d[prop]+'</td></tr>';
                        }
                    }
                }

                $('#munkireportinfo-tab')
                    .append($('<div style="max-width:1000px;">')
                        .append($('<table>')
                            .addClass('table table-striped table-condensed')
                            .append($('<tbody>')
                                .append(rows))))
            })
        }
	});
});
</script>
