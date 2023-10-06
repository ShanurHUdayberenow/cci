<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('foexhibitions', function (Blueprint $table) {
            $table->datetime('end_time')
                ->nullable()
                ->after('title_tk');

            $table->datetime('start_time')
                ->nullable()
                ->after('title_tk');
        });
    }

    public function down(): void
    {
        Schema::table('foexhibitions', function (Blueprint $table) {
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
        });
    }
};