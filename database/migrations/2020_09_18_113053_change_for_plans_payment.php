<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeForPlansPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'users', function (Blueprint $table){
            $table->string('payment_subscription_id', 100)->nullable()->after('plan_expire_date');
            $table->smallInteger('is_trial_done')->default(0)->after('payment_subscription_id');
            $table->smallInteger('is_plan_purchased')->default(0)->after('is_trial_done');
            $table->smallInteger('interested_plan_id')->default(0)->after('is_plan_purchased');
            $table->smallInteger('is_register_trial')->default(0)->after('interested_plan_id');
        });

        Schema::table( 'plans', function (Blueprint $table){
            $table->renameColumn('price', 'monthly_price');
        });

        Schema::table( 'plans', function (Blueprint $table){
            $table->float('monthly_price', 25, 2)->default('0.00')->nullable()->change();
            $table->float('annual_price', 25, 2)->default('0.00')->nullable()->after('monthly_price');
            $table->smallInteger('status')->default(0)->after('annual_price');
            $table->Integer('trial_days')->default(0)->after('status');
            $table->dropColumn('duration');
        });

        Schema::table( 'orders', function (Blueprint $table){
            $table->string('subscription_id', 100)->nullable()->after('order_id');
            $table->string('payer_id', 100)->nullable()->after('txn_id');
            $table->string('payment_frequency', 100)->nullable()->after('payer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
