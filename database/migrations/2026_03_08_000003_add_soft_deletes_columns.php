<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('applicants', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Prevent duplicate visit records for the same company/applicant pair.
        Schema::table('company_visits', function (Blueprint $table) {
            $table->unique(['company_id', 'applicant_id']);
        });
    }

    public function down(): void
    {
        Schema::table('company_visits', function (Blueprint $table) {
            $table->dropUnique(['company_id', 'applicant_id']);
        });

        Schema::table('applicants', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
