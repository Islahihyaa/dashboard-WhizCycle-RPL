<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('SchedulePickup', function (Blueprint $table) {
            $table->id('Schedule_id');
            $table->integer('Customer_id')->default(1);
            $table->string('Category_trash_id');
            $table->string('driver_id');
            $table->integer('pickup_date');
            $table->string('pickup_time');
            $table->float('total_daur_ulang')->default(0);
            $table->integer('total_points')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ShedulePickUp');
    }
};
