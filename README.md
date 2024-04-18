# TODOアプリ
※現在エラーが起きているので修正中です

## 起動方法

laravel.testをコメントアウトして以下を実行
`docker compose run composer install`

composerをコメントアウトして以下を実行
`docker compose run laravel.test composer install`
`docker compose up`
`php artisan migrate:fresh --seed --seeder=TaskSeeder`
