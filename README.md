Per configurare il server:

1. Installare xampp
2. Inserire la cartella del progetto in C:\xampp\htdocs

3. Aprire C:/xampp/php/php.ini
4. Togliere il punto e virgola ";" all'inizio della riga 
	extension=pgsql
5. Salvare il file 

6. Aprire C:\xampp\apache\conf\httpd.conf
7. Inserire la stringa "C:/Program Files/PostgreSQL/13/bin/libpq.dll" in base all'istallazione di postgres
	(di solito basta cambiare la versione se la cartella di installazione è quella di default)
8. Salvare il file 

9. Avviare xampp e inserire nel browser l'indirizzo http://localhost/se/src/views/
