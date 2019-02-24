echo off
mysqldump -hlocalhost -uroot -proot bd > copia_seguridad_%Date:~6,4%%Date:~3,2%%Date:~0,2%_.sql
exit