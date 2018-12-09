<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_table', function (Blueprint $table) {
            $table->engine    = 'InnoDB';
            $table->charset   = 'utf8';
            $table->collation = 'utf8_unicode_ci';

        // COLUMNS____________________________________________

        /*id*/                      $table->increments('id');
        /*name*/                    $table->string('name', 64);
        /*owner*/                   $table->string('owner', 20);
        /*type*/                    $table->enum('type', ['simple', 'markup', 'img', 'simple_img', 'markup_img']) ->default('simple');
        /*text*/                    $table->text('text')                                                          ->nullable();
        /*image_name*/              $table->string('image_name', 60)                                              ->nullable();
        /*scaling*/                 $table->decimal('scaling', 4, 2)                                              ->nullable();
        /*bg_type*/                 $table->enum('bg_type', ['normal', 'custom_image'])                           ->default('normal');
        /*bg_image_name*/           $table->string('bg_image_name', 32)                                           ->nullable();
        /*starts_at*/               $table->timestamp('starts_at');
        /*finishes_at*/             $table->timestamp('finishes_at');
        /*created_at & updated_at*/ $table->timestamps();
        /*priority*/                $table->enum('priority', ['EXCEPTIONAL', 'high', 'medium', 'low'])            ->default('medium');
        /*enabled*/                 $table->boolean('enabled')                                                    ->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads_tables');
    }
}
