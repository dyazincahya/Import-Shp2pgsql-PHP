# Import-Shp2pgsql-PHP
Import Shp File dengan PHP

### Keterangan
exec('"C:\Program Files (x86)\PostgreSQL\9.3\bin\shp2pgsql" -s 4236 '.$filename_new.' test90 | "C:\Program Files (x86)\PostgreSQL\9.3\bin\psql" -U postgres -d coba_shp');
- C:\Program Files (x86)\PostgreSQL\9.3\bin\shp2pgsql , di bagian ini anda bisa sesuaikan sendiri, arahkan ke aplikasi shp2pgsql, misalkan anda menginstall postgre di drive D, maka arahkan direktori-nya, ikuti contoh di atas.
- -s berfungsi untuk mengatur srid, default srid adalah 4236.
- $filename_new merupakan variabel yang berisi directori sekaligus nama file.
- test90 merupakan nama tabel yang akan di buat, jadi pada saat melakukan import, dengan perintah di atas akan sekaligus membuatkan tabel dan field secara otomatis.
- C:\Program Files (x86)\PostgreSQL\9.3\bin\psql , sama seperti penjelasan sebelumnya, anda hanya cukup mengarahkan direktori dimana aplikasi psql berada.
- -U berfungsi untuk mengatur username postgre.
- -d berfungsi untuk mengarahkan ke database mana file shp ini akan di import. pada contoh saya mengahkannya ke database "coba_shp".
 
### Panduan Lengkap
Panduan ini berisi perintah command line yang tersedia di postgist.
[BACA](https://github.com/dyazincahya/Import-Shp2pgsql-PHP/blob/master/Shp2pgsql%20Quick%20Guide.pdf)

