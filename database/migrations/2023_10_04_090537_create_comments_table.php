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
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable()->index('parent_id');
            $table->string('user_name')->index('user_name');
            $table->string('email')->index('email');
            $table->string('home_page')->nullable();
            $table->text('text');
            $table->longText('extra')->nullable();
            $table->unsignedSmallInteger('level')->default(1);
            $table->timestamp('created_at')->index('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
