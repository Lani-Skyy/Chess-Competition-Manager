# Sistem Pengurusan Pertandingan Catur (SPPC)

SPPC ialah sebuah program untuk menguruskan pertandingan catur (round robin). Bahasa sistem ialah Bahasa Melayu.

⚠️Disclaimer! 

This system is very lacking in error checking, if you use it the way you're supposed to, it should work alright. Pls ya, don't put ;DROP TABLE urusetia; as your name or something-

## Installation

1. Cipta sebuah database.
2. Di sambungan.php, tukarkan nama database kepada nama database dicipta. ```$database = 'nama_database_dicipta';```
3. Pergi ke login.php melalui localhost di browser anda. Url akan sedikit berbeza bergantung operating system anda. ```localhost/nama_database_dicipta/login.php```

## Progress
### DATABASE (TABLES)
- urusetia #COMPLETE
- hakim #COMPLETE
- peserta #COMPLETE
- scores #COMPLETE
- matches #COMPLETE

### PAGES
- login.php #COMPLETE
- info.php #TODO
- urusetia.php #COMPLETE
- hakim.php #COMPLETE
- peserta.php #COMPLETE
- pusingan.php #BUGGY
- keputusan.php #COMPLETE

### COMPONENTS
- styles.css #TODO
- head.php #COMPLETE
- header.php #COMPLETE
- navbar_1.php #COMPLETE
- navbar_2.php #COMPLETE
- sambungan.php #COMPLETE
- log_keluar.php #COMPLETE
- algorithm.php #COMPLETE
