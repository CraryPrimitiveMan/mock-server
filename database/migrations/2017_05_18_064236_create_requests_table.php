<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $methods = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS', 'ANY'];
        $contentTypes = [
            'application/json',
            'application/x-www-form-urlencoded',
            'application/xhtml+xml',
            'application/xml',
            'multipart/form-data',
            'text/css',
            'text/csv',
            'text/html',
            'text/json',
            'text/plain',
            'text/xml'
        ];
        $charsets = ['UTF-8', 'ISO-8859-1', 'UTF-16'];
        $httpScheme = ['http', 'https'];
        Schema::create('mock_responses', function (Blueprint $table) use ($methods, $contentTypes, $charsets, $httpScheme) {
            $table->increments('id');
            $table->integer('user_id');
            $table->enum('scheme', $httpScheme)->default('http');
            $table->string('domain', 127);
            $table->string('path', 127);
            $table->enum('request_method', $methods);
            $table->string('request_uri');
            $table->integer('response_code');
            $table->enum('response_content_type', $contentTypes);
            $table->enum('response_charset', $charsets);
            $table->string('response_headers');
            $table->text('response_body');
            $table->enum('enable', ['Y', 'N'])->default('Y');
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
        Schema::dropIfExists('mock_responses');
    }
}
