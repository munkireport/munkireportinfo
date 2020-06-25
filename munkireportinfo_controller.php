<?php 

/**
 * Munkireportinfo module class
 *
 * @package munkireport
 * @author tuxudo
 **/
class Munkireportinfo_controller extends Module_controller
{
    /**
     * Default method
     *
     * @author tuxudo
     **/
    public function index()
    {
        echo "You've loaded the munkireportinfo module!";
    }

    /*** Protect methods with auth! ****/
    public function __construct()
    {
        // Store module path
        $this->module_path = dirname(__FILE__);
    }
    
    /**
     * Get MunkiReport Protocol Statistics
     *
     * @author erikng, tweaked by tuxudo
     **/
    public function get_protocol_stats()
    {
        jsonView(
            Munkireportinfo_model::selectRaw("COUNT(CASE WHEN baseurl  LIKE 'http://%' THEN 1 END) AS http")
            ->selectRaw("COUNT(CASE WHEN baseurl LIKE 'https://%' THEN 1 END) AS https")
            ->filter()
            ->first()
            ->toLabelCount()
        );
    }

    /**
     * Get munki versions
     * Taken from munkireport controller
     *
     **/
    public function get_versions()
    {
       jsonView(
           Munkireportinfo_model::selectRaw('version, count(*) AS count')
             ->filter()
             ->groupBy('version')
             ->orderBy('count', 'desc')
             ->get()
             ->toArray()
       );
    }
    
    /**
     * Get statistics
     * Taken from munkireport controller  
     *
     * @param integer $hours Number of hours to get stats from
     **/
    public function get_stats($hours = 24)
    {
       $timestamp = time() - 60 * 60 * (int) (24 * 7);
       jsonView(
           Munkireportinfo_model::selectRaw('sum(error_count > 0) as error, sum(warning_count > 0) as warning')
               ->filter()
               ->where('munkireportinfo.start_time', '>', $timestamp)
               ->first()
               ->toLabelcount()
       );
    }

    public function get_errors($max = 5)
    {
       $timestamp = time() - 60 * 60 * (int) (24 * 7);
       jsonView(
           Munkireportinfo_model::selectRaw('log_error, COUNT(*) as count')
             ->where('error_count', '>', 0)
             ->where('start_time', '>', $timestamp)
             ->filter()
             ->groupBy('log_error')
             ->orderBy('count', 'desc')
             ->limit($max)
             ->get()
             ->toArray()
       );
    }

    public function get_warnings($max = 5)
    {
       $timestamp = time() - 60 * 60 * (int) (24 * 7);

       jsonView(
             Munkireportinfo_model::selectRaw('log_warning, COUNT(*) as count')
               ->where('warning_count', '>', 0)
               ->where('start_time', '>', $timestamp)
               ->filter()
               ->groupBy('log_warning')
               ->orderBy('count', 'desc')
               ->limit($max)
               ->get()
               ->toArray()
         );
    }

    /**
     * Retrieve data in json format
     *
     **/
    public function get_data($serial_number)
    {
       jsonView(
           Munkireportinfo_model::selectRaw('version, baseurl, passphrase, start_time, end_time, upload_size, error_count, warning_count, log_warning, log_error, reportitems, log, log_size, warning_log_size, error_log_size')
               ->where('munkireportinfo.serial_number', $serial_number)
               ->filter()
               ->get()
               ->toArray()
       );
    }
} // END class Munkireportinfo_model
