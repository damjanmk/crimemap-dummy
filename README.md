crimemap-dummy
==============

dummy of crimemap.finki.ukim.mk

This version contains the part of the project that manipulates and displays data from a database, 
as well as the part that crawls the website of the police for data and then does some simple nlp to structure it into the database.
To call the crawler execute the script in crimemap-dummy/crawler/crawl.php.

localhost/crimemap-dummy shows the ui.
localhost/crimemap-dummy/administrator the administration section.
You can login as an administrator with 

Username: dummy

Password: dummy

Please, feel free to get a copy of the code and use and change it locally. After you make some very cool new features and improvements we could merge our branches and I will update the 'production site' (the one on the actual web server. 
In order to be able to use the code on your machine you will have to go through a few steps:

I)
===Install local server, mysql and php===

On Windows it is simple to do by installing xampp. 
It has apache, mysql and php packaged together.
On Linux you can install Lampp or xampp for linux, or alternatively install all the parts separately. 

II)
===Importing a mysqldump with all the data and structure===

Create a table called crimemap.finki in mysql and import a dump file from the folder /mysql-dumps.
You can get all the data from the events table from the website (http://crimemap.finki.ukim.mk/view/data.php?a=0&l=en) in xml or sql format.
You can also run the crawler and generate new data locally yourself.

III)
===Getting an API key for Google Maps===

You need to create your own api key for using google maps. You can do this easily by following instructions here:

https://developers.google.com/maps/documentation/javascript/tutorial#api_key

Then replace the "YOUR_API_KEY" on line 7 in crimemap-dummy/view/crime_map.php with your api key.

Thank you,
Damjan