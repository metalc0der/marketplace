<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('key');
            $table->string('value');
            $table->foreignId('application_id')->constrained('installed_applications');
        });

        Schema::create('seteables', function (Blueprint $table) {
            $table->uuid('seteable_id');
            $table->string('seteable_type');
            $table->foreignId('setting_id')->constrained('settings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}