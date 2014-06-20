<style type="text/css">
#films {
  border-collapse: collapse;
  width: 600px;
}

#films th {
  text-align: left;
}

</style>

<?php

require_once 'HTML/Table.php';

$db = new mysqli('localhost', 'websakila', 'secret', 'sakila');

if ($db->connect_error) {
	die('Could not connect to MySQL');
}

$films = $db->query('SELECT film_id, title FROM film ORDER BY title limit 10');

$table = new HTML_Table(array('id' => 'films'));

$table->setHeaderContents(0, 0, 'ID');
$table->setHeaderContents(0, 1, 'Title');

while ($film = $films->fetch_object())
{
	$table->addRow(array($film->film_id, $film->title));
}
$altRow = array('bgcolor' => '#CCC');
$table->altRowAttributes(1, null, $altRow);
echo $table->toHtml();