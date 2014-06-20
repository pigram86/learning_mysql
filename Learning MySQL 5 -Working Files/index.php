<?php

$db = new mysqli('localhost', 'websakila', 'secret', 'sakila');

if ($db->connect_error) {
	die('Could not connect to MySQL');
}