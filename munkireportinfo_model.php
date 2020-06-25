<?php

use munkireport\models\MRModel as Eloquent;

class Munkireportinfo_model extends Eloquent
{
    protected $table = 'munkireportinfo';

    protected $fillable = [
      'serial_number',
      'version',
      'baseurl',
      'passphrase',
      'reportitems',
      'start_time',
      'end_time',
      'log',
      'log_warning',
      'log_error',
      'error_count',
      'warning_count',
      'upload_size',
      'log_size',
      'warning_log_size',
      'error_log_size',
    ];
}
