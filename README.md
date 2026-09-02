# Website Desa Dowangan

## 📌 Tentang

**Website Desa Dowangan** adalah website Desa Dowangan, Kapanewon Gamping, Kabupaten Sleman, yang dikembangkan sebagai bagian dari **program Kuliah Kerja Nyata (KKN)**.

Website ini dibuat untuk membantu penyampaian informasi desa serta pengelolaan data, konten, pengguna, dan administrasi melalui dashboard.

> ⚠️ **Status Website:** Domain website saat ini sudah **tidak aktif** karena masa domain tidak diperpanjang oleh pihak desa. Project dan source code tetap tersedia sebagai dokumentasi hasil pengembangan.

---

## ✨ Fitur

* 🔐 Authentication & authorization
* 👤 Manajemen pengguna dan role
* 📊 Manajemen data
* 📝 Manajemen konten
* 📈 Dashboard administrator
* 👤 Manajemen profil
* 📤 Export data
* 🛡️ Role-based access control

---

## 🛠️ Tech Stack

* **Backend:** PHP, Laravel
* **Frontend:** Blade, HTML, CSS, JavaScript, Bootstrap, jQuery
* **Database:** SQLite / database sesuai konfigurasi
* **Tools:** Composer, NPM, Vite, PHPUnit, Git

---

## 📂 Struktur Project

```text
dowangan/
├── app/
│   ├── Exports/
│   ├── Http/
│   │   ├── Controllers/
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/
│   └── View/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── images/
│   └── template/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
├── tests/
├── composer.json
├── package.json
├── vite.config.js
└── README.md
```

---

## ⚙️ Requirements

* PHP
* Composer
* Node.js & NPM
* Database
* Git

---

## 🚀 Installation

```bash
git clone <repository-url>
cd dowangan

composer install
npm install

copy .env.example .env
php artisan key:generate

php artisan migrate --seed

npm run dev
```

Jalankan Laravel pada terminal lain:

```bash
php artisan serve
```

Kemudian akses:

```text
http://127.0.0.1:8000
```

---

## 🧪 Testing

```bash
php artisan test
```

---

## 📄 License

Project ini dikembangkan sebagai bagian dari **program KKN** dan digunakan untuk keperluan edukasi serta pengembangan website Desa Dowangan.
