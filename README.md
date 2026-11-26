# Serean Tobacco

Aplikasi web sentra pengolahan dan perdagangan tembakau Nusantara berbasis Laravel.

---

## Panduan Menjalankan Aplikasi Lokal

Ikuti langkah-langkah berikut untuk melakukan *clone*, *setup*, dan menjalankan aplikasi hingga dapat diakses di komputer lokal:

### 1. Clone Repository
```bash
git clone https://github.com/username/serean-tobacco.git
cd serean-tobacco
```

### 2. Install Dependensi
```bash
composer install
npm install
```

### 3. Salin Environment & Generate Key
Salin file `.env.example` menjadi `.env`, kemudian buat kunci enkripsi aplikasi:

- **Linux / macOS / Git Bash:**
  ```bash
  cp .env.example .env
  ```
- **Windows PowerShell:**
  ```powershell
  copy .env.example .env
  ```

Lalu generate app key:
```bash
php artisan key:generate
```

### 4. Setup Database & Migrasi
Aplikasi secara default menggunakan SQLite. Pastikan file database tersedia dan jalankan migrasi beserta data seeder:

- **Linux / macOS / Git Bash:**
  ```bash
  touch database/database.sqlite
  php artisan migrate --seed
  ```
- **Windows PowerShell:**
  ```powershell
  if (!(Test-Path database\database.sqlite)) { New-Item database\database.sqlite -ItemType File }
  php artisan migrate --seed
  ```

### 5. Kompilasi Aset Frontend
```bash
npm run build
```

### 6. Menjalankan Server Lokal
Jalankan server pengembangan Laravel:
```bash
php artisan serve
```

Atau jalankan server backend dan Vite secara bersamaan:
```bash
composer run dev
```

Buka peramban (browser) dan akses website di:
```
http://127.0.0.1:8000
```

---

### Akun Login Bawaan (Hasil Seeder)
- **Administrator**: `admin@sereantobacco.com` | Password: `password`
- **Petani Mitra**: `petani@sereantobacco.com` | Password: `password`
- **Customer**: `customer@sereantobacco.com` | Password: `password`
