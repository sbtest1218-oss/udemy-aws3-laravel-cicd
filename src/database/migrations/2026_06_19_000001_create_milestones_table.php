<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 学びの軌跡（マイルストーン）を保存するテーブル。
     */
    public function up(): void
    {
        Schema::create('milestones', function (Blueprint $table) {
            $table->id();
            $table->string('phase');            // 章のグループ（例: TDD編）
            $table->unsignedInteger('phase_order');
            $table->string('phase_icon')->default('📘');
            $table->string('title');            // 章タイトル
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('icon')->default('✅');
            $table->unsignedInteger('position')->default(0); // 章内の並び順
            $table->boolean('completed')->default(true);
            $table->boolean('is_final')->default(false);     // 最終章フラグ（CI/CD 自動デプロイ）
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('milestones');
    }
};
