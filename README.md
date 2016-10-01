crimemap-dummy
==============

step by step for local use
===

dummy of crimemap.finki.ukim.mk

This version contains the part of the project that manipulates and displays data from a database, 
as well as the part that crawls the website of the police for data and then does some simple nlp to structure it into the database.
To call the crawler execute the script in crimemap-dummy/crawler/crawl.php.

localhost/crimemap-dummy shows the ui.
localhost/crimemap-dummy/administrator the administration section.
You can login as an administrator with 

Username: dummy

Password: dummy

Please, feel free to get a copy of the code and use and change it locally. After you make some very cool new features and improvements we could merge our branches and I will update the 'production site' (the one on the actual web server). 
In order to be able to use the code on your machine you will have to go through a few steps:

## I) Install local server, mysql and php

On Windows install XAMPP. It has apache, mysql and php packaged together.
On Linux you can install XAMPP or LAMP.

## II) Importing a mysqldump with all the data and structure

Create a table called crimemap.finki in mysql and import a dump file from the folder /mysql-dumps.
You can get all the data from the events table from the website (http://crimemap.finki.ukim.mk/view/data.php?a=0&l=en) in xml or sql format.
You can also run the crawler and generate new data locally yourself.

## III) Getting an API key for Google Maps

You need to create your own api key for using google maps. You can do this easily by following instructions here:

https://developers.google.com/maps/documentation/javascript/tutorial#api_key

Then replace the "YOUR_API_KEY" on line 7 in crimemap-dummy/view/crime_map.php with your api key.


## More details for installing on Ubuntu
**This won't work with php7 becuase it is using the old mysql_* functions**

`git clone https://github.com/damjanmk/crimemap-dummy.git'`

`sudo apt-get install apache2`

to see it working check the ubuntu apache start page at http://localhost

`sudo apt-get install mysql-server`

it will ask for password 3 times

`sudo apt-get install php libapache2-mod-php php-mcrypt php-mysql`

`sudo gedit /var/www/html/info.php`

type

```
<?php
phpinfo();
?>
```

see php's configuration at http://localhost/info.php

```
sudo apt-get install phpmyadmin php-mbstring php-gettext
sudo phpenmod mcrypt
sudo phpenmod mbstring
sudo systemctl restart apache2
```

go to http://localhost/phpmyadmin

create a database called "crimemap.finki" (collation utf8_general_ci)

go to import


_
the max file size for importing by default is set to 2MB, to change this

sudo sudo gedit /etc/php/7.0/apache2/php.ini (or wherever the php.ini file to your php is)

change the values of memory_limit, post_max_size, and upload_max_filesize

so that they are more than upload_max_filesize is more than 2MB, but upload_max_filesize < post_max_size < memory_limit

`sudo systemctl restart apache2`
_


upload the "crimemap_nastani.sql" file that you can obtain from http://crimemap.finki.ukim.mk/model/mysqldump.php


install eclipse

install PHP Development Tools from Help->Eclipse Marketplace

create a new PHP project using the downloaded source

open crimemap-dummy/view/crime_map.php

change **YOUR_API_KEY** for your api key obtained at

https://developers.google.com/maps/documentation/javascript/tutorial#api_key


if your mysql username and password are different from root and ''

open crimemap_dummy/model/dbconfig.php and change the value returned by get_username() and get_password()


open /etc/apache2/apache2.conf

find this code and change the 'AllowOverride None' to 'AllowOverrite All'

```
<Directory /var/www/>
	Options Indexes FollowSymLinks
	AllowOverride All
	Require all granted
</Directory>
```


`sudo a2enmod rewrite`
`sudo systemctl restart apache2`




Thank you,
Damjan
