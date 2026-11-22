# DOKUMEN SERAH TERIMA PENGEMBANGAN (DEVELOPER HANDOVER)
## Proyek: Warung (Sembakoci) — Platform E-Commerce Sembako Modern

Dokumen ini disusun untuk pengembang (developer) yang akan melanjutkan pengembangan proyek **Warung (Sembakoci)**. Seluruh informasi di dalam dokumen ini telah diverifikasi langsung terhadap kode sumber riil (*source code*), konfigurasi lingkungan, skema basis data, dan riwayat *commit* Git pada repositori lokal.

---

## 1. Gambaran Umum Proyek (Project Overview)

### 1.1 Apa itu Warung (Sembakoci)?
**Warung (Sembakoci)** adalah aplikasi web *e-commerce* berbasis katalog dan keranjang belanja yang dirancang khusus untuk memfasilitasi transaksi pemesanan kebutuhan bahan pokok (sembako) dan barang harian secara digital, cepat, dan transparan. Proyek ini memodernisasi cara kerja warung sembako konvensional menjadi toko daring lokal yang rapi tanpa menghilangkan kemudahan berbelanja bagi warga sekitar.

### 1.2 Tujuan Aplikasi
- Menyediakan katalog barang sembako yang selalu terbarui (*up-to-date*) dengan informasi harga, satuan kemasan, dan ketersediaan stok riil.
- Menggantikan pencatatan pesanan manual yang rentan salah hitung melalui fitur keranjang belanja berbasis sesi yang menghitung subtotal dan total belanja secara otomatis dan akurat.
- Memastikan integritas data harga sehingga pesanan pelanggan selalu mengacu pada harga resmi di basis data (mencegah manipulasi harga dari sisi *client/browser*).
- Menyiapkan alur transaksi pemesanan ringkas menuju proses *checkout* dan konfirmasi via pesan instan (WhatsApp) maupun sistem pembayaran lokal.

### 1.3 Fitur Utama yang Telah Ada
1. **Beranda Interaktif (`/`):** Menampilkan *hero section*, produk viral/unggulan yang ditarik dinamis dari basis data, serta ringkasan layanan belanja.
2. **Katalog Produk Terstruktur (`/belanja`):** Menampilkan daftar kategori aktif (Sembako Pokok, Bumbu & Makanan, Kebutuhan Rumah Tangga) beserta produk-produk aktif di dalamnya.
3. **Komponen Kartu Produk Modular (`product-card`):** Mendukung tata letak *viral* dan *default*, menampilkan foto, nama, satuan, harga terformat (IDR), kontrol penyesuaian kuantitas (*stepper*), serta form penambahan ke keranjang belanja.
4. **Keranjang Belanja Sesi (`/keranjang`):** Pengelolaan keranjang berbasis sesi (`session('cart')`) tanpa membebani tabel database sementara, dilengkapi validasi stok, penanganan item tidak aktif secara otomatis, perhitungan subtotal/total rupiah, dan tampilan kondisi kosong (*empty state*).
5. **Indikator Jumlah Item Navbar:** Menampilkan lencana (*badge*) total kuantitas produk di keranjang secara *real-time* di bilah navigasi desktop dan mobile.
6. **Halaman Informasi Statis:** Halaman Pelayanan (`/pelayanan`), Tentang Kami (`/tentang-kami`), dan Kontak (`/kontak`).
7. **Halaman Checkout Mockup (`/checkout`):** Desain antarmuka formulir data pengiriman dan opsi pembayaran (masih berupa tampilan mockup frontend).

### 1.4 Teknologi Utama
- **Backend Framework:** Laravel 13.x (PHP 8.3)
- **Frontend Engine:** Laravel Blade Templating, Tailwind CSS v4, Vanilla JavaScript
- **Build Tool:** Vite 8.x
- **Database Engine:** SQLite 3.x
- **Test Framework:** PHPUnit 12.x

### 1.5 Tahapan Pengembangan Saat Ini
Proyek telah menyelesaikan **Milestone 1** (Fondasi Basis Data), **Milestone 2** (Katalog & Beranda Dinamis), dan **Milestone 3** (Keranjang Belanja Sesi). Tahap berikutnya yang siap diimplementasikan adalah **Milestone 4** (Penyimpanan Pesanan / Orders & Integrasi Checkout Dinamis).

---

## 2. Riwayat Pengembangan (Development History)

Berdasarkan penelusuran riwayat Git (`git log`), berikut adalah tonggak pencapaian (*milestone*) yang telah diselesaikan:

```text
d531117 (HEAD -> master) feat: implement session-based shopping cart and navbar indicator (milestone 3)
58ec144 feat: implement dynamic homepage and catalog with product card integration (milestone 2)
683ccc0 feat: implement category and product models, migrations, and seeders (milestone 1)
ad02544 chore: initial baseline commit of Warung (Sembakoci) frontend
```

### Rincian Setiap Milestone:

