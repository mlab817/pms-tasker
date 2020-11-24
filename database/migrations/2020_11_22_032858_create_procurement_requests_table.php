<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcurementRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurement_requests', function (Blueprint $table) {
	        $table->id();
	        $table->string('number');
	        $table->string('details');
	        $table->decimal('abc', 30,2)->default(0);
	        $table->foreignId('enduser_id')->nullable()->constrained()->onDelete('set null');
	        $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
	        $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
	        $table->foreignId('deleted_by')->nullable()->constrained('users')->onDelete('set null');
	        $table->timestamps();
	        $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procurement_requests');
    }
}
