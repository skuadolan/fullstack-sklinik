<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kunjungan', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(1)->comment('0 Batal, 1 Masuk, 2 Mutasi Rajal, 3 Ranap, 4 Mutasi Ranap, 5 Keluar/Selesai');
            $table->unsignedBigInteger('id_pendaftaran');
            $table->foreign('id_pendaftaran')->references('id')->on('pendaftaran')->onDelete('cascade');
            $table->unsignedBigInteger('id_pasien');
            $table->foreign('id_pasien')->references('id')->on('pasien')->onDelete('cascade');
            // $table->unsignedBigInteger('id_nakes');
            // $table->foreign('id_nakes')->references('id')->on('nakes')->onDelete('cascade');
            // $table->unsignedBigInteger('id_bed');
            // $table->foreign('id_bed')->references('id')->on('bed')->onDelete('cascade');
            $table->timestamp("waktu_masuk")->nullable();
            $table->timestamp("waktu_keluar")->nullable();
            $table->unsignedBigInteger('id_client');
            $table->foreign('id_client')->references('id')->on('list_clients')->onDelete('cascade');
            $table->unsignedBigInteger('id_user_created')->nullable();
            $table->foreign('id_user_created')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_user_updated')->nullable();
            $table->foreign('id_user_updated')->references('id')->on('users')->onDelete('cascade');
            $table->integer('is_deleted')->default(0)->comment("0 Tidak, 1 Ya");$table->softDeletes();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE pendaftaran ALTER COLUMN is_lunas TYPE order_status USING is_lunas::order_status");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan');
    }
};
