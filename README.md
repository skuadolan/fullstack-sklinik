<h1 align='center'>
  Welcome! #Fullstack Laravel VueJS🚀
</h1>

<p align='center'>
<i>VueJS | Fullstack Web Developer | Laravel</i>
</p>

<div style='display: flex; gap: 1rem; flex: warp;'>
  
<div style='width: 100%;'>
<h1 align='center'>
  Requirements 🛠
</h1>

<h2 align='center'>
  Languages
</h2>

> [<img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" />![version](https://img.shields.io/badge/version-8.2.12-blue)](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.2.12/xampp-windows-x64-8.2.12-0-VS16-installer.exe/download) </br>
> [<img src="https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white" />![version](https://img.shields.io/badge/version-3.7.1-blue)](https://cdnjs.com/libraries/jquery) </br>

<h2 align='center'>
  Tools
</h2>

> [NVM](https://github.com/coreybutler/nvm-windows#readme) </br>
> [<img src="https://img.shields.io/badge/Node%20js-339933?style=for-the-badge&logo=nodedotjs&logoColor=white" />![version](https://img.shields.io/badge/version-21.7.1-blue)](https://nodejs.org/en/download/prebuilt-installer) </br>
> [<img src="https://img.shields.io/badge/Docker-2CA5E0?style=for-the-badge&logo=docker&logoColor=white" />![version](https://img.shields.io/badge/version-4.31.1-blue)](https://www.docker.com/get-started/) </br>

<h2 align='center'>
  Front End
</h2>

> [<img src="https://img.shields.io/badge/Vue%20js-35495E?style=for-the-badge&logo=vuedotjs&logoColor=4FC08D" />![version](https://img.shields.io/badge/version-3.5.22-blue)]([https://laravel.com/docs/12.x/installation](https://vuejs.org/guide/introduction.html)) </br>
> [<img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" />![version](https://img.shields.io/badge/version-3.xx-blue)](https://tailwindcss.com/docs/guides/vite#vue) </br>
> [<img src="https://img.shields.io/badge/Font_Awesome-339AF0?style=for-the-badge&logo=fontawesome&logoColor=white" />![version](https://img.shields.io/badge/version-6.5.2-blue)](https://cdnjs.com/libraries/font-awesome) </br>

<h2 align='center'>
  Back End
</h2>

> [<img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />![version](https://img.shields.io/badge/version-12.xx-blue)](https://laravel.com/docs/12.x/installation) </br>

<h2 align='center'>
  Database
</h2>

> [<img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" />![version](https://img.shields.io/badge/version-8.0.39-blue)](https://dev.mysql.com/downloads/installer/) </br>
> [<img src="https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white" />![version](https://img.shields.io/badge/version-17.2-blue)](https://www.enterprisedb.com/downloads/postgres-postgresql-downloads) </br>

<h2 align='center'>
  Library / CDN
</h2>

> [![tostr]](https://www.jsdelivr.com/package/npm/toastr) </br>
> [![Flaticon]](https://www.flaticon.com/search?color=color) </br>
> [![inertiajs]](https://inertiajs.com/server-side-setup) </br>
> [![Sweetalert]](https://sweetalert2.github.io) </br>
> [![MomentJS]](https://momentjs.com) </br>
> [![DataTables]](https://datatables.net/download/) </br>
> [![HeadlessUI]](https://headlessui.com/v1/vue) </br>
> [![AG Grid]](https://www.ag-grid.com/javascript-data-grid/getting-started/) / [![AG Grid Theme Builder]](https://www.ag-grid.com/theme-builder/) </br>
</div>

</div>

<h2 align='center'>
  Database / Table Relation
</h2>

- Untuk mengetahui relasi antar table, bisa mengakses website berikut;
> [![dbdiagram]](https://dbdiagram.io/d) </br>
- Jika sudah login menggunakan akun pribadi, bisa menggunakan code yang sudah disiapkan pada file berikut
> [![database/TableRelation.txt]](https://github.com/skuadolan/fullstack-laravel/tree/main/database/TableRelation.txt) </br>

<h2 align='center'>
    Project Worklist
</h2>

> [![notion]](https://www.notion.so/skuadproduction/Fullstack-Klinik-fd00424e9f0f4871996679934edb861a) </br>

<h2 align='center'>
    Flowchart
</h2>

- Menggunakan file `Fullstack-Laravel.drawio`
> [![diagrams]](https://app.diagrams.net) </br>

<h2 align='center'>
    Setup
</h2>

- `host.docker.internal` atau `localhost` adalah istilah untuk perangkat komputer yang sedang digunakan
- `internal docker container` adalah istilah service yang sudah terinstall pada `docker-compose.yml`

## .env
- Untuk `DB_HOST` dipastikan mau menggunakan `host.docker.internal` atau `internal docker container`

> Jika di running menggunakan php artisan serve
```bash
DB_HOST=localhost
```

> Jika di running menggunakan nginx docker, namun database menggunakan internal
```bash
DB_HOST=host.docker.internal
```

> Jika di running menggunakan full docker, disesuaikan dengan nama container database yang digunakan `docker-compose.yml`
```bash
DB_HOST=sklinik_postgres
```
```bash
DB_HOST=sklinik_mysql
```

> MySQL
```bash
DB_COLLATION=utf8mb4_general_ci # Gunakan jika di CPanel Server version: 10.6.17-MariaDB-cll-lve - MariaDB Server

DB_CONNECTION=mysql
DB_HOST=
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

> Postgres
```bash
DB_CONNECTION=pgsql
DB_HOST=
DB_PORT=5432
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

> php.ini
```bash
extension=pdo_pgsql
extension=pgsql
```

> Redis
```bash
SESSION_DRIVER=redis
SESSION_CONNECTION=default
CACHE_DRIVER=redis

REDIS_CLIENT=phpredis
REDIS_HOST=
REDIS_PORT=6379
```
> Jika di running menggunakan full docker, disesuaikan dengan nama container database yang digunakan `docker-compose.yml`
```bash
REDIS_HOST=sklinik_redis
```

## Docker
- Jangan lupa untuk merubah `ports` pada file `docker-compose.yml` untuk disesuaikan di perangkat masing - masing supaya tidak `error`
- Pastikan value `.env` sudah sama dengan konfigurasi `docker-compose.yml`
```bash
ports:
      - "3306:3306" # *Contoh customize_port:internal_docker_service_port
```
- Aktifkan `mesin docker` atau membuka `docker desktop` terlebih dahulu, dan pastikan operasi build berhasil sampai akhir
```bash
docker-compose up -d --build
```

## Redis
- Untuk `Refresh Chaching`
```bash
redis-cli FLUSHALL
```
- Jika running menggunakan `php artisan serve` maka `redis` menggunakan
```bash
REDIS_CLIENT=predis
```
- Jika running menggunakan `nginx docker` maka `redis` menggunakan
```bash
REDIS_CLIENT=phpredis
```

## Application

> Database
- Pastikan creating database terlebih dahulu, baru `setup .env`

> [![Composer]](https://getcomposer.org/download/) </br>
```bash
docker exec -it sklinik_app bash
```
```bash
composer setup_dev
```

> Update Laravel
```bash
composer update laravel/framework
```

> Laravel
```bash
php artisan key:generate
```
- Merupakan command untuk `database development`, dilarang untuk `database production`
```bash
php artisan migrate:fresh --seed
```
```bash
php artisan config:publish cors
```

> VueJS
```bash
npm i --force
```

<h2 align='center'>
    Running Application
</h2>

## Production
> Laravel
- Setting pada root document di folder `public`
- Jangan lupa untuk run prompt berikut ini;
```bash
php artisan auth:clear-resets
```
```bash
php artisan cache:clear
```
```bash
php artisan config:clear
```
```bash
php artisan event:clear
```
```bash
php artisan optimize:clear
```
```bash
php artisan queue:clear
```
```bash
php artisan route:clear
```
```bash
php artisan schedule:clear-cache
```
```bash
php artisan view:clear
```

> VueJS
```bash
npm run build
```

> Permission denied
- Jika terdapat `Permission denied` terhadap suatu direktori folder, cobalah untuk `composer install` menggunakan docker

## Development
> Laravel
```bash
php artisan serve
```

> VueJS
```bash
npm run dev
```

# cPanel
Jika setting cPanel, pastikan seluruh `.env` yang berkaitan dengan `domain` semua localhost diganti menjadi `current domain` atau `domain` yang sedang digunakan di hosting.

# IMPORTANCE!
- Jika menggunakan query, pastikan nama table tidak menggunakan huruf besar!
