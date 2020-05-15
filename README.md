MunkiReport reporting module
==============

Reports on the MunkiReport on the client

Table Schema
-----
* version - int - Version of MunkiReport installed
* baseurl - varchar(255) - URL of the MunkiReport instance
* passphrase - varchar(255) - Passphrase used by client
* reportitems - varchar(1024) - List of installed modules
* start_time - big int - Timestamp of when previous MunkiReport run started
* end_time - big int - Timestamp of when previous MunkiReport run ended
* log - text - Log of previous MunkiReport run
* log_warning - text - Warnings from previous MunkiReport run
* log_error - text -  Errors from previous MunkiReport run
* error_count- int - Count of errors from previous MunkiReport run
* warning_count- int - Count of warnings from previous MunkiReport run
* upload_size - varchar(255) - Size of cache files uploaded from previous MunkiReport run
