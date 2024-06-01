# TODO アプリ

※現在エラーが起きているので修正中です

## 起動方法

laravel.test をコメントアウトして以下を実行

```bash
docker compose run composer install
```

composer をコメントアウトして以下を実行

```bash
docker compose run laravel.test composer install
```

```bash
docker compose up
```

```bash
php artisan migrate:fresh --seed --seeder=TaskSeeder
```
