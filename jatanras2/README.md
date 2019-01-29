# jatanrasdocumen
Jatanras document yaitu aplikasi yang digunakan untuk upload dokumen atau berkas tindak pidana yang dilaporkan oleh pihak pelapor yang kemudian akan dioleh laporannya oleh penyidik.

Pihak yang terlibat dalam aplikasi ini yaitu :
1. Renmin
2. Kasubdit
3. Kanit
4. Penyidik
5. Admin


# Catatan Revisi 11-12-2018
RENMIN -> HANYA UPLOAD DOKUMEN
ADMIN -> FULL ACCESS

TAMBAHKAN FEATURE SORT BY FIELD --> SELESAI

SEARCH BY PELAPOR, KASUS, NO_LP, KORBAN, PELAKU, SEARCH BY ALL + BY TANGGAL

TAMBAHKAN TOMBOL BACK di pencarian dan detail pencarian
Tambahkan di dokumen UNDANG-UNDANG, JADI MASTER JUGA
TAMBAHKAN TANGGAL DAN JAM

OPSI MULTI UPLOAD
FILE BISA DI REMOVE, DILIHAT DAN DOWNLOAD
BUAT MASTER DATA PELAKU


KASUBDIT
list kasus/dokumen yang baru ada tandanya
list pada dokument harus beda antara yang sudah diproses dan belum
TAMBAHKAN TOMBOL DISPOSISI DI EDIT FILE ATAU DETAIL DOKUMT
KASUBDIT BISA UPLOAD DOKUMEN, HAPUS DOKUMEN
STATUS KASUS DI KASUBDIT
FILTER KASUS BY UNIT
MASTER JABATAN HARUS ADA

PENYIDIK
SAMA DENGAN KASUBDIT


# Progress Revisi 11-12-2018
1. Penambahan feature sort by field --> SUDAH SELESAI
2. Master Data Renmin --> SUDAH SELESAI
3. Master Data Pelaku --> ON PROGRESS
4. Penambahan Warna Rows yang sudah diproses dan belemu di proses --> SUDAH SELESAI
5. Search by no lp, kasus, pelaku, pelapor, korban, tanggal kejadian --> SUDAH SELESAI

# Progress Revisi 19-12-2018
6. Master Jabatan --> SUDAH SELESAI
7. Master Data Pelaku --> SUDAH SELESAI
8. Penambahan list dokumen di dashboard --> SUDAH SELESAI


# Stuktur Database 

CREATE TABLE `pelaku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(60) DEFAULT NULL,
  `telpon` varchar(15) DEFAULT NULL,
  `alamat` text,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `activation` enum('0','1') DEFAULT '1' COMMENT '0 > NonAktif, 1 > Aktif',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(255) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

CREATE TABLE `pasal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pasal` int(11) DEFAULT NULL,
  `kasus` text,
  `deskripsi` text,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;



# User Access
URL >>> http://develsync.com/jatanras
1. Admin (User : admin1234 Pass : admin1234)
2. Renmin
3. Kasubdit (User : 20111091 Pass : 20111091)
4. Kanit (User : 20111092 Pass : 20111092)
5. Penyidik (User : 201110130 Pass : 123)


[12:07, 12/11/2018] Putra Sync: KASUBDIT

u: 20111091
p: 20111091
[12:07, 12/11/2018] Putra Sync: renmin
u & p : admin1234
[12:08, 12/11/2018] Putra Sync: penyidik :
u : 201110130
p : 123

Status => Selesai
Update selesai oleh KANIT atau KASUBDIT

WARNA BARIS
Kasus baru => Kuning
Selesai => Hijau
Proses => Biru


Feature Update selesai

Keterangan pencarian keyword
