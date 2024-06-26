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
        Schema::create('pfes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idBinom');
            $table->tinyInteger('canSend')->default(0);
            $table->unsignedBigInteger('idEns')->nullable();
            $table->unsignedBigInteger('jury1')->nullable();
            $table->unsignedBigInteger('jury2')->nullable();
            $table->string('title');
            $table->integer('need_suivis')->default(0);
            $table->enum('level',['l3','m2']);
            $table->enum('type',['interne','externe'])->default('interne');
            $table->enum('status',['valide','termine','revu','pasencore','rejeter'])->default('pasencore');
            $table->enum('branch',['isil','acad','gtr']);
            $table->text('description');
            $table->string('file');
            $table->integer('year');
            $table->double('note');
            $table->foreign('idBinom')->references('id')->on('binoms');
            $table->foreign('jury1')->references('id')->on('profs');
            $table->foreign('jury2')->references('id')->on('profs');
            $table->foreign('idEns')->references('id')->on('profs');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pfes');
    }
};

