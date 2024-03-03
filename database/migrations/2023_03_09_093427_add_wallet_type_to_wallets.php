<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\{  
    User,
    Wallet
};

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->enum('wallet_type',['currency', 'crypto'])->default('currency');
        });

        $users = User::all();


        if (!$users->isEmpty() ) {
            foreach ($users as $key => $user) {
                $wallet = Wallet::where(['user_id' => $user->id, 'wallet_type' => 'crypto'])->get();
                if ($wallet->isEmpty()) {
                    Wallet::create([
                        'user_id' => $user->id,
                        'currency_id' => 1,
                        'wallet_type' => 'crypto',
                        'balance' => 0,
                        'is_active' => 0
                    ]);
                }
            }
        }
        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        

        $users = User::all();
        if (!$users->isEmpty() ) {
            foreach ($users as $key => $user) {
                $wallet = Wallet::where(['user_id' => $user->id, 'wallet_type' => 'crypto'])->delete();                
            }
        }

        Schema::table('wallets', function (Blueprint $table) {
            $table->dropColumn('wallet_type');
        });
    }
};
