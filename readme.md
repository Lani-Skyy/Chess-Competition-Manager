# Sistem Pengurusan Pertandingan Catur (SPPC)

SPPC ialah sebuah program untuk menguruskan pertandingan catur (round robin). Bahasa sistem ialah Bahasa Melayu.

## Installation
❗ xampp is required

⚠️ path and url can differ based on operating system

1. Start xampp.
2. Save and unzip this folder in ```C:/xampp/htdocs/``` 
    - Additionally, you can move the inner folder to htdocs, then rename it to something shorter
3. Create a database in phpMyAdmin through localhost in your browser ```http://localhost/phpmyadmin/```
4. In sambungan.php, change the database name to the name of the database you created earlier. ```$database = 'database_name';```
5. Go to login.php through localhost in your browser. ```localhost/folder_name/login.php```

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
- pusingan.php #COMPLETE
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
