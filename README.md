# Chapter7

## For Docker

### setup

```bash
$ docker-compose up -d
$ docker-compose exec php composer install --prefer-dist --no-interaction && composer app-setup
$ docker-compose exec php php artisan migrate
$ docker-compose exec php php artisan db:seed
$ curl -XPUT 'http://localhost:9200/reviews' -H 'Content-Type: application/json' -d @schema/mapping.json
```

#### コンテナのキャッシュが残っている場合

```bash
$ docker-compose build --no-cache
```

### Queue

```bash
$ docker-compose exec php php artisan queue:work
```

### MySQL確認方法

```bash
$ docker-compose exec mysql bash
```

dockerのmysqlコンテナ内で以下を実行します

```bash
# mysql -u sample -p secret
```
