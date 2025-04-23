# Tracer Study Stakeholder

**Tracer Study Stakeholder** adalah platform berbasis web yang dirancang untuk memfasilitasi pelacakan dan pemantauan perkembangan karir alumni melalui penilaian yang diberikan oleh stakeholder.

## 🔍 Deskripsi Singkat

Aplikasi ini mengumpulkan dan menganalisis penilaian alumni oleh stakeholder (perusahaan atau pengguna eksternal) guna membantu institusi pendidikan dalam mengevaluasi kualitas lulusannya.

## 🧩 Fitur Utama

- **Stakeholder:**

  - Mengisi identitas (nama pengisi, perusahaan, jabatan, email, no. HP, nama lulusan, tahun lulus).
  - Menjawab 7 pertanyaan penilaian.
  - Memberikan harapan dan masukan untuk program studi.

- **Admin:**
  - Melihat, menghapus, mengedit, dan mencari data stakeholder.
  - Melihat, menghapus, dan mencari data penilaian.
  - Generate laporan penilaian berdasarkan tanggal dan format tertentu.

## 👥 Aktor

- **Admin**
- **Stakeholder**

## 🛠️ Teknologi yang Digunakan

- **Frontend:** HTML, CSS, JavaScript, Bootstrap
- **Backend:** PHP
- **Database:** MySQL

---

## 🚀 Instalasi & Penggunaan

### 1. Clone Repository

```bash
git clone https://github.com/justrahyan/TracerStudy_Stakeholder
```

### 2. Konfigurasi Database

- Buka **phpMyAdmin**.
- Buat database baru, bernama `db_pep`.
- Import file database yang ada di folder `/assets/db/db_pep.sql`.

### 3. Struktur Tabel

#### Tabel: `tb_datastakeholder`

| Kolom        | Tipe Data |
| ------------ | --------- |
| id           | INT       |
| nama_pengisi | VARCHAR   |
| perusahaan   | VARCHAR   |
| jabatan      | VARCHAR   |
| email        | VARCHAR   |
| no_hp        | VARCHAR   |

#### Tabel: `tb_penilaianstakeholder`

| Kolom            | Tipe Data |
| ---------------- | --------- |
| id               | INT       |
| tanggal          | DATE      |
| nama_stakeholder | VARCHAR   |
| nama_alumni      | VARCHAR   |
| tahun_lulus      | VARCHAR   |
| pertanyaan_1     | ENUM      |
| pertanyaan_2     | ENUM      |
| pertanyaan_3     | ENUM      |
| pertanyaan_4     | ENUM      |
| pertanyaan_5     | ENUM      |
| pertanyaan_6     | ENUM      |
| pertanyaan_7     | ENUM      |
| harapan          | TEXT      |
| masukan          | TEXT      |

### 4. Jalankan Aplikasi

- Pindahkan folder project ke dalam folder `htdocs` (jika menggunakan XAMPP).
- Jalankan Apache dan MySQL dari XAMPP.
- Akses aplikasi melalui browser:

```
http://localhost/tracerstudy_stakeholder/index.php
```

---

## 👨‍💻 Kontributor

- Muhammad Rahyan Noorfauzan
- Muhammad Alfauzi Arif
- Muhammad Raihan
- Muthia Surhefa
