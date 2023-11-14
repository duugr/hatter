<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('tags', function (Blueprint $table) {
			$table->id();
			$table->string('name')->nullable(false)->default('')->comment('名称');
			$table->dateTime('created_at')->nullable()->useCurrent();
			$table->dateTime('updated_at')->nullable()->useCurrentOnUpdate();
			$table->dateTime('deleted_at')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('tags');
	}
};
