<?php

use CFPropertyList\CFPropertyList;
use munkireport\processors\Processor;

class Munkireportinfo_processor extends Processor
{
    public function run($data)
    {
        if (! $data) {
            throw new Exception(
                "Error Processing Request: No property list found", 1
            );
        }

        $parser = new CFPropertyList();
        $parser->parse($data, CFPropertyList::FORMAT_XML);
        $plist = $parser->toArray();

        // Convert version to int
        if (isset($plist['version'])) {
            $digits = explode('.', $plist['version']);
            $mult = 10000;
            $plist['version'] = 0;
            foreach ($digits as $digit) {
                $plist['version'] += $digit * $mult;
                $mult = $mult / 100;
            }
        }

        // Set default version value
        if(empty($plist['version'])){
            $plist['version'] = null;
        }

        $infoData = [];
        
        foreach (array('baseurl', 'passphrase', 'version', 'reportitems', 'start_time', 'end_time', 'log', 'log_warning', 'log_error', 'error_count', 'warning_count', 'upload_size', 'log_size', 'warning_log_size', 'error_log_size') as $item) {
            if (isset($plist[$item])) {
                if ($item == 'reportitems'){

                    $modulelist = array_keys($plist["reportitems"]);
                    sort($modulelist);
                    $modulelistproper = implode(", ",$modulelist);
                    $infoData[$item] = $modulelistproper;

                } else {    
                    $infoData[$item] = $plist[$item];
                }
            } else {
                $infoData[$item] = null;
            }
        }

        // Save the data. Save the lemurs!
        Munkireportinfo_model::updateOrCreate(
            ['serial_number' => $this->serial_number],
            $infoData
        );
    }
}
