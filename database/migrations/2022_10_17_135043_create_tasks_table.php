<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(Task::getTableName(), function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->dateTime('deadline');
            $table->text('description');
            $table->enum('status', array_keys(Task::$availableStatuses));

            $table->bigInteger('user_id')->unsigned();

            $table->foreign('user_id')
                ->references('id')
                ->on(User::getTableName())
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Task::getTableName());
    }
};
