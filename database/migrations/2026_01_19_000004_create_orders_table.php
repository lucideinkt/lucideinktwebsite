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
            // Primary key
            $table->id();

            // Foreign keys
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('shipping_cost_id')->nullable()->constrained('shipping_costs')->nullOnDelete();

            // Order totals
            $table->decimal('total', 10, 2);
            $table->decimal('total_before', 10, 2)->nullable();
            $table->decimal('total_after_discount', 10, 2)->nullable();
            $table->decimal('total_with_shipping', 10, 2)->nullable();
            $table->decimal('shipping_cost', 10, 2)->nullable();
            $table->decimal('shipping_cost_amount', 10, 2)->nullable();

            // Discount fields
            $table->string('discount_type')->nullable();
            $table->decimal('discount_value', 10, 2)->nullable();
            $table->decimal('discount_price_total', 10, 2)->nullable();
            $table->string('discount_code_checkout')->nullable();

            // Status fields
            $table->string('status')->default('pending');
            $table->string('payment_status')->nullable();
            $table->timestamp('paid_at')->nullable();

            // Payment provider (Mollie)
            $table->string('mollie_payment_id')->nullable();
            $table->text('payment_link')->nullable();

            // Shipping address
            $table->string('shipping_first_name')->nullable();
            $table->string('shipping_last_name')->nullable();
            $table->string('shipping_company')->nullable();
            $table->string('shipping_street')->nullable();
            $table->string('shipping_house_number')->nullable();
            $table->string('shipping_house_number_addition')->nullable();
            $table->string('shipping_postal_code')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('shipping_phone')->nullable();

            // MyParcel integration
            $table->string('myparcel_consignment_id')->nullable();
            $table->text('myparcel_track_trace_url')->nullable();
            $table->text('myparcel_label_link')->nullable();
            $table->string('myparcel_barcode')->nullable();
            $table->integer('myparcel_package_type_id')->nullable();
            $table->boolean('myparcel_only_recipient')->default(false);
            $table->boolean('myparcel_signature')->default(false);
            $table->integer('myparcel_insurance_amount')->nullable();
            $table->text('myparcel_delivery_json')->nullable();
            $table->boolean('myparcel_is_pickup')->default(false);
            $table->string('myparcel_carrier')->nullable();
            $table->string('myparcel_delivery_type')->nullable();

            // Documents
            $table->string('invoice_pdf_path')->nullable();

            // Email tracking
            $table->timestamp('customer_email_sent_at')->nullable();
            $table->timestamp('admin_email_sent_at')->nullable();

            // Order notes
            $table->text('order_note')->nullable();

            // Soft deletes & timestamps
            $table->softDeletes();
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

