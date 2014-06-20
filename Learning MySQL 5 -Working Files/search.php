<style type="text/css">
#films {
  border-collapse: collapse;
  width: 600px;
}

#films th {
  text-align: left;
}

</style>

<form method="get" action="search.php">
<label for="keyword">Film Title</label><br />
<input type="text" name="keyword" value="" /><br />
<input type="submit" name="submit" value="Search" />
</form>

<?php

require_once 'HTML/Table.php';

if (isset($_GET['keyword'])) {
	
	$db = new mysqli('localhost', 'websakila', 'secret', 'sakila');
	
	if ($db->connect_error) {
		die('Could not connect to MySQL');
	}
		
	// Prepare the statement
	$stmt = $db->prepare("SELECT film_id, title, rental_rate, rating
	                     FROM film WHERE title LIKE ?");
	
	// Wrap the search term in % signs
	$keyword = "%" . $_GET['keyword'] . "%";
	
	// Bind an input parameter
	$stmt->bind_param('s', $keyword);
	
	// Execute the statement
	$stmt->execute();
	
	// Bind results to variables
  	$stmt->bind_result($filmID, $title, $rentalRate, $rating); 
  	
  	// Transfers result set
  	$stmt->store_result();
  	
  	// Iterate over the results, if any
	if ($stmt->num_rows > 0) {
  	
		$table = new HTML_Table(array('id' => 'films'));
		
		$table->setHeaderContents(0, 0, 'ID');
		$table->setHeaderContents(0, 1, 'Title');
		$table->setHeaderContents(0, 2, 'Rental Cost');
		$table->setHeaderContents(0, 3, 'Rating');
		
		while ($stmt->fetch())
		{
			$table->addRow(array($filmID, $title, $rentalRate, $rating));
		}
		
		$altRow = array('bgcolor' => '#CCC');
		$table->altRowAttributes(1, null, $altRow);
		echo $table->toHtml();
	
	} else {
		echo "No results found";
	}
	
	$stmt->close();
	
}

