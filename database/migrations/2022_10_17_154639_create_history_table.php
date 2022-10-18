<?php

use App\Models\TaskHistory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(TaskHistory::getTableName(), function (Blueprint $table) {
            $table->id();

            $table->bigInteger('task_id')->unsigned()->index();

            $table->string('type');

            $table->longText('task_data')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(TaskHistory::getTableName());
    }
};
