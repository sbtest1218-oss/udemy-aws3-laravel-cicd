<?php

namespace Database\Seeders;

use App\Models\Milestone;
use Illuminate\Database\Seeder;

class MilestoneSeeder extends Seeder
{
    /**
     * 講座「スクラム開発（完全版）」の歩みをマイルストーンとして投入する。
     * updateOrCreate で冪等にしているため、デプロイ毎に実行しても安全。
     */
    public function run(): void
    {
        $phases = [
            [
                'phase' => '環境構築編',
                'phase_order' => 1,
                'phase_icon' => '🛠️',
                'items' => [
                    ['title' => 'Laravel開発環境セットアップ', 'subtitle' => 'Mac / Windows', 'icon' => '💻',
                        'description' => 'DockerでLaravelが動く開発環境を整え、ここからすべてが始まりました。'],
                ],
            ],
            [
                'phase' => 'TDD編 — テスト駆動開発',
                'phase_order' => 2,
                'phase_icon' => '🔴',
                'items' => [
                    ['title' => '基礎編：Red-Greenサイクル体験', 'subtitle' => 'はじめの一歩', 'icon' => '🚦',
                        'description' => '失敗するテストを書き、通す。TDDのリズムを身体で覚えました。'],
                    ['title' => '検証編：様々なアサーション', 'subtitle' => 'テストの引き出しを増やす', 'icon' => '🔍',
                        'description' => '多彩なアサーションで「正しさ」を表現する力を身につけました。'],
                    ['title' => '実践編：データベースでTodo管理', 'subtitle' => 'DBとテスト', 'icon' => '🗃️',
                        'description' => 'データベースを伴うTodo機能をテストしながら実装しました。'],
                    ['title' => '改善編：Refactorフェーズ', 'subtitle' => '安心して直す', 'icon' => '♻️',
                        'description' => 'テストに守られながらコードを磨く、リファクタリングを体験しました。'],
                    ['title' => '応用編：Todo機能開発', 'subtitle' => '総合演習', 'icon' => '🚀',
                        'description' => 'TDDでTodoアプリの機能を一から作り上げました。'],
                ],
            ],
            [
                'phase' => 'AIコーディング編',
                'phase_order' => 3,
                'phase_icon' => '🤖',
                'items' => [
                    ['title' => 'AI Coding入門：Antigravity CLI', 'subtitle' => '2026年6月以降版', 'icon' => '✨',
                        'description' => 'AIを相棒にした新しい開発スタイルに踏み出しました。'],
                    ['title' => 'Mob AI：Cyber-Dojoでチーム開発', 'subtitle' => 'みんなで一緒に', 'icon' => '👥',
                        'description' => 'チームでモブプログラミング。知恵を持ち寄って進めました。'],
                    ['title' => 'Mob AI Replit：チームでTDD練習', 'subtitle' => 'チームでTDD', 'icon' => '🧩',
                        'description' => 'Replitでチーム一丸となってTDDを磨き込みました。'],
                ],
            ],
            [
                'phase' => 'CI/CD編 — 最終章',
                'phase_order' => 4,
                'phase_icon' => '🔄',
                'items' => [
                    ['title' => '理論編：CI/CDの全体像', 'subtitle' => 'なぜ自動化するのか', 'icon' => '🧠',
                        'description' => '継続的インテグレーション／デリバリーの考え方を学びました。'],
                    ['title' => '基礎編：自動テスト実行', 'subtitle' => 'GitHub Actions', 'icon' => '🧪',
                        'description' => 'pushするたびにテストが自動で走る仕組みを作りました。'],
                    ['title' => '応用編：コード品質チェック', 'subtitle' => '静的解析・整形', 'icon' => '🛡️',
                        'description' => '品質ゲートでコードの健全性を自動的に守れるようになりました。'],
                    ['title' => '実践編：自動デプロイ', 'subtitle' => 'GitHub Actions → AWS EC2', 'icon' => '🌐', 'is_final' => true, 'completed' => false,
                        'description' => 'さあ、最後の一歩。git push すれば、このページが GitHub から AWS EC2 へ自動でデプロイされ、講座はついに完成します。その瞬間を、自分の手で迎えにいこう。'],
                ],
            ],
        ];

        foreach ($phases as $phase) {
            foreach ($phase['items'] as $i => $item) {
                Milestone::updateOrCreate(
                    ['title' => $item['title']],
                    [
                        'phase' => $phase['phase'],
                        'phase_order' => $phase['phase_order'],
                        'phase_icon' => $phase['phase_icon'],
                        'subtitle' => $item['subtitle'] ?? null,
                        'description' => $item['description'] ?? null,
                        'icon' => $item['icon'] ?? '✅',
                        'position' => $i + 1,
                        'completed' => $item['completed'] ?? true,
                        'is_final' => $item['is_final'] ?? false,
                    ]
                );
            }
        }
    }
}
