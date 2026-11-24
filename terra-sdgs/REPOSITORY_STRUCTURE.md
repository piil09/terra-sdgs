# Terra SDGs — Repository Structure

Repository ini berisi source code aplikasi Laravel saja. PRD, ERD, dan laporan disimpan di luar repository source.

## Struktur

```text
terra-sdgs/
├── app/
│   ├── Http/Controllers/     # Logika website publik, user, dan admin
│   ├── Http/Middleware/      # Proteksi AdminOnly dan UserOnly
│   ├── Models/               # User, Event, EventRegistration
│   └── Services/             # Service pembaca data website
├── bootstrap/                # Bootstrap Laravel
├── config/                   # Konfigurasi framework dan aplikasi
├── database/
│   ├── factories/            # Factory test
│   ├── migrations/           # Struktur tabel database
│   └── seeders/              # Akun dan event awal untuk development
├── public/
│   ├── images/               # Gambar produksi website
│   └── svgs/                 # Logo dan ikon produksi
├── resources/
│   ├── css/                  # Styling utama
│   ├── data/                 # tokens.json, content.json, assets.json
│   ├── js/                   # Interaksi frontend
│   └── views/                # Blade pages, admin, layouts, components
├── routes/web.php            # Route publik, user, dan admin
├── tests/                    # Feature dan unit tests
├── .env.example              # Template environment yang aman dibagikan
├── composer.json             # Dependency PHP
├── package.json              # Dependency dan script frontend
└── README.md                # Panduan clone dan menjalankan aplikasi
```

## Tidak Disimpan di Repository

- `PRD_Terra_SDGs.docx`
- `ERD_Terra_SDGs.drawio`
- File gambar ERD
- Laporan dan screenshot verifikasi
- `.env` dan kredensial
- `vendor/`, `node_modules/`, `public/build/`, serta cache/runtime

Aturan ini diterapkan melalui `.gitignore` dan pemeriksaan sebelum push.

## Alur Data Utama

```text
Website publik
  └── SiteController
      ├── EventRegistration -> database.event_registrations
      └── Event              -> database.events

Portal admin
  └── AdminController
      ├── Dashboard
      ├── Events
      ├── Participants
      ├── Articles
      ├── Users
      └── Activity Logs
```

## Setup untuk Kontributor

Ikuti instruksi instalasi dan verifikasi di `README.md`. Setelah clone, contributor hanya perlu menjalankan `composer install`, `npm install`, menyiapkan `.env`, migration/seed, build, lalu `php artisan serve`.
