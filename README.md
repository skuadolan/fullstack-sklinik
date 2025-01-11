<h1 align='center'>Welcome! #Fullstack Sklinik 🚀</h1>

# Requirements
## Languages
> [<img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" />![version](https://img.shields.io/badge/version-8.2.12-blue)](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.2.12/xampp-windows-x64-8.2.12-0-VS16-installer.exe/download) </br>
> [<img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />![version](https://img.shields.io/badge/version-11.xx-blue)](https://laravel.com/docs/11.x/installation) </br>
> [<img src="https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white" />![version](https://img.shields.io/badge/version-3.7.1-blue)](https://cdnjs.com/libraries/jquery) </br>
> [<img src="https://img.shields.io/badge/Node%20js-339933?style=for-the-badge&logo=nodedotjs&logoColor=white" />![version](https://img.shields.io/badge/version-21.7.1-blue)](https://nodejs.org/en/download/prebuilt-installer) </br>

## Frontend
> [<img src="https://img.shields.io/badge/Font_Awesome-339AF0?style=for-the-badge&logo=fontawesome&logoColor=white" />![version](https://img.shields.io/badge/version-6.5.2-blue)](https://cdnjs.com/libraries/font-awesome) </br>
> [<img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" />![version](https://img.shields.io/badge/version-1.7-blue)](https://tailwindcss.com/docs/guides/vite#vue) </br>

## Database
> [<img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" />![version](https://img.shields.io/badge/version-8.0.39-blue)](https://dev.mysql.com/downloads/installer/) </br>
> [<img src="https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white" />![version](https://img.shields.io/badge/version-17.2-blue)](https://www.enterprisedb.com/downloads/postgres-postgresql-downloads) </br>

# Tools
> [![AlpineJS]](https://alpinejs.dev/essentials/installation) </br>
> [![JQuery UI]](https://jqueryui.com) </br>
> [![MomentJS]](https://momentjs.com) </br>
> [![NotyJS]](https://www.jsdelivr.com/package/npm/noty) </br>
> [![Sweetalert]](https://sweetalert2.github.io) </br>
> [![tostr]](https://www.jsdelivr.com/package/npm/toastr) </br>
> [![DataTables]](https://datatables.net/download/) </br>
> [![Flaticon]](https://www.flaticon.com/search?color=color) </br>

# Database / Table Relation
- Untuk mengetahui relasi antar table, bisa mengakses website berikut;
> [![dbdiagram]](https://dbdiagram.io/d) </br>
- Jika sudah login menggunakan akun pribadi, bisa menggunakan code yang sudah disiapkan pada file berikut
> [![database/TableRelation.txt]](https://github.com/skuadolan/fullstack-sklinik/tree/main/database/TableRelation.txt) </br>

# Project Worklist
> [![notion]](https://www.notion.so/skuadproduction/Fullstack-Klinik-fd00424e9f0f4871996679934edb861a) </br>

# Flowchart
- Menggunakan file `Fullstack-Sklinik.drawio`
> [![diagrams]](https://app.diagrams.net) </br>

# Setup
> Docker
- Jangan lupa untuk merubah `ports` pada file `docker-compose.yml` untuk disesuaikan pada di perangkat masing - masing supaya tidak `error`
- Dari
```bash
ports:
      - "3306:3306"
```
- Menjadi *contoh
```bash
ports:
      - "3307:3306"  # Mengubah port host menjadi 3307
```

> Database
- Pastikan database sudah dibuatkan/create
> .env
- Pastikan file `.env` sudah disiapkan
> Composer Installation
> [![Download]](https://getcomposer.org/download/) </br>
```bash
composer i
```
> Laravel Installation
```bash
php artisan key:generate
```
```bash
php artisan migrate:fresh --seed
```
```bash
php artisan config:publish cors
```
> TailwindCSS Installation
- Pastikan sudah installasi `pnpm`, jika belum install bisa ikuti berikut
```bash
npm i -g pnpm
```
- Lalu instal library dari nodejs
```bash
pnpm i
```
> Setup .env
- Bisa disesuaikan dengan database yang ini digunakan
```bash
DB_COLLATION=utf8mb4_general_ci # Gunakan jika di CPanel Server version: 10.6.17-MariaDB-cll-lve - MariaDB Server

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
```bash
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=
DB_USERNAME=postgres
DB_PASSWORD=
```
> Setup php.ini
```bash
extension=pdo_pgsql
extension=pgsql
```

# Running Development
> Laravel
```bash
php artisan serve
```
> TailwindCSS
```bash
pnpm dev
```

# Running Production
```bash
pnpm build
```
