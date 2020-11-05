<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
  public function up()
        {
            Schema::create('products', function (Blueprint $table) 
           
            {
                $table->increments('id');
                $table->string('name');
                $table->text('description');
                $table->integer('count');
                $table->integer('price');
                
                $table->softDeletes();
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('products');
        }
    }
