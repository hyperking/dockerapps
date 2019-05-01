<?php

# Script 9 - data.php
# Created April 25, 2019
# Created by Devon Kostos
# This script retrieves data with
# a query from the city_stats table
# in the weatherstats MySQL database
# and displays the data in a multi page
# html table, which is sortable by
# column names that correspond to
# the fields within the database.

$page_title = 'Climate Data For All Cities';

// declare table header and database column constants
define ('CITY', '<b> City </b>');
define ('STATE', '<b> State </b>');
define ('HIGH', '<b> High </b>');
define ('LOW', '<b> Low </b>');
define ('DAYS_CLEAR', '<b> Days Clear </b>');
define ('DAYS_CLOUDY', '<b> Days Cloudy </b>');
define ('DAYS_PRECIP', '<b> Days With Precip </b>');
define ('DAYS_SNOW', '<b> Days With Snow </b>');
define ('DB_CITY', 'city');
define ('DB_STATE', 'state');
define ('DB_HIGH', 'record_high');
define ('DB_LOW', 'record_low');
define ('DB_CLEAR', 'days_clear');
define ('DB_CLOUDY', 'days_cloudy');
define ('DB_PRECIP', 'days_with_precip');
define ('DB_SNOW', 'days_with_snow');

include ('includes/header.html');
echo "<h1> $page_title </h1>";

require ('mysqli_connect.php'); // Connect to the db.
$display = 15; // Number of records to show per page:

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$query = "SELECT COUNT(city) FROM city_stats";
	$result = @mysqli_query ($dbc, $query);
	$row = @mysqli_fetch_array ($result, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Determine the sort and order...
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'city'; // Default is by city name.
$order_by = (isset($_GET['order_by'])) ? $_GET['order_by'] : 'city ASC'; // Default is by city name ASC.

// Determine the sorting order:
switch ($sort) {
	case 'state':
		$order_by = 'state ASC';
		break;
	case 'record_high':
		$order_by = 'record_high ASC';
		break;
	case 'record_low':
		$order_by = 'record_low ASC';
		break;
	case 'days_clear':
		$order_by = 'days_clear ASC';
		break;
	case 'days_cloudy':
		$order_by = 'days_cloudy ASC';
		break;
	case 'days_with_precip':
		$order_by = 'days_with_precip ASC';
		break;
	case 'days_with_snow':
		$order_by = 'days_with_snow ASC';
		break;
	default:
		$order_by = 'city ASC';
		$sort = 'city';
		break;
}

// Define the query
$query = "SELECT * FROM city_stats ORDER BY $order_by LIMIT $start, $display";
$result = @mysqli_query ($dbc, $query); // Run the query.

// Table header.
echo '<table class="table" cellspacing="3" cellpadding="3">
		 		<tr>
					<td><a href="data.php?sort=city">', CITY, '</a></td>
				 	<td><a href="data.php?sort=state">', STATE, '</a></td>
				 	<td align="right"><a href="data.php?sort=record_high">', HIGH, '</a></td>
				 	<td align="right"><a href="data.php?sort=record_low">', LOW, '</a></td>
				 	<td align="right"><a href="data.php?sort=days_clear">', DAYS_CLEAR, '</a></td>
				 	<td align="right"><a href="data.php?sort=days_cloudy">', DAYS_CLOUDY, '</a></td>
				 	<td align="right"><a href="data.php?sort=days_with_precip">', DAYS_PRECIP, '</a></td>
				 	<td align="right"><a href="data.php?sort=days_with_snow">', DAYS_SNOW, '</a></td>
			 	</tr>';

// Fetch and print all the records:
$bg = '#eeeeee';
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
  echo '<tr bgcolor="' . $bg . '">
					<td>' . $row[DB_CITY] . '</td>
				 	<td>' . $row[DB_STATE] . '</td>
				 	<td align="right">' . $row[DB_HIGH] . '</td>
				 	<td align="right">' . $row[DB_LOW] . '</td>
				 	<td align="right">' . $row[DB_CLEAR] . '</td>
				 	<td align="right">' . $row[DB_CLOUDY] . '</td>
				 	<td align="right">' . $row[DB_PRECIP] . '</td>
				 	<td align="right">' . $row[DB_SNOW] . '</td>
			 	</tr>';
} // End of WHILE loop

echo '</table>'; // Close the table.
mysqli_free_result ($result); // Free up the resources.
mysqli_close($dbc); // Close the database connection.

// Make the links to other pages, if necessary.
if ($pages > 1) {

	echo '<br /><p class="p">';
	$current_page = ($start/$display) + 1;

	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="data.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}

	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="data.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.

	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="data.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	}

	echo '</p>'; // Close the paragraph.

} // End of links section.

include ('includes/footer.html');
?>
