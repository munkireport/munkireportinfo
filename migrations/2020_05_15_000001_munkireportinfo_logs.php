<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class MunkireportinfoLogs extends Migration
{
    private $tableName = 'munkireportinfo';

    public function up()
    {
        $capsule = new Capsule();
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->bigInteger('start_time')->nullable();
            $table->bigInteger('end_time')->nullable();
            $table->text('log')->nullable();
            $table->text('log_warning')->nullable();
            $table->text('log_error')->nullable();
            $table->integer('error_count')->nullable();
            $table->integer('warning_count')->nullable();
            $table->string('upload_size')->nullable();

            $table->index('start_time');
            $table->index('end_time');
            $table->index('upload_size');
        });
     }
    
    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
            $table->dropColumn('log');
            $table->dropColumn('log_warning');
            $table->dropColumn('log_error');
            $table->dropColumn('upload_size');
        });
    }
}