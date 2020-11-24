<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcurementRequestTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurement_request_task', function (Blueprint $table) {
            $table->foreignId('procurement_request_id')->constrained()->onDelete('cascade');
	        $table->foreignId('task_id')->constrained()->onDelete('cascade');
	        $table->foreignId('status_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procurement_request_task');
    }
}
