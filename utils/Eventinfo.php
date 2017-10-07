<?php 
require_once("Event.php");
?>
<html>
<head></head>
<title>Event Info</title>
<style>

.box{
	border-radius:  20px;
 width: 600px;
 height: 300px;
    border: 10px solid #cdd8e5;
   margin-top: 170px;
  overflow: hidden;
    margin-left: 15%;
    background-color:#f2f2f2;
   
    box-shadow: 4px 4px 4px #000000;

}
.box:hover input[type=image]{
	opacity: 1;
}
#img{
	display:inline;
	position: relative;
	float:right;
	margin-bottom: 100%;
	right:0;
	overflow: hidden;
	color: white;
    text-shadow: 3px 3px 4px #000000;
}

input[type=image]{
	float:right;
	margin-bottom: 0%;
	display: inline=;
	overflow: hidden;
  border-radius: 15px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 5px;
  padding:5px;
  width: 30px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  opacity: 0;
}

input[type=image]:hover {
	background-color: #3e8e41;
	}

input[type=image]:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
span{
	margin-top: 20%;
	padding-left: 20px;
	color: red;
	display:inline;
	float;left;
	position: relative;
	color: white;
    text-shadow: 2px 2px 4px #000000;
}
</style>
<body>

<div class="box">
<h1>
<?php 
	//$id = $_GET['id'];
	$id = "Event"; //Asumin te id 
	$events = new Event;
	$Ename = $events->getEventName($id);
	$Etagline = $events->getEventTagline($id);
	$Eimage = $events->getEventImage($id);
	echo "<span id='text'>".$Ename." </span>
	<span id='text2'><br /><br />".$Etagline."</span><label id='img'>$Eimage</label>
	<form action='' method='POST'><br/><br/><br/>
	<input type='image' src='edit.png' name='Edit'>
	<input type='image' src='delete.png' name='Delete'></form>";
	?>
</div>


</body>
</html>