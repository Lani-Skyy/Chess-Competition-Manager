# Sistem Pengurusan Pertandingan Catur (SPPC)

SPPC ialah sebuah program untuk menguruskan pertandingan catur.

## Installation

Untuk menggunakan program ini, terlebih dahulu, sebuah database perlu dicipta. Database ini mesti dinamakan "pertandingan". Selepas itu, tolong melaksanakan semua statement sql di bawah.

```sql
-- statement pertama
CREATE TABLE urusetia (
    id INT(10) NOT NULL AUTO_INCREMENT,
    nama_pengguna VARCHAR(30) NOT NULL,
    kata_laluan VARCHAR(15) NOT NULL
);
-- statement pertama akhir

-- statement kedua
CREATE TABLE hakim (
    id INT(10) NOT NULL AUTO_INCREMENT,
    nama VARCHAR(30) NOT NULL
);
-- statement kedua akhir

-- statement ketiga
CREATE TABLE peserta (
    id INT(10) NOT NULL AUTO_INCREMENT,
    no_kp VARCHAR(15) NOT NULL,
    nama VARCHAR(30) NOT NULL
);
-- statement ketiga akhir
```

## Incomplete
- Pengiraan skor
- Paparan skor

## Complete
- login, logout, daftar, update dan delete urusetia
- create, update, delete, dan reset hakim
- daftar dan reset peserta
- Padanan peserta (dan paparan padanan) untuk setiap perlawanan