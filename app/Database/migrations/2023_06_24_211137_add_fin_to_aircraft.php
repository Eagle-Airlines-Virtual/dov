<?php

use App\Contracts\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up()
    {
        Schema::table('aircraft', function (Blueprint $table) {
            $table->string('fin', 5)->unique()->nullable()->after('registration');
        });
    }
};
