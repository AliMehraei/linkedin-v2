<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('linkedin_v2', function (Blueprint $table) {
            $table->id();
            $table->string('user_mail')->nullable();
            $table->string('client_id')->nullable();
            $table->string('client_secret')->nullable();
            $table->longText('refresh_token')->nullable();
            $table->longText('access_token')->nullable();
            $table->longText('grant_token');
            $table->string('token_type')->nullable();
            $table->string('expiry_time',20);
            $table->string('accounts_url')->nullable();
            $table->string('api_domain')->nullable();
            $table->string('redirect_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('linkedin_v2');
    }
};
