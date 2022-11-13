<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->after('name')->comment('用户名');
            $table->tinyInteger('gender')->default(0)->after('email_verified_at')->comment('性别');
            $table->date('birthday')->nullable()->after('gender')->comment('生日');
            $table->string('introduction')->nullable()->after('password')->comment('个人简介');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'gender', 'birthday', 'avatar', 'introduction']);
        });
    }
};
