<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class MunkireportinfoLogSizes extends Migration
{
    private $tableName = 'munkireportinfo';

    public function up()
    {
        $capsule = new Capsule();

        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->bigInteger('log_size')->nullable();
            $table->bigInteger('warning_log_size')->nullable();
            $table->bigInteger('error_log_size')->nullable();
        });
    }
    
    public function down()
    {
        $capsule = new Capsule();

        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->dropColumn('log_size');
            $table->dropColumn('warning_log_size');
            $table->dropColumn('error_log_size');
        });
    }
}
