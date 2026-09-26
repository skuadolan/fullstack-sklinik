<h1 align='center'>
  Welcome! #Fullstack Laravel VueJS🚀
</h1>

[![Laravel Version](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Vue Version](https://img.shields.io/badge/Vue.js-3.5-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white)](https://vuejs.org)
[![TypeScript](https://img.shields.io/badge/TypeScript-5.x-3178C6?style=for-the-badge&logo=typescript&logoColor=white)](https://www.typescriptlang.org)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)

Template boilerplate **fullstack profesional** untuk pengembangan aplikasi web modern menggunakan **Laravel 12** di sisi backend dan **Vue 3 + Inertia.js** di sisi frontend. Dirancang dengan arsitektur yang bersih, _scalable_, _type-safe_, dan siap digunakan untuk proyek skala menengah hingga enterprise.

---

## ✨ Fitur Utama

- ⚡ **Super Fast DX**: Pengembangan lokal yang cepat dengan Vite 7 dan `concurrently` untuk menjalankan server, queue, dan watcher secara bersamaan.
- 🛡️ **Type Safe**: Dukungan penuh **TypeScript** dengan konfigurasi strict mode di sisi frontend.
- 🔄 **Seamless Fullstack**: Integrasi mulus antara Laravel dan Vue menggunakan **Inertia.js** dan **Ziggy** (untuk routing).
- 🎨 **Modern UI/UX**: Siap pakai dengan **Tailwind CSS**, **Headless UI** (untuk komponen aksesibel), dan **SweetAlert2** untuk notifikasi.
- 📊 **Enterprise Ready**: Dukungan siap pakai untuk **AG Grid** (tabel data kompleks) dan **Pinia** (state management).
- 🐳 **Dockerized**: Lingkungan pengembangan yang konsisten dan terisolasi menggunakan Docker & Docker Compose.
- 🧹 **Code Quality**: Terintegrasi dengan **Prettier** dan **ESLint** untuk formatting dan linting kode yang otomatis dan konsisten.

---

## 🛠️ Tech Stack & Dependencies

Berikut adalah teknologi utama yang digunakan dalam proyek ini:

### 🧠 Backend (Laravel)

| Package                     | Versi   | Deskripsi                                                   |
| :-------------------------- | :------ | :---------------------------------------------------------- |
| `laravel/framework`         | `^12.0` | Framework PHP utama untuk backend dan API.                  |
| `inertiajs/inertia-laravel` | `^2.0`  | Adapter server-side untuk menghubungkan Laravel dengan Vue. |
| `laravel/sanctum`           | `^4.0`  | Sistem autentikasi API yang ringan dan aman.                |
| `tightenco/ziggy`           | `^2.0`  | Menggunakan named route Laravel di dalam JavaScript/Vue.    |

### 🎨 Frontend (Vue.js)

| Package                                                              | Versi               | Deskripsi                                                              |
| :------------------------------------------------------------------- | :------------------ | :--------------------------------------------------------------------- |
| `vue`                                                                | `^3.5.40`           | Framework UI progresif dengan Composition API.                         |
| `vue-router`                                                         | `^5.2.0`            | Router resmi untuk navigasi halaman (jika diperlukan di luar Inertia). |
| `pinia`                                                              | `^4.0.2`            | Store resmi Vue, intuitif dan fully typed untuk state management.      |
| `@inertiajs/vue3`                                                    | `^2.0.0`            | Adapter client-side Inertia untuk Vue 3.                               |
| `@headlessui/vue`                                                    | `^1.7.23`           | Komponen UI _unstyled_ (Dropdown, Modal, dll) yang _accessible_.       |
| `tailwindcss`                                                        | `^3.2.1` / `^4.0.0` | Utility-first CSS framework untuk styling yang cepat dan konsisten.    |
| [![Flaticon](https://www.flaticon.com/search?color=color)](Flaticon) | -                   | Utility-first CSS framework untuk styling yang cepat dan konsisten.    |

### 🧰 Build Tools & Developer Experience

| Package        | Versi      | Deskripsi                                                           |
| :------------- | :--------- | :------------------------------------------------------------------ |
| `vite`         | `^7.0.7`   | Build tool generasi baru yang sangat cepat (HMR).                   |
| `typescript`   | `^5.9.3`   | Superset JavaScript untuk _static type checking_.                   |
| `prettier`     | `^3.9.9`   | Formatter kode otomatis (mendukung Vue, TS, dan PHP).               |
| `eslint`       | `^10.11.0` | Linter untuk menjaga kualitas dan standar kode.                     |
| `concurrently` | `^9.0.1`   | Menjalankan multiple commands (Laravel + Vite) dalam satu terminal. |

### 🗄️ Database & Cache

- **Database**: MySQL (`8.0+`) atau PostgreSQL (`15+`)
- **Cache/Session**: Redis (opsional, sangat direkomendasikan untuk produksi)

---

## 📋 Prerequisites

Pastikan Anda telah menginstal perangkat lunak berikut di mesin lokal Anda:

- **PHP** `^8.4`
- **Composer** `^2.8`
- **Node.js** `^22.18.0` atau lebih baru (disarankan menggunakan [NVM](https://github.com/nvm-sh/nvm))
- **Docker & Docker Compose** (Opsional, namun sangat direkomendasikan untuk konsistensi lingkungan)

---

## 🚀 Instalasi & Setup

Ikuti langkah-langkah berikut untuk menyiapkan proyek di lingkungan lokal Anda:

### 1. Clone Repositori

```bash
git clone https://github.com/dianadi021/fullstack-laravel-vue.git
cd fullstack-laravel-vue
```

### 2. Konfigurasi Environment

Salin file .env.example menjadi .env dan sesuaikan nilainya (terutama konfigurasi database).

```bash
cp .env.example .env
```

### 3. Setup

```bash
# Backend
composer install
php artisan key:generate

# Frontend
npm install

# Used Docker
docker compose up -d --build
```

### 4. Konfigurasi Database

```bash
php artisan migrate:fresh --seed
```

### Panduan Konfigurasi `.env`

| Lingkungan                            | Nilai `DB_HOST` yang Direkomendasikan                                                          |
| :------------------------------------ | :--------------------------------------------------------------------------------------------- |
| Local (php artisan serve)             | `localhost` atau `127.0.0.1`                                                                   |
| Docker (App di Container, DB di Host) | `host.docker.internal`                                                                         |
| Docker (Full Stack di Container)      | Nama service database di `docker-compose.yml` (misal: `laravel_mysql` atau `laravel_postgres`) |

Contoh Konfigurasi MySQL:

```bash
DB_CONNECTION=mysql
DB_HOST=laravel_mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_password
DB_COLLATION=utf8mb4_unicode_ci
```

### Mode Produksi (Production)

```bash
# 1. Optimasi Frontend
npm run build

# 2. Optimasi Backend Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize:clear # Bersihkan cache lama sebelum generate yang baru
```
