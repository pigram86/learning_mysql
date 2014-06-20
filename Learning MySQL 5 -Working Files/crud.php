<?php
/**
 * INSERT
 */

$db = new mysqli('localhost', 'websakila', 'secret', 'sakila');

$country = 'Plutostan';

$stmt = $db->prepare("insert into country (country) values (?)");

$stmt->bind_param('s', $country);

$stmt->execute();


/**
 * UPDATE
 */

$db = new mysqli('localhost', 'websakila', 'secret', 'sakila');

$oldCountry = 'Plutostan';
$newCountry = 'Venusstan';

$stmt = $db->prepare("UPDATE country SET country = ? WHERE country = ?");

$stmt->bind_param('ss', $newCountry, $oldCountry);

$stmt->execute();

/**
 * DELETE
 */

$db = new mysqli('localhost', 'websakila', 'secret', 'sakila');

$country = 'Venusstan';

$stmt = $db->prepare("DELETE FROM country WHERE country = ?");

$stmt->bind_param('s', $country);

$stmt->execute();