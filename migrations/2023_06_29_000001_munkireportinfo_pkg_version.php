<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class MunkireportinfoPkgVersion extends Migration
{
    private $tableName = 'munkireportinfo';

    public function up()
    {
        $capsule = new Capsule();

        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->string('packageversion')->nullable();
            $table->bigInteger('installdate')->nullable();
            $table->string('packagefilename')->nullable();
        });
    }
    
    public function down()
    {
        $capsule = new Capsule();

        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->dropColumn('packageversion');
            $table->dropColumn('installdate');
            $table->dropColumn('packagefilename');
        });
    }
}
