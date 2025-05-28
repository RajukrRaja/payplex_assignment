<?php

     use Illuminate\Database\Migrations\Migration;
     use Illuminate\Database\Schema\Blueprint;
     use Illuminate\Support\Facades\Schema;

     class CreatePagesTable extends Migration
     {
         public function up()
         {
             Schema::create('pages', function (Blueprint $table) {
                 $table->id();
                 $table->string('logo')->nullable();
                 $table->string('mail_id');
                 $table->string('contact');
                 $table->string('banner_image')->nullable();
                 $table->string('header');
                 $table->text('text');
                 $table->string('address');
                 $table->boolean('status')->default(true);
                 $table->timestamps();
             });
         }

         public function down()
         {
             Schema::dropIfExists('pages');
         }
     }