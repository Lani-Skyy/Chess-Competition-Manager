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

### Pages
- login.php
- info.php
- urusetia.php
- hakim.php
- peserta.php
- pusingan.php
- keputusan.php