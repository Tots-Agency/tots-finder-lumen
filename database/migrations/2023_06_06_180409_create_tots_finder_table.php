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
        Schema::create('tots_finder', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_id');
            $table->string('title', 250)->nullable(false);
            $table->string('slug', 250)->nullable(false);
            $table->unsignedBigInteger('parent_id')->nullable(true);
            $table->tinyInteger('type')->nullable(false)->default(0)->comments('0 = File, 1 = Folder, 2 = Link');
            $table->tinyInteger('status')->nullable(false)->default(0);
            $table->text('url')->nullable(true);
            $table->bigInteger('size')->nullable(true);
            $table->json('data')->nullable(true);
            $table->timestamps();
            $table->tinyInt('deleted')->nullable(false)->index()->default(0);

            $table->foreign('creator_id')->references('id')->on('tots_user');
            $table->foreign('parent_id')->references('id')->on('tots_finder');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tots_finder');
    }
};
