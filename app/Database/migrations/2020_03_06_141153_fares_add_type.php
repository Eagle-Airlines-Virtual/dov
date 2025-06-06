<?php

use App\Contracts\Migration;
use App\Models\Enums\FareType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Add a `pilot_pay` column for a fixed amount to pay to a pilot for a flight
 */
return new class() extends Migration
{
    public function up()
    {
        Schema::table('fares', function (Blueprint $table) {
            $table->unsignedTinyInteger('type')
                ->default(FareType::PASSENGER)
                ->nullable()
                ->after('capacity');
        });
    }
};
