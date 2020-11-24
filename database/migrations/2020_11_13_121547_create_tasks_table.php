<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('action_id')->nullable();
            $table->string('other_actions')->nullable();
            $table->foreignId('user_id')->nullable();
//            $table->boolean('completed')->default(false);
//            $table->foreignId('document_id')->nullable();
//            $table->foreignId('enduser_id')->nullable();
            // formerly particulars
            $table->text('details')->nullable();
            $table->string('remarks')->nullable();
            $table->foreignId('status_id')->default(1); // default to ongoing
            $table->datetime('completed_at')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
