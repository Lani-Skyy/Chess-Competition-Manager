# Sistem Pengurusan Pertandingan Catur (SPPC)
SPPC is a program to manage chess competitions (round robin). The system language is Malay.

## Installation (using xampp)

1. Save and unzip this folder 
    - (optional step) Move the inner folder ```SPPC-main/SPPC-main``` out so it becomes ```SPPC-main``` then rename it to ```SPPC``` 
3. Move folder to ```C:/xampp/htdocs/```
4. Start xampp (Apache and MySQL)
6. Go to http://localhost/phpmyadmin/ and create a database called ```sppc```
    - you can use any name actually, but change the database name in sambungan.php if you want to use another name
7. Go to http://localhost/SPPC/login.php 
    - if you didn't do the optional step, use this instead http://localhost/SPPC-main/SPPC-main/login.php

## Components
### Database Tables (automatically created)
- urusetia
- hakim
- peserta
- scores
- matches

### Pages
- login.php
- info.php
- urusetia.php
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
1. alerts /
2. export /
3. import /
4. simplify