1. **Commit `ad02544` — Initial Frontend Baseline**
   - Inisialisasi repositori Git dan konfigurasi `.gitignore`.
   - Setup antarmuka awal berbasis desain Figma menggunakan Laravel Blade dan Tailwind CSS v4.
   - Pembuatan komponen tata letak dasar: `layouts/app.blade.php`, `components/navbar.blade.php`, `components/footer.blade.php`, serta halaman statis.

2. **Commit `683ccc0` — Milestone 1: Category & Product Database Foundation**
   - Pembuatan skema tabel migrasi `categories` dan `products` pada basis data SQLite.
   - Pembuatan model Eloquent `Category` dan `Product` lengkap dengan *attribute casting*, relasi *one-to-many*, *query scopes*, dan *accessor* format harga Rupiah.
   - Pembuatan seeder awal (`CategorySeeder`, `ProductSeeder`) yang mengisi 3 kategori utama dan 10 produk bahan pokok.
   - Pembuatan unit/feature test: `CategoryProductModelTest.php` (5 test lolos).

3. **Commit `58ec144` — Milestone 2: Dynamic Homepage & Product Catalog**
   - Pengubahan kontroler `PageController` agar mengambil produk aktif dari basis data.
   - Tampilan Beranda (`home.blade.php`) terhubung dinamis menampilkan 3 produk viral teratas.
   - Tampilan Belanja (`belanja.blade.php`) terhubung dinamis menampilkan kategori sembako dan produk lainnya.
   - Integrasi komponen `product-card.blade.php` dengan data model.
   - Pembuatan feature test: `HomepageAndCatalogTest.php` (5 test lolos, total 12 test suite lolos).

4. **Commit `d531117` — Milestone 3: Session-Based Shopping Cart**
   - Implementasi `CartService` untuk mengenkapsulasi seluruh manipulasi keranjang di dalam `session('cart')`.
   - Implementasi `CartController` dengan rute RESTful (`GET /keranjang`, `POST /keranjang`, `PATCH /keranjang/{product}`, `DELETE /keranjang/{product}`, `DELETE /keranjang`).
   - Implementasi View Composer pada `AppServiceProvider` untuk membagikan variabel `$cartCount` secara global ke navbar.
   - Pembaruan tampilan `keranjang.blade.php` dengan daftar dinamis, kontrol kuantitas, subtotal, tombol hapus, dan *empty state*.
   - Pembuatan feature test: `CartTest.php` (10 skenario pengujian keranjang lolos, total 22 test suite lolos).

---

## 3. Tech Stack dan Lingkungan Pengembangan

### 3.1 Spesifikasi Perangkat Lunak
- **PHP:** `8.3.30 (cli) (ZTS Visual C++ 2019 x64)`
- **Laravel Framework:** `13.42.0`
- **Node.js:** `v26.10.0`
- **NPM:** `11.19.1`
- **Vite:** `8.0.0` (menggunakan `@tailwindcss/vite: ^4.0.0`)
- **Tailwind CSS:** `^4.0.0`
- **Database Engine:** SQLite `3.40.0`
- **Web Server Lokal:** Laragon (Apache/Nginx) atau CLI bawaan `php artisan serve`

### 3.2 Ketergantungan Ekosistem (Dependencies)
- **Composer (`composer.json`):**
  - `php: ^8.3`
  - `laravel/framework: ^13.17`
  - `laravel/tinker: ^3.0`
  - Dev: `phpunit/phpunit: ^12.5.12`, `mockery/mockery: ^1.6`, `fakerphp/faker: ^1.23`, `laravel/pint: ^1.27`
- **NPM (`package.json`):**
  - `@tailwindcss/vite: ^4.0.0`
  - `tailwindcss: ^4.0.0`
  - `laravel-vite-plugin: ^3.1`
  - `vite: ^8.0.0`

### 3.3 Konfigurasi Lingkungan Laragon
Aplikasi diletakkan di direktori:
```text
C:\laragon\www\warung
```
Jika menggunakan virtual host otomatis Laragon, aplikasi dapat diakses melalui:
```text
http://warung.test
```
Atau melalui URL default:
```text
http://localhost/warung/public
```

### 3.4 Perintah Instalasi & Menjalankan Proyek
Bagi pengembang baru yang baru saja mengkloning atau membuka proyek ini:

```bash
# 1. Pindah ke direktori proyek
cd C:\laragon\www\warung

# 2. Instalasi dependensi PHP
composer install

# 3. Instalasi dependensi JavaScript
npm install

# 4. Salin file konfigurasi lingkungan jika belum ada
copy .env.example .env
php artisan key:generate

# 5. Siapkan basis data SQLite lokal (jika file belum ada)
# Di PowerShell:
if (!(Test-Path database/database.sqlite)) { New-Item database/database.sqlite -ItemType File }
# Di Bash:
# touch database/database.sqlite

# 6. Jalankan migrasi dan seeder
php artisan migrate --seed

# 7. Kompilasi aset frontend
npm run build

# 8. Menjalankan server pengembangan (opsional jika tidak menggunakan Laragon web server)
php artisan serve
# Jalankan Vite HMR di terminal terpisah jika mengubah CSS/JS
npm run dev
```

