# A little php calendar application (hungarian)

My first app. Works with or without database (data store in sessions)

## Status

This project made for practice and learning purpose

## Screenshots

<img src='http://www.tesztelek.webtelek.hu/pics/calendar1.jpg' width='300'>
<img src='http://www.tesztelek.webtelek.hu/pics/calendar2.jpg' width='300'>
<img src='http://www.tesztelek.webtelek.hu/pics/calendar3.jpg' width='300'>

## Example

http://www.tesztelek.webtelek.hu/index.php

## Features

* You can add a new event any day
* It shows the numbers of events
* The events load with AJAX request and JSON

## Usage

* intialize.php - start the seassion, load the database, calendar, user and other functions 
* connection.php - file store the login dates for the database
* If the function contain a database query, then there is another function with NoDb title in the name, this function store the data in sessions

## Install

If you want to try, just clone this reposit
```
git clone git://github.com/m-hegyi/Calendar.git
```
