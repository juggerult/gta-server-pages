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
        Schema::create('players', function (Blueprint $table) {
            $table->id();

            $table->string('nickname')->unique();
            $table->integer('server');
            $table->integer('level')->default(1);
            $table->integer('experience')->default(0);
            $table->string('gender');
            $table->string('promocode')->default(null);

            $table->integer('balance_money')->default(1000);
            $table->integer('balance_bank')->default(0);
            $table->boolean('active_vip')->default(false);
            $table->timestamp('time_active_vip');


            $table->boolean('active_warns')->default(false);
            $table->timestamp('time_active_warn');
            $table->boolean('active_bans')->default(false);
            $table->timestamp('time_active_ban');

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