---

## 4. Struktur Proyek (Project Structure)

Berikut adalah struktur direktori dan peran setiap berkas inti dalam aplikasi:

```text
C:\laragon\www\warung
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Controller.php        # Base controller kelas induk
│   │       ├── PageController.php    # Mengelola halaman publik & katalog
│   │       └── CartController.php    # Mengelola operasi keranjang belanja
│   ├── Models/
│   │   ├── Category.php              # Model kategori produk
│   │   ├── Product.php               # Model data produk sembako
│   │   └── User.php                  # Model pengguna standar Laravel
│   ├── Providers/
│   │   └── AppServiceProvider.php    # View Composer untuk badge keranjang di navbar
│   └── Services/
│       └── CartService.php           # Logika bisnis keranjang (session, validasi stok, total)
├── database/
│   ├── database.sqlite               # File basis data lokal (diabaikan oleh git)
│   ├── migrations/
│   │   ├── ..._create_categories_table.php  # Definisi tabel categories
│   │   └── ..._create_products_table.php    # Definisi tabel products
│   └── seeders/
│       ├── DatabaseSeeder.php        # Master seeder pemanggil seeder lainnya
│       ├── CategorySeeder.php        # Seeder 3 kategori sembako
│       └── ProductSeeder.php         # Seeder 10 produk bahan pokok
├── resources/
│   ├── css/
│   │   └── app.css                   # Konfigurasi Tailwind CSS v4 (@theme & komponen custom)
│   ├── js/
│   │   └── app.js                    # Script JS kontrol kuantitas & menu mobile
│   └── views/
│       ├── components/
│       │   ├── navbar.blade.php      # Bilah navigasi + badge jumlah item keranjang
│       │   ├── footer.blade.php      # Footer aplikasi
│       │   └── product-card.blade.php# Kartu produk dinamis (stepper kuantitas & add-to-cart)
│       ├── layouts/
│       │   └── app.blade.php         # Layout utama Blade + pesan flash alert
│       └── pages/
│           ├── home.blade.php        # Halaman utama / beranda
│           ├── belanja.blade.php     # Halaman katalog produk
│           ├── keranjang.blade.php   # Halaman keranjang belanja
│           ├── checkout.blade.php    # Halaman checkout mockup
│           ├── pelayanan.blade.php   # Halaman pelayanan statis
│           ├── tentang-kami.blade.php# Halaman tentang kami statis
│           └── kontak.blade.php      # Halaman kontak statis
├── routes/
│   └── web.php                       # Seluruh pemetaan rute web
└── tests/
    └── Feature/
        ├── CategoryProductModelTest.php # Pengujian model & basis data
        ├── HomepageAndCatalogTest.php   # Pengujian beranda & katalog
        └── CartTest.php                 # Pengujian menyeluruh alur keranjang
```

---

## 5. Arsitektur Basis Data (Database Architecture)

### 5.1 Skema Tabel

#### 1. Tabel `categories`
Menyimpan klasifikasi kategori produk yang dijual.
- `id` (BIGINT, Primary Key, Auto Increment)
- `name` (VARCHAR): Nama kategori (contoh: "Sembako Pokok").
- `slug` (VARCHAR, Unique): Identifikasi URL ramah mesin pencari (contoh: "sembako-pokok").
- `description` (TEXT, Nullable): Keterangan singkat mengenai kategori.
- `is_active` (BOOLEAN, Default: `true`): Penanda apakah kategori ditampilkan di katalog.
- `created_at`, `updated_at` (TIMESTAMP): Waktu pembuatan dan pembaruan data.

#### 2. Tabel `products`
Menyimpan rincian setiap item barang yang tersedia.
- `id` (BIGINT, Primary Key, Auto Increment)
- `category_id` (BIGINT, Foreign Key): Terhubung ke `categories.id` dengan relasi `cascadeOnDelete()`.
- `name` (VARCHAR): Nama produk (contoh: "Minyak goreng").
- `slug` (VARCHAR, Unique): Slug unik produk (contoh: "minyak-goreng").
- `description` (TEXT, Nullable): Deskripsi kegunaan dan spesifikasi barang.
- `price` (UNSIGNED INTEGER): Harga jual produk dalam satuan Rupiah bulat tanpa desimal (contoh: `11500`).
- `unit` (VARCHAR, Default: `'pcs'`): Satuan kemasan barang (contoh: `liter`, `kg`, `pcs`, `botol`).
- `stock` (UNSIGNED INTEGER, Default: `0`): Jumlah stok gudang yang tersedia.
- `image_path` (VARCHAR, Nullable): Jalur relatif aset gambar produk (contoh: `images/product-hero.png`).
- `is_active` (BOOLEAN, Default: `true`): Penanda keaktifan produk. Jika `false`, produk otomatis tersembunyi dari katalog dan ditolak dari keranjang.
- `created_at`, `updated_at` (TIMESTAMP): Waktu pembuatan dan pembaruan data.

