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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('grand_total');
            $table->unsignedInteger('order_price');
            $table->unsignedInteger('shipping_price');
            $table->enum('shipping_method', ['KURIR TOKO'])->default('KURIR TOKO');
            $table->unsignedInteger('discount')->default(0);
            $table->unsignedInteger('voucher_id')->nullable();
            $table->string('awb_number', 50)->nullable();
            $table->string('address', 255);
            $table->string('city', 50);
            $table->string('district', 50);
            $table->string('phone', 20);
            $table->string('full_name', 100);
            $table->enum('status', ['PENDING', 'PROCESSING', 'SHIPPING', 'FINISHED'])->default('PENDING');
            $table->enum('payment_status', ['1', '2', '3', '4'])->default('1')->comment('1=menunggu pembayaran, 2=sudah dibayar, 3=kadaluarsa, 4=batal');
            $table->string('snap_token', 36)->nullable();
            $table->string('payment_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
