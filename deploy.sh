#!/bin/bash
set -e

echo "🚀 Starting deployment..."

# プロジェクトディレクトリに移動
cd /home/ec2-user/csd-test

# 最新コードを取得
echo "📥 Pulling latest code..."
git fetch origin master
git reset --hard origin/master

# メンテナンスモードを有効化（Dockerコンテナ内で実行）
docker compose exec -T app php artisan down || true

# Composerの依存関係をインストール（Dockerコンテナ内で実行）
echo "📦 Installing dependencies..."
docker compose exec -T app composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# アプリkeyが無ければ生成（初回デプロイ対策）
docker compose exec -T app sh -c 'grep -q "^APP_KEY=base64:" .env || php artisan key:generate --force'

# キャッシュとマイグレーション（Dockerコンテナ内で実行）
echo "🔧 Running migrations and clearing cache..."
docker compose exec -T app php artisan migrate --force
docker compose exec -T app php artisan config:cache
docker compose exec -T app php artisan route:cache
docker compose exec -T app php artisan view:cache

# ファイルパーミッション（Dockerコンテナ内で実行）
echo "🔒 Setting permissions..."
docker compose exec -T app chmod -R 777 storage bootstrap/cache

# メンテナンスモードを解除
docker compose exec -T app php artisan up

# コンテナを再起動（変更を反映）
echo "🔄 Restarting containers..."
docker compose restart app

echo "✅ Deployment completed successfully!"