### 5.2 Relasi Antar Model
- **`Category` -> `Product`:** *One-to-Many* (`$category->products()`).
- **`Product` -> `Category`:** *Belongs-To* (`$product->category()`).
- Kedua model memiliki *Local Query Scope* `scopeActive()` untuk memfilter hanya entitas yang `is_active = true`.
- Model `Product` memiliki *Accessor*:
  - `formatted_price`: Menghasilkan string berformat Rupiah lokal (contoh: `IDR 11.500`).
  - `formatted_price_with_unit`: Menghasilkan format lengkap beserta satuan (contoh: `IDR 11.500 / liter`).

### 5.3 Pemisahan Data: Database vs Session
- **Database (SQLite):** Berfungsi sebagai **sumber kebenaran tunggal (*Single Source of Truth*)**. Menyimpan master data produk, status aktif, harga resmi, dan ketersediaan stok fisik.
- **Session Laravel (`session('cart')`):** Keranjang belanja **TIDAK** menggunakan tabel basis data sementara. Keranjang disimpan di dalam sesi HTTP dengan struktur kamus ringkas:
  ```php
  // Format penyimpanan di session:
  [
      $productId => $quantity,
      // Contoh: [ 1 => 2, 4 => 1 ]
  ]
  ```
  **Catatan Keamanan Penting:** Harga barang dan nama produk sama sekali tidak disimpan di dalam sesi maupun dipercayai dari payload *form request*. `CartService` selalu mencocokkan `product_id` ke tabel `products` saat menghitung subtotal dan total harga. Jika pelanggan mencoba mengirim manipulasi `price` via form POST, nilai tersebut diabaikan total.

---

## 6. Alur Kerja Aplikasi (Application Workflow)

### 6.1 Alur Beranda (Homepage Workflow)
1. Pengguna membuka URL `/`.
2. Router mengarahkan ke `PageController@home`.
3. Mengambil 3 produk pertama yang aktif dengan relasi kategorinya:
   ```php
   $viralProducts = Product::active()->with('category')->take(3)->get();
   ```
4. Mengembalikan view `pages.home` dengan variabel `$viralProducts`.
5. Komponen kartu produk menampilkan produk tersebut di seksi *"PRODUK YANG LAGI VIRAL"*.

### 6.2 Alur Katalog Belanja (Catalog Workflow)
1. Pengguna membuka URL `/belanja`.
2. Router mengarahkan ke `PageController@belanja`.
3. Mengambil seluruh kategori aktif beserta produk aktif di dalamnya:
   - Mencari kategori khusus bertanda slug `sembako-pokok` untuk mengisi seksi sorotan utama (maksimal 5 produk).
   - Mengambil produk-produk dari kategori lainnya untuk mengisi seksi *"Banyak jenis pilihan lain"* (maksimal 6 produk).
4. Mengembalikan view `pages.belanja`.

### 6.3 Alur Kartu Produk & Stepper Kuantitas
1. Kartu produk dirender melalui Blade component `<x-product-card :product="$item" />`.
2. Setiap kartu dilengkapi kontrol kuantitas bertombol `-` dan `+` yang dikendalikan oleh JavaScript (`resources/js/app.js`):
   - Nilai minimum kuantitas dibatasi `min="1"`.
   - Nilai maksimum dibatasi `max="{{ $product->stock }}"`.
3. Tombol *"Beli"* mengirimkan form POST ke rute `route('cart.add')` dengan payload:
   - `product_id`: ID produk bersangkutan.
   - `quantity`: Jumlah barang yang dipilih.

### 6.4 Alur Keranjang Belanja (Shopping Cart Lifecycle)
Keranjang belanja dikelola terpusat oleh `App\Services\CartService`:

1. **Menambah Item (`CartService::add`):**
   - Validasi eksistensi dan keaktifan produk (`is_active = true`).
   - Validasi batas stok: Jika `(kuantitas_sekarang + kuantitas_baru) > stock`, permintaan ditolak dengan pesan kesalahan ramah pengguna.
   - Jika valid, kuantitas digabungkan ke `session('cart')[$productId]`.
2. **Memperbarui Kuantitas (`CartService::update` / `increase` / `decrease`):**
   - Pengguna dapat menekan tombol `+` atau `-` di halaman keranjang (`PATCH /keranjang/{product}`).
   - Sistem memeriksa ketersediaan stok terbaru sebelum menambahkan kuantitas.
   - Jika kuantitas disetel menjadi `0`, item otomatis dihapus dari keranjang.
3. **Pembersihan Otomatis (*Self-Healing / Stale Items*):**
   - Saat `CartService::getItems()` dipanggil, sistem memuat seluruh produk dari basis data.
   - Jika ada produk yang telah dihapus dari DB atau dinonaktifkan (`is_active = false`), produk tersebut otomatis dibersihkan dari sesi tanpa menyebabkan error 500.
   - Jika stok di DB berkurang sehingga stok lebih kecil dari kuantitas di keranjang, kuantitas di keranjang disesuaikan ke stok maksimal yang tersisa.
