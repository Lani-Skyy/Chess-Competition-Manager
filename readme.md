# Sistem Pengurusan Pertandingan Catur (SPPC)
SPPC is a program to manage chess competitions (round robin). The system language is Malay.

## Installation (using xampp)
❗ change folder_name and database_name to whatever you want

1. Save and unzip this folder in ```C:/xampp/htdocs/```
2. Start xampp (Apache and MySQL)
3. Go to ```http://localhost/phpmyadmin/``` and create a database
4. In sambungan.php, change the database name ```$database = 'database_name';```
5. Go to ```localhost/SPPC-main/SPPC-main/login.php```

## Components
### Database Tables (automatically created)
- urusetia
- hakim
- peserta
- scores
- matches

### Pages
- login.php alert
- info.php alert
- urusetia.php alert
- hakim.php
- peserta.php
- pusingan.php
- keputusan.php

### Components
- styles.css
- head.php
- navbar_1.php
- navbar_2.php
- sambungan.php
- log_keluar.php
- algorithm.php
- functions.php

## Screenshots
![login](screenshots/login.png)
![info](screenshots/info.png)
![hakim](screenshots/hakim.png)
![peserta_sebelum](screenshots/peserta_sebelum.png)
![peserta_selepas](screenshots/peserta_selepas.png)
![pusingan_sebelum](screenshots/pusingan_sebelum.png)
![pusingan_selepas](screenshots/pusingan_selepas.png)
![keputusan](screenshots/keputusan.png)
![urusetia](screenshots/urusetia.png)

## TODO
1. alerts
2. export
3. import
