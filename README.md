# Animebase

Animebase is a a database application which utilizes statistics, production information, genres, and characters to recommend animes with user-desired traits. Animebase serves as the foundation for a valuable information source on studios, characters, cast & crew, source materials, and genres related to various anime. Animebase was created using Oracle for database management, and PHP as the application platform. This PHP and HTML-based platform provides a simple and easy-to-use interface for viewing and updating anime-related information in the database.

Besides answering search queries and updating existing database information, Animebase offers a variety of help. It recommends anime based on rating, genres, source materials, and user-preferred characters. Animebase uses a variety of accessible tools to facilitate user search, such as checkboxes (select any/all), drop-down menus, and buttons galore. Through the use of user-friendly tools on useful information to anime viewers, Animebase intends to provide you with the best database navigation experience. 

## Requirements
Access to an Oracle server is necessary to run Animebase. The following instructions are for use on the UBC server, with a student UBC account registered to use Oracle. 

## Installation and Usage
Follow instructions for running a PHP program with embedded SQL, by logging in with your CWL username and password to https://www.students.cs.ubc.ca/~cs-304/resources/php-oracle-resources/php-setup.html and following instructions to setup a public_html directory.

Download and transfer **anime-db-final.php** and **database.sql** to public_html, and set file permissions for anime-db-final.php as directed in the php setup site.

In the terminal, access SQLPlus by entering 
```console
name@user:~$ ora_username@stu
```
where the username refers to your CWL username, and input a[student_number] when prompted to enter your password. 
run the database with 
```console
SQL> start database.sql
```
inside the public_html directory. Animebase can then be accessed via
https://www.students.cs.ubc.ca/~username/anime-db.php