4. **Perhitungan Subtotal & Total:**
   - Subtotal per item: `$product->price * $quantity`.
   - Total keranjang: Penjumlahan dari seluruh subtotal item aktif.
5. **Indikator Navbar (`$cartCount`):**
   - `AppServiceProvider` mendaftarkan View Composer global `View::composer('*', ...)` yang memanggil `CartService::getTotalQuantity()`.
   - Seluruh view secara otomatis menerima `$cartCount` tanpa perlu di-passing manual dari setiap controller.
   - Komponen `navbar.blade.php` menampilkan badge angka hanya jika `$cartCount > 0`.

---

## 7. Rute dan Pengendali (Routes & Controllers)

Tabel berikut memuat seluruh rute aplikasi yang aktif dan terdaftar:

| HTTP Method | URI | Nama Rute | Controller Action | Deskripsi & Tujuan |
|---|---|---|---|---|
| `GET` | `/` | `home` | `PageController@home` | Menampilkan beranda dan produk viral |
| `GET` | `/belanja` | `belanja` | `PageController@belanja` | Menampilkan katalog produk per kategori |
| `GET` | `/pelayanan` | `pelayanan` | `PageController@pelayanan` | Halaman statis informasi pelayanan |
| `GET` | `/checkout` | `checkout` | `PageController@checkout` | Halaman formulir pemesanan/checkout mockup |
| `GET` | `/tentang-kami`| `tentang-kami` | `PageController@tentangKami` | Halaman statis profil toko |
| `GET` | `/kontak` | `kontak` | `PageController@kontak` | Halaman statis informasi kontak warung |
| `GET` | `/keranjang` | `keranjang` | `CartController@index` | Menampilkan rincian isi keranjang belanja |
| `POST` | `/keranjang` | `cart.add` | `CartController@add` | Menambahkan produk dan kuantitas ke keranjang |
| `PATCH` | `/keranjang/{product}` | `cart.update` | `CartController@update` | Mengubah kuantitas item (tambah/kurang) |
| `DELETE` | `/keranjang/{product}` | `cart.remove` | `CartController@remove` | Menghapus satu produk spesifik dari keranjang |
| `DELETE` | `/keranjang` | `cart.clear` | `CartController@clear` | Mengosongkan seluruh isi keranjang belanja |
| `GET` | `/up` | - | `HealthCheck` | Health check bawaan Laravel |

### Tanggung Jawab Controller:
- **`PageController`:** Bertanggung jawab murni pada penyajian halaman konten publik dan katalog read-only.
- **`CartController`:** Mengelola mutasi data sesi keranjang belanja, memvalidasi input HTTP, memanggil `CartService`, dan mengembalikan pengalihan (*redirect*) dengan flash message alert.

---

## 8. Arsitektur Tampilan Frontend (Frontend Architecture)

### 8.1 Desain dan Skema Warna (Figma Alignment)
Aplikasi mengusung nuansa warna bumi (*earth-tone*) hangat sesuai identitas sembako tradisional-modern:
- **Krem / Latar Belakang (`--color-cream`):** `#efe9de`
- **Taupe / Bilah Navigasi (`--color-taupe`):** `#b9ac99`
- **Charcoal Gelap / Teks Utama & Tombol (`--color-dark`):** `#2b2925`
- **Muted Gray / Subtitle & Harga Lama (`--color-muted`):** `#615a57`
- **Tipografi:** Google Font *Source Serif Pro* (dimuat via CDN Google Fonts di header).

### 8.2 Konfigurasi Tailwind CSS v4
Dikonfigurasi langsung pada file `resources/css/app.css` menggunakan sintaks resmi Tailwind v4:
```css
@import 'tailwindcss';

@theme {
    --font-sans: 'Source Serif Pro', ui-serif, Georgia, Cambria, serif;
    --color-cream: #efe9de;
    --color-taupe: #b9ac99;
    --color-dark: #2b2925;
    --color-muted: #615a57;
}
```
Class komponen umum yang sering digunakan:
- `.btn-primary`: Tombol rounded gelap `#2b2925` dengan teks krem.
- `.btn-outline`: Tombol border kotak elegan dengan hover inversi warna.
- `.nav-link`: Link navigasi berukuran 16px dengan status aktif bold.
- `.product-card`: Kontainer putih rounded dengan efek bayangan hover halus.

### 8.3 Flash Alert Toast
Pada `resources/views/layouts/app.blade.php`, terdapat penampung pesan flash alert yang otomatis tampil mengambang (*floating*) di sudut kanan atas jika controller mengembalikan `session('success')` atau `session('error')`. Alert dilengkapi tombol tutup interaktif (*dismissible*).

### 8.4 Kompilasi Aset Vite
File manifes aset berada di:
```text
public/build/manifest.json
```
**Aturan Penting untuk Developer:** Setiap kali mengubah class Tailwind atau file JS, selalu jalankan `npm run build` sebelum menjalankan pengujian PHPUnit, karena pengujian integrasi Blade bergantung pada keberadaan berkas manifes Vite yang valid.

