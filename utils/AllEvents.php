<html>
<style>
table {
	margin-top: 10%;
	margin-left: 8%;
    border-collapse: collapse;
    width: 80%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #4CAF50;
    color: white;
}
a {
	opacity: 0;
	color: black;
}
tr:hover  a{background-color: #f5f5f5;
opacity: 1;}

</style>
</html>
<?php 
require_once("Event.php");
$event = new Event;

$events = $event->getEvents();

if(isset($_GET['id']))
{
	echo " t";
}

$table = "<table>";

$table = $table."<tr>";
$table = $table."<th>SNo</th>";
$table = $table."<th>Event Name</th>";
$table = $table."<th>Event Tagline</th>";
$table = $table."<th>Event Image</th>";
$table = $table."<th colspan='3' id='act'>Actions</th>";
$table = $table."</tr>";

foreach ($events as $key => $event) {
    $table = $table."<tr>";
    $table = $table."<td>".($key+1)."</td>";
    $table = $table."<td>".substr($event['eventName'],0,15)."</td>";
    $table = $table."<td>".substr($event['eventTagline'],0,15)."</td>";
    $table = $table."<td>".$event['eventImage']."</td>";
  	 $table = $table."<td><a href = 'view.php?id=".$event['eventId']."'>View</a></td>";
    $table = $table."<td><a href = 'edit.php?id=".$event['eventId']."'>Edit</a></td>";
    $table = $table."<td><a href = 'index.php?id=".$event['eventId']."'>Delete</a></td>"; 
    $table = $table."</tr>";
}

$table = $table."</table>";
echo $table;

?>