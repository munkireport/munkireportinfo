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
        // $munkireportinfo = new Munkireportinfo_model();
        // $sql = "SELECT  COUNT(1) as total,
        //                 COUNT(CASE WHEN `baseurl` LIKE 'http://%' THEN 1 END) AS http,
        //                 COUNT(CASE WHEN `baseurl` LIKE 'https://%' THEN 1 END) AS https,
        //                 COUNT(CASE WHEN `baseurl` LIKE 'file:///%' THEN 1 END) AS local
        //                 FROM munkireportinfo
        //                 LEFT JOIN reportdata USING (serial_number)
        //                 ".get_machine_group_filter();

        // jsonView($munkireportinfo->query($sql)[0]);

        jsonView(
            Munkireportinfo_model::selectRaw("COUNT(CASE WHEN baseurl  LIKE 'http://%' THEN 1 END) AS http")
            ->selectRaw("COUNT(CASE WHEN baseurl LIKE 'https://%' THEN 1 END) AS https")
            ->selectRaw("COUNT(CASE WHEN baseurl LIKE 'file://%' THEN 1 END) AS local")
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
        // $munkireportinfo = new Munkireportinfo_model();
        // $sql = "SELECT version, COUNT(1) AS count
        //             FROM munkireportinfo
        //             LEFT JOIN reportdata USING (serial_number)
        //             ".get_machine_group_filter()."
        //             GROUP BY version
        //             ORDER BY COUNT DESC";

        // jsonView($munkireportinfo->query($sql));

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
        // $timestamp = date('Y-m-d H:i:s', time() - 60 * 60 * (int) $hours);
        // $munkireportinfo = new Munkireportinfo_model();
        // $sql = "SELECT
        //             SUM(error_count > 0) as error,
        //             SUM(warning_count > 0) as warning
        //             FROM munkireportinfo
        //             LEFT JOIN reportdata USING (serial_number)
        //             ".get_machine_group_filter()."
        //             AND start_time > '".$timestamp."'";

        // jsonView($munkireportinfo->query($sql)[0]);

        $timestamp = time() - 60 * 60 * (int) (24 * 7);
       jsonView(
           Munkireportinfo_model::selectRaw('sum(error_count > 0) as error, sum(warning_count > 0) as warning')
               ->filter()
               ->where('munkireportinfo.start_time', '>', $timestamp)
               ->first()
       );
    }

    public function get_errors($max = 5)
    {
        $timestamp = time() - 60 * 60 * (int) (24 * 7);
        // $munkireportinfo = new Munkireportinfo_model();
        // $sql = "SELECT log_error, COUNT(*) as count 
        //             FROM munkireportinfo
        //             LEFT JOIN reportdata USING (serial_number)
        //             ".get_machine_group_filter()."
        //             AND error_count > 0
        //             AND start_time > '".$timestamp."'
        //             GROUP BY log_error
        //             ORDER BY count
        //             DESC LIMIT ".$max;

        // jsonView($munkireportinfo->query($sql));

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
        // $munkireportinfo = new Munkireportinfo_model();
        // $sql = "SELECT log_warning, COUNT(*) as count 
        //             FROM munkireportinfo
        //             LEFT JOIN reportdata USING (serial_number)
        //             ".get_machine_group_filter()."
        //             AND warning_count > 0
        //             AND start_time > '".$timestamp."'
        //             GROUP BY log_warning
        //             ORDER BY count
        //             DESC LIMIT ".$max;

        // jsonView($munkireportinfo->query($sql));

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
        // $munkireportinfo = new Munkireportinfo_model();
        // $sql = "SELECT version, baseurl, passphrase, start_time, end_time, upload_size, error_count, warning_count, log_warning, log_error, reportitems, log
        //             FROM munkireportinfo
        //             WHERE serial_number = '$serial_number'";

        // jsonView($munkireportinfo->query($sql));

       jsonView(
           Munkireportinfo_model::selectRaw('version, baseurl, passphrase, start_time, end_time, upload_size, error_count, warning_count, log_warning, log_error, reportitems, log')
               ->where('munkireportinfo.serial_number', $serial_number)
               ->filter()
               ->get()
               ->toArray()
       );
    }
} // END class Munkireportinfo_model