---

## 9. Pengujian dan Alur Kerja Git (Testing & Git Workflow)

### 9.1 Berkas Pengujian yang Tersedia
Aplikasi memiliki 4 file pengujian di folder `tests/Feature/`:

1. **`CategoryProductModelTest.php` (5 Tests):**
   - Menguji bahwa data kategori dan produk berhasil diseed.
   - Menguji relasi `Category` *has-many* `Product`.
   - Menguji relasi `Product` *belongs-to* `Category`.
   - Menguji casting tipe data atribut model (integer & boolean).
   - Menguji *database constraint unique slug*.

2. **`HomepageAndCatalogTest.php` (5 Tests):**
   - Menguji bahwa beranda terbuka dengan status HTTP 200 dan memuat produk viral.
   - Menguji bahwa beranda tidak menampilkan produk yang non-aktif.
   - Menguji bahwa halaman `/belanja` menampilkan kategori dan produk dengan benar.
   - Menguji bahwa seluruh link navigasi publik dapat diakses.

3. **`CartTest.php` (10 Tests):**
   - Penambahan produk ke keranjang belanja (`POST /keranjang`).
   - Penambahan produk yang sama berulang kali menggabungkan kuantitas.
   - Pembaruan kuantitas produk via stepper kuantitas (`PATCH /keranjang/{id}`).
   - Penghapusan produk dari keranjang (`DELETE /keranjang/{id}`).
   - Penolakan penambahan produk yang statusnya non-aktif.
   - Penolakan kuantitas yang melebihi sisa stok gudang.
   - Akurasi perhitungan subtotal dan total harga Rupiah.
   - Perilaku tampilan keranjang belanja dalam kondisi kosong (*empty state*).
   - Tampilan indikator lencana kuantitas di navbar saat terisi.
   - Integritas harga: Menolak manipulasi harga dari payload request client dan selalu menghitung berdasarkan harga di tabel database.

4. **`ExampleTest.php` (Feature & Unit):**
   - 2 pengujian dasar bawaan Laravel (smoke test).

### 9.2 Status Hasil Verifikasi Uji
- **Pada Commit `d531117`:**
  Seluruh 22 pengujian berjalan sukses tanpa kendala:
  ```text
  OK (22 tests, 77 assertions) - Passed 100%
  ```
- **Hasil Verifikasi Saat Inspeksi Repositori:**
  Saat dilakukan inspeksi awal pada working copy, terdeteksi modifikasi *uncommitted* pada file `resources/views/components/navbar.blade.php` baris 18:
  ```blade
  <!-- Baris yang bermasalah jika ditulis inline: -->
  Keranjang@if(($cartCount ?? 0) > 0) <span class="...">{{ $cartCount }}</span>@endif
  ```
  Penulisan tag Blade `@if` yang langsung menempel tanpa pemisahan baris/spasi dengan teks `Keranjang` menyebabkan parser Blade compiler melempar:
  ```text
  ParseError: syntax error, unexpected token "endif"
  ```
  Hal ini mengakibatkan 9 pengujian yang merender navbar gagal sementara. Ketika baris tersebut dirapikan menjadi:
  ```blade
  <span>Keranjang</span>
  @if(($cartCount ?? 0) > 0)
      <span class="bg-[#2b2925] text-[#efe9de] text-xs font-bold px-2 py-0.5 rounded-full">{{ $cartCount }}</span>
  @endif
  ```
  Seluruh 22 pengujian kembali lolos 100%.

### 9.3 Cara Menjalankan Test Suite
```bash
# Menjalankan seluruh pengujian:
php vendor/bin/phpunit

# Menjalankan pengujian spesifik keranjang belanja:
php vendor/bin/phpunit --testdox tests/Feature/CartTest.php

# Menjalankan melalui artisan:
php artisan test
```

---

## 10. Status Pengembangan Saat Ini (Current Development Status)

Tabel berikut merangkum status kelengkapan fitur aplikasi berdasarkan bukti nyata pada kode program:

| Fitur / Modul | Status | Bukti Kode Sumber | Catatan untuk Developer Penerus |
|---|---|---|---|
| **Manajemen Kategori** | **Completed** | `Category.php`, migrasi `categories`, `CategorySeeder.php` | Sudah memiliki relasi, casting, dan scope active. |
| **Manajemen Produk** | **Completed** | `Product.php`, migrasi `products`, `ProductSeeder.php` | Format mata uang IDR, unit kemasan, dan validasi stok sudah siap. |
| **Tampilan Beranda Dinamis** | **Completed** | `PageController@home`, `home.blade.php` | Mengambil 3 produk viral teratas secara dinamis dari database. |
| **Katalog Belanja Dinamis** | **Completed** | `PageController@belanja`, `belanja.blade.php` | Produk sembako dan produk umum tampil sesuai kategori. |
| **Komponen Kartu Produk** | **Completed** | `product-card.blade.php`, `app.js` | Stepper kuantitas client-side dan submit form add-to-cart berfungsi. |
| **Layanan Keranjang (CartService)** | **Completed** | `app/Services/CartService.php` | Logika sesi, validasi stok, proteksi manipulasi harga tuntas. |
| **Pengendali Keranjang (CartController)** | **Completed** | `CartController.php`, rute di `web.php` | Rute index, add, update, remove, dan clear aktif. |
| **Halaman Keranjang Dinamis** | **Completed** | `keranjang.blade.php` | Rincian harga, tombol +/- kuantitas, tombol hapus, dan empty state. |
| **Lencana Indikator Navbar** | **Needs Verification** | `AppServiceProvider.php`, `navbar.blade.php` | Logika composer aktif, perlu memastikan sintaks baris 18 navbar bersih dari ParseError. |
| **Halaman Checkout** | **Partially Completed** | `checkout.blade.php`, `PageController@checkout` | Hanya antarmuka visual mockup statis. Belum terhubung dengan isi keranjang riil dan form action masih `#`. |
| **Penyimpanan Pesanan (Orders)** | **Not Started** | Belum ada migrasi `orders` / `order_items` | Belum ada model `Order`, tabel pesanan, atau nomor resi/invoice. |
| **Integrasi Pembayaran** | **Not Started** | Hanya radio button visual di `checkout.blade.php` | Belum ada payment gateway, integrasi e-wallet, atau pencatatan status bayar. |
| **Notifikasi WhatsApp** | **Not Started** | Belum ada integrasi WhatsApp link | Perlu dibuatkan generator tautan `https://wa.me/...` dengan format pesan otomatis. |
| **Panel Dashboard Admin** | **Not Started** | Belum ada modul admin | Pengelolaan produk dan stok saat ini masih melalui seeder basis data. |

---

## 11. Isu yang Diketahui dan Pertimbangan Teknis (Known Issues & Technical Considerations)

1. **Perhatian Khusus pada Sintaks Blade `navbar.blade.php`:**
   Pastikan tag `@if(($cartCount ?? 0) > 0)` di dalam `navbar.blade.php` tidak ditulis menempel secara inline tanpa spasi dengan elemen teks `Keranjang`. Format Blade yang disarankan adalah membungkus teks dalam tag `<span>Keranjang</span>` terpisah agar parser Blade PHP tidak mengalami *unexpected token "endif"*.
2. **Ketergantungan Manifes Vite pada Lingkungan Pengujian:**
   Blade template memuat aset menggunakan `@vite(['resources/css/app.css', 'resources/js/app.js'])`. Jika berkas `public/build/manifest.json` terhapus, Laravel test runner akan melempar `ViteManifestNotFoundException`. Selalu jalankan `npm run build` jika file manifes hilang.
3. **Masa Aktif Keranjang Sesi (Session Expiry):**
   Karena keranjang belanja disimpan di dalam sesi Laravel (`session('cart')`), data keranjang akan hilang jika sesi kedaluwarsa atau pengguna menghapus cookie browser. Untuk toko warung lokal sederhana hal ini sudah memadai, namun jika di masa depan dibutuhkan keranjang permanen lintas perangkat, perlu dibuatkan tabel `cart_items` yang diikat ke identitas pengguna (*User ID*).
4. **Halaman Checkout Masih Statis:**
   Saat ini, jika pengguna menekan tombol *"Pesan"* di keranjang belanja, rute diarahkan ke `/checkout`. Namun halaman checkout tersebut masih memuat produk hardcoded (*Tepung terigu IDR 11.500*). Ini adalah prioritas utama pada Milestone berikutnya.
5. **Ketiadaan Penguncian Stok (*Stock Locking / Concurrency*):**
   Saat ini stok divalidasi ketika barang dimasukkan ke keranjang. Namun, stok belum dikurangi dari tabel `products` sebelum pesanan resmi dibuat (*checkout*). Saat mengimplementasikan Milestone 4, pengurangan stok wajib menggunakan *Database Transaction* (`DB::transaction`) dengan klausa `lockForUpdate()` agar tidak terjadi *overselling* saat beberapa pelanggan memesan barang terakhir secara bersamaan.

---

## 12. Panduan Onboarding Pengembang Penerus (How to Continue Development)

Ikuti langkah-langkah berikut untuk memulai pekerjaan di lingkungan lokal Anda secara aman:

### Langkah 1: Buka Proyek di Editor Kode
Buka folder `C:\laragon\www\warung` menggunakan Visual Studio Code, Antigravity, atau PHPStorm.

### Langkah 2: Periksa Konfigurasi `.env` dan Basis Data
1. Buka file `.env`. Pastikan pengaturan database menggunakan driver SQLite:
   ```dotenv
   DB_CONNECTION=sqlite
   # DB_DATABASE tidak perlu diisi path absolut jika menggunakan default database/database.sqlite
   ```
