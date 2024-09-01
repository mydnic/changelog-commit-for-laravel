<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('changelog', function (Blueprint $table) {
            $table->id();
            $table->string('commit_url');
            $table->text('message');
            $table->date('date');
        });
    }
};
