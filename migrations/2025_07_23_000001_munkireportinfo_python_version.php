<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class MunkireportinfoPythonVersion extends Migration
{
    private $tableName = 'munkireportinfo';

    public function up()
    {
        $capsule = new Capsule();

        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->string('python_version')->nullable();
            $table->string('python_path')->nullable();
        });
    }

    public function down()
    {
        $capsule = new Capsule();

        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->dropColumn('python_version');
            $table->dropColumn('python_path');
        });
    }
}
