<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('event_date');
            $table->string('location');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', ['active', 'inactive', 'completed'])->default('inactive');
            $table->timestamps();
        });

        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->string('contact_email');
            $table->string('contact_phone')->nullable();
            $table->string('booth_number')->nullable();
            $table->timestamps();
        });

        Schema::create('time_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('capacity');
            $table->integer('registered_count')->default(0);
            $table->timestamps();
        });

        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('time_slot_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('education');
            $table->text('experience')->nullable();
            $table->text('skills')->nullable();
            $table->string('qr_code')->unique();
            $table->enum('status', ['registered', 'checked_in', 'shortlisted', 'rejected'])->default('registered');
            $table->timestamps();
        });

        Schema::create('company_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('applicant_id')->constrained()->onDelete('cascade');
            $table->text('notes')->nullable();
            $table->enum('status', ['viewed', 'shortlisted', 'rejected'])->default('viewed');
            $table->timestamp('visited_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_visits');
        Schema::dropIfExists('applicants');
        Schema::dropIfExists('time_slots');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('events');
    }
};
