<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Como Executar o Projeto Localmente 🛠️
1. Clone este repositório:
   
```bash
   git clone https://github.com/piedro404/toDo-list-laravel-react.git
```

```bash
   cd toDo-list-laravel-react/
```

2. SO Linux (Obrigatorio)

```bash
   sudo chmod -R 777 storage
```
   
3. Env

```bash
    cp .env.example .env
```

4. Docker

```bash
    docker-compose up -d
```

##### Dentro do Docker

```bash
    docker-compose exec --user root app bash
```

```bash
    composer install
    php artisan key:generate
```

##### Ou

```bash
    docker-compose exec --user root app composer install
    docker-compose exec --user root app php artisan key:generate
```