2. Pastikan file `database/database.sqlite` tersedia. Jika belum ada, buat file kosong tersebut.
3. **PENTING:** Jangan pernah menjalankan `php artisan migrate:fresh` atau `db:wipe` secara sembarangan jika basis data lokal telah berisi data uji yang ingin Anda pertahankan. Cukup gunakan `php artisan migrate` jika ada migrasi baru.

### Langkah 3: Menjalankan Laragon & Build Tools
1. Pastikan Laragon telah dijalankan (*Start All*).
2. Buka terminal di folder proyek:
   ```bash
   # Jalankan build frontend
   npm run build
   ```
3. Uji aksesibilitas website pada browser melalui URL `http://warung.test` atau `http://localhost/warung/public`.

### Langkah 4: Validasi Awal dengan Menjalankan Test Suite
Sebelum membuat baris kode baru, pastikan seluruh pengujian yang ada berada dalam kondisi hijau:
```bash
php vendor/bin/phpunit
```
Jika menemukan error parse pada view navbar, periksa kembali penulisan baris 18 pada `resources/views/components/navbar.blade.php` sebagaimana dijelaskan pada Seksi 9.2.

### Langkah 5: Praktik Git Checkpoint yang Aman
Sebelum memulai fitur baru:
1. Buat branch baru untuk milestone berikutnya:
   ```bash
   git checkout -b feature/milestone-4-checkout-orders
   ```
2. Pastikan sebelum melakukan commit, selalu jalankan `npm run build` dan `php vendor/bin/phpunit`.

---

## 13. Rekomendasi Langkah Pengembangan Selanjutnya (Milestone 4 Roadmap)

Berdasarkan kondisi riil sistem saat ini, berikut adalah urutan pengembangan yang logis dan terstruktur untuk dikerjakan berikutnya:

### Tahap 1: Stabilisasi Working Copy
- Rapikan file `resources/views/components/navbar.blade.php` agar bebas dari error sintaks Blade.
- Buat commit perbaikan jika belum di-commit, sehingga seluruh 22 pengujian berjalan 100% pas.

### Tahap 2: Skema Data Pemesanan (Order Schema & Migration)
Buat migrasi dan model untuk menyimpan pesanan:
1. **Tabel `orders`:**
   - `id`, `order_code` (string unik, contoh: `SBC-20261122-001`), `customer_name`, `customer_phone` (WhatsApp), `shipping_address`, `notes`, `payment_method` (`dana`, `gopay`, `ovo`, `cod`), `status` (`pending`, `confirmed`, `delivered`, `cancelled`), `subtotal`, `shipping_cost`, `total_amount`, `timestamps`.
2. **Tabel `order_items`:**
   - `id`, `order_id` (FK cascade), `product_id` (FK restrict/null), `product_name`, `price`, `quantity`, `subtotal`, `timestamps`.

### Tahap 3: Implementasi Controller Checkout Dinamis
1. Buat `CheckoutController`:
   - `create()`: Mengambil item dari `CartService::getItems()`. Jika keranjang kosong, redirect ke `/belanja` dengan pesan peringatan. Menghitung subtotal dan ongkos kirim (contoh flat IDR 500 atau gratis sesuai radius).
   - `store(Request $request)`: Validasi data pelanggan (nama, nomor WA aktif, alamat lengkap, opsi pembayaran).
2. Eksekusi penyimpanan di dalam `DB::transaction()`:
   - Simpan entitas `Order` dan seluruh `OrderItem`.
   - Kurangi stok produk bersangkutan di tabel `products`.
   - Kosongkan keranjang belanja via `CartService::clear()`.
   - Simpan ID pesanan di flash session untuk halaman sukses.

### Tahap 4: Halaman Sukses Pemesanan & Integrasi WhatsApp
1. Buat halaman `/pesanan/sukses/{order_code}`.
2. Tampilkan rincian pesanan dan tombol besar *"Kirim Rincian Pesanan ke WhatsApp Penjual"*:
   - Tautan mengarah ke `https://wa.me/628xxxxxxxxxx?text=...` dengan teks ringkasan pesanan yang sudah diformat rapi (nama pelanggan, alamat kirim, daftar belanjaan, dan total yang harus dibayar).

---

## 14. Penutup dan Standar Kode

- **Konvensi Penamaan:**
  - Model: Singular PascalCase (`Product`, `Category`, `Order`).
  - Tabel: Plural snake_case (`products`, `categories`, `orders`, `order_items`).
  - Controller: Singular PascalCase dengan akhiran Controller (`CartController`, `CheckoutController`).
  - Routes: Kebab-case untuk URL (`/tentang-kami`), dot notation untuk nama rute (`cart.add`, `order.store`).
- **Prinsip Keamanan:**
  - Jangan pernah mempercayai input kuantitas atau harga dari pengguna tanpa validasi server.
  - Lindungi seluruh form POST/PATCH/DELETE dengan direktif `@csrf`.
  - Hindari penulisan kredensial sensitif di dalam kode sumber; selalu gunakan `env()` atau `config()`.

*Dokumen ini dibuat secara komprehensif agar pengembang penerus dapat langsung bekerja secara mandiri, aman, dan efisien.*
