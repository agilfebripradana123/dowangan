# Dowangan

> Aplikasi web untuk pengelolaan data dan konten berbasis Laravel dengan sistem autentikasi dan manajemen akses pengguna.

## 📌 Tentang Aplikasi

**Dowangan** adalah aplikasi web yang menyediakan sistem pengelolaan data, konten, pengguna, dan profil melalui dashboard administrasi.

Aplikasi ini memiliki sistem autentikasi serta pembatasan akses berdasarkan role pengguna. Struktur aplikasi dipisahkan menggunakan controller, model, middleware, request validation, Blade view, migration, dan seeder sehingga lebih mudah dikembangkan dan dipelihara.

Project ini juga menyediakan fitur export data dan memiliki halaman publik serta dashboard admin.

---

## ✨ Fitur

### 🔐 Authentication

* Login pengguna
* Registration
* Email verification
* Password reset
* Password confirmation
* Update password
* Session authentication

### 👤 User Management

* Manajemen pengguna
* Role-based access
* Admin authentication
* Update profile
* Pengelolaan informasi pengguna

### 📊 Data Management

* Menampilkan data
* Menambahkan data
* Mengubah data
* Menghapus data
* Export data

### 📝 Content Management

* Menampilkan daftar konten
* Membuat konten
* Mengedit konten
* Mengelola konten melalui dashboard
* Pengelolaan konten pemuda

### 📈 Dashboard

* Dashboard administrator
* Ringkasan data
* Navigasi berdasarkan hak akses pengguna

### 🛡️ Access Control

Aplikasi menggunakan middleware untuk mengatur akses pengguna, termasuk:

* `AdminAuth`
* `AdminMiddleware`
* `RoleMiddleware`

---

## 🛠️ Tech Stack

### Backend

* PHP
* Laravel
* Blade Template Engine

### Frontend

* HTML
* CSS
* JavaScript
* Bootstrap
* SCSS
* jQuery
* Font Awesome

### Database

* SQLite / Database sesuai konfigurasi environment

### Development Tools

* Composer
* NPM
* Vite
* PHPUnit
* Git

Project menggunakan Blade views dan memiliki konfigurasi frontend melalui `vite.config.js`, `postcss.config.js`, serta `tailwind.config.js`.

---

## 📂 Project Structure

```text
dowangan/
│
├── app/
│   ├── Exports/
│   │   └── DataExport.php
│   │
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   ├── AuthController.php
│   │   │   ├── ContentController.php
│   │   │   ├── DataController.php
│   │   │   ├── ProfileController.php
│   │   │   └── UserController.php
│   │   │
│   │   ├── Middleware/
│   │   │   ├── AdminAuth.php
│   │   │   ├── AdminMiddleware.php
│   │   │   └── RoleMiddleware.php
│   │   │
│   │   └── Requests/
│   │       ├── Auth/
│   │       │   └── LoginRequest.php
│   │       └── ProfileUpdateRequest.php
│   │
│   ├── Models/
│   │   ├── Content.php
│   │   ├── Data.php
│   │   └── User.php
│   │
│   └── View/
│       └── Components/
│
├── bootstrap/
│
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── database.php
│   ├── mail.php
│   └── session.php
│
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
│
├── public/
│   ├── images/
│   ├── template/
│   └── index.php
│
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│       ├── admin/
│       ├── auth/
│       ├── components/
│       ├── layout/
│       ├── profile/
│       └── user/
│
├── routes/
│   ├── auth.php
│   ├── console.php
│   └── web.php
│
├── storage/
│
├── tests/
│   ├── Feature/
│   └── Unit/
│
├── composer.json
├── package.json
├── vite.config.js
├── phpunit.xml
└── README.md
```

Struktur utama tersebut berasal dari project yang memiliki controller untuk admin, authentication, content, data, profile, dan user, serta model `Content`, `Data`, dan `User`.

---

## ⚙️ Requirements

Pastikan environment sudah memiliki:

* PHP
* Composer
* Node.js & NPM
* Database
* Git

Versi spesifik PHP, Node.js, dan database mengikuti konfigurasi `composer.json`, `package.json`, dan environment project.

---

## 🚀 Installation

### 1. Clone Repository

```bash
git clone <repository-url>
```

Masuk ke folder project:

```bash
cd dowangan
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Frontend Dependencies

```bash
npm install
```

### 4. Setup Environment

Copy file environment:

```bash
cp .env.example .env
```

Untuk Windows:

```powershell
copy .env.example .env
```

Kemudian sesuaikan konfigurasi database pada `.env`.

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Setup Database

Jalankan migration:

```bash
php artisan migrate
```

Jika project menggunakan data awal dari seeder:

```bash
php artisan db:seed
```

Atau:

```bash
php artisan migrate --seed
```

Project memiliki migration untuk users, cache, jobs, data, contents, role, dan username, serta menyediakan beberapa database seeder termasuk `AdminUserSeeder` dan `UserSeeder`.

### 7. Build Frontend

Untuk development:

```bash
npm run dev
```

Untuk production:

```bash
npm run build
```

### 8. Jalankan Laravel

```bash
php artisan serve
```

Aplikasi dapat diakses melalui:

```text
http://127.0.0.1:8000
```

---

## 🧪 Testing

Project menyediakan Feature Test dan Unit Test, termasuk test untuk authentication, email verification, password confirmation, password reset, password update, registration, dan profile.

Jalankan test dengan:

```bash
php artisan test
```

---

## 🔑 Authentication & Authorization

Aplikasi menerapkan authentication dan role-based authorization.

Struktur middleware:

```text
AdminAuth
AdminMiddleware
RoleMiddleware
```

Dengan pendekatan tersebut, akses halaman atau fitur tertentu dapat dibatasi berdasarkan status autentikasi dan role pengguna.

---

## 🗄️ Database

Database dikelola menggunakan Laravel Migration.

Migration utama meliputi:

```text
users
cache
jobs
data
contents
roles
username
```

Seeder tersedia untuk membuat data awal pengguna dan administrator.

---

## 📤 Data Export

Aplikasi memiliki class:

```text
app/Exports/DataExport.php
```

yang digunakan sebagai bagian dari mekanisme export data.

---

## 🎨 Interface

Dashboard menggunakan template berbasis Bootstrap dengan dukungan:

* Bootstrap
* SCSS
* jQuery
* DataTables
* Chart.js
* Font Awesome

Asset template tersedia di:

```text
public/template/
```

dan mencakup komponen CSS, JavaScript, DataTables, Chart.js, Bootstrap, serta Font Awesome.

---

## 🧭 Application Modules

Secara umum aplikasi terbagi menjadi beberapa modul:

```text
Authentication
      │
      ├── Login
      ├── Registration
      ├── Password Management
      └── Email Verification
      │
      ▼
Dashboard
      │
      ├── Data Management
      ├── Content Management
      ├── User Management
      ├── Profile
      └── Data Export
```

---

## 🔮 Development

Project dapat dikembangkan lebih lanjut dengan menambahkan:

* Modul baru melalui Controller dan Model
* Middleware untuk kebutuhan authorization
* Form Request untuk validasi
* Blade Component untuk UI yang reusable
* Migration dan Seeder untuk kebutuhan database
* Feature Test dan Unit Test untuk menjaga kualitas aplikasi

---

## 📄 License

This project is for educational and development purposes.

