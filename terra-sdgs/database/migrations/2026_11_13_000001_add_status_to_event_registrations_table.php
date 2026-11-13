<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('event_registrations', 'status')) {
            Schema::table('event_registrations', function (Blueprint $table) {
                $table->string('status')->default('Terverifikasi')->after('interest');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('event_registrations', 'status')) {
            Schema::table('event_registrations', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};
