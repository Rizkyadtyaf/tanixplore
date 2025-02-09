<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Tambahkan kolom user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Tambahkan foreign key constraint
            $table->string('name');
            $table->decimal('price', 15, 2);
            $table->integer('stock');
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->string('addres_detail')->nullable();
            $table->date('date_info')->nullable();
            $table->enum('grade', ['Grade A', 'Grade B'])->nullable();
            $table->string('image')->nullable();
            $table->string('file_upload')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus constraint foreign key terlebih dahulu
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Hapus foreign key
        });

        Schema::dropIfExists('products');
    }
};
