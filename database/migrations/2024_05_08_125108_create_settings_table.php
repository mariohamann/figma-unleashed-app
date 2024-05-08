<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('value');
            $table->string('type');
            $table->timestamps();
        });

        Setting::create([
            'name' => 'name',
            'value' => 'John Doe',
            'type' => 'STRING'
        ]);

        Setting::create([
            'name' => 'clicks',
            'value' => 0,
            'type' => 'FLOAT'
        ]);

        Setting::create([
            'name' => 'is_active',
            'value' => true,
            'type' => 'BOOLEAN'
        ]);

        Setting::create([
            'name' => 'color',
            'value' => ['r' => 255, 'g' => 0, 'b' => 0, 'a' => 1],
            'type' => 'COLOR'
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
