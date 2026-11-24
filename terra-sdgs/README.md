# Terra SDGs

Website Laravel untuk kegiatan lingkungan Terra SDGs. Repository ini berisi **source code aplikasi saja**; dokumen PRD, ERD, dan laporan disimpan di luar repository ini.

## Fitur

- Landing page publik, About Us, Event, dan Article.
- Pendaftaran relawan untuk event.
- Portal user dengan login dan profile.
- Portal admin terpisah dengan login wajib.
- Role-based access: akun `admin` dan `user` tidak dapat saling mengakses portal.
- Manajemen event, peserta, artikel, pengguna/admin, dan log aktivitas.
- Data event dan pendaftaran peserta tersimpan di database SQLite.
- Token desain, konten, dan mapping aset dipisahkan di `resources/data/`.

## Teknologi

- PHP 8.3+
- Laravel 13
- SQLite (default lokal)
- Vite, Tailwind CSS, Lucide, Motion
- Blade templates

## Menjalankan Setelah Clone

```bash
git clone https://github.com/piil09/terra-sdgs.git
cd terra-sdgs/terra-sdgs

composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run build
php artisan storage:link
php artisan serve --host=127.0.0.1 --port=8000
```

Buka `http://127.0.0.1:8000`.

> Jangan commit `.env`, kredensial, folder `vendor/`, `node_modules/`, atau hasil runtime. `.env.example` adalah template konfigurasi yang aman untuk dibagikan.

## Akun Seed Lokal

Seeder membuat akun development untuk pengujian lokal:

- Admin: `admin@terra-sdgs.id` / `admin123`
- User: `user@terra-sdgs.id` / `user123`

Ganti kredensial tersebut sebelum digunakan di lingkungan produksi.

## URL Utama

| URL | Keterangan |
|---|---|
| `/` | Landing page publik |
| `/about` | About Us |
| `/events` | Daftar event |
| `/events/register` | Form pendaftaran event |
| `/articles` | Daftar artikel |
| `/login` | Login user |
| `/profile` | Profile user setelah login |
| `/admin/login` | Login admin |
| `/admin` | Dashboard admin setelah login |
| `/admin/events` | Manajemen event |
| `/admin/participants` | Data peserta live |
| `/admin/articles` | Manajemen artikel |
| `/admin/users` | Manajemen pengguna/admin |
| `/admin/logs` | Log aktivitas |

## Struktur Repository

```text
terra-sdgs/
├── app/
│   ├── Http/Controllers/     # Logika request publik dan admin
│   ├── Http/Middleware/      # AdminOnly dan UserOnly
│   ├── Models/               # User, Event, EventRegistration
│   └── Services/             # SiteDataService
├── database/
│   ├── migrations/           # Struktur tabel database
│   ├── seeders/              # Data awal development
│   └── database.sqlite       # Database lokal development
├── public/                   # Entry point dan aset publik
├── resources/
│   ├── data/                 # tokens, content, assets JSON
│   ├── js/                   # Interaksi frontend
│   ├── css/                  # Styling frontend
│   └── views/                # Blade pages, admin, layouts, components
├── routes/web.php            # Semua route publik, user, dan admin
├── tests/                    # Feature dan unit tests
├── .env.example              # Template environment
└── README.md
```

## Verifikasi Lokal

```bash
php artisan test
npm run build
php artisan route:list
```

## Aturan Repository

- PRD, ERD, dan laporan tidak disimpan atau dipush ke repository source.
- Screenshot verifikasi dan file sementara tidak menjadi dependency aplikasi.
- Jangan mengubah `.env.example` menjadi `.env` lalu commit file tersebut.

## Lisensi dan Kontak

Project ini dikembangkan untuk Terra SDGs oleh Gavril Muhammad Ghazanfar.
