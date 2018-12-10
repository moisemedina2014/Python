<?php
echo "<link href='program07.css' rel='stylesheet' type='text/css' />";
echo'<script type="text/javascript" src="program07.js">
	</script>';
session_start();

@$db =  new mysqli("localhost","root","");
$db->select_db ("test");
@$username = '123456';//substr($_SERVER['AUTH_USER'] , 11 );

$order = $db->query("SELECT * FROM choices");
$order_id = $order->fetch_assoc();

@$product_id = $_GET['product_id'];

for ($i=1; $i <= $order->num_rows ; $i++) 
{ 
	if ($username == $order_id['username'])
	{
		$username = $order_id['username'];
	}
	else
	{
		$name = $username;
		$order_id = $order->fetch_assoc();
	}		
}
		$order->free();
$expire = time() + 60*60*24*7;		
if (isset($_GET['product_id'])) 
{
	echo " insert happen";
	
	insert_row($db,$name,$product_id,$username);

	//$expire = time() + 60;
	create_session_cookie($username,$expire);
}
else
{
	$orders = $db->query("SELECT * FROM survey WHERE name = $username");
	//$order_ids = $orders->fetch_assoc();

	$product_id = $order_ids['id'];
}

//unset($_SESSION['user']);

is_session_cookie_set($username,$expire,$db,$product_id);

function is_session_cookie_set($username,$expire,$db,$product_id)
{
	if( isset($_SESSION["user"]))
	{
		echo"<h1> The game you like best is </h1>";
		display_survey_results($db,$username,$product_id);

	}
	else
	{
		echo"<h1> Which of those game you like best </h1>";
		print_table($username,$db);
	}
}
function create_session_cookie($username,$expire)
{

		setcookie("user"," ".$username , $expire);
		$_SESSION['user'] = $username;
}
function print_table($username,$db)
{
	$data_set = $db->query("SELECT * FROM choices");
	echo "<table>";
	$count = 1;
	$nextline = 8;
	echo "<tr>";
	for ($product_list = 1; $product_list <= $data_set->num_rows; $product_list++)
	{ 	
		$data =  $data_set-> fetch_assoc();

		echo "<td> <p class = 'program_ptags'>";
		echo $data["username"]."<br/>";
		echo $data["year"]."<br/>";
		echo '<img src = '.$data["pictures"].' alt='.$data["username"];
		echo "<br/>$".$data["price"];
		echo "</p>";
		echo'<input type = "radio" name = "pidname" id = "send" onclick="choice('.$data["id"].')" value = "'.$data["id"].'"/>';

		if($product_list == $nextline)
		{
			$nextline += 8;
			echo "</tr>";
		}
	}
	echo "</table>";
}

function insert_row($db,$name,$product_id,$username)
{
	$max_order_id = $db->query("SELECT  MAX(Sid) as id FROM survey");	 
	$current_max_order_id = $max_order_id->fetch_assoc();

	$mydelete = $db->prepare("DELETE FROM survey WHERE name = ?");
	$mydelete->bind_param('s', $username);
	$mydelete->execute();
	
	$greatest_order_id = $current_max_order_id['id']+1;
	$statement = $db->prepare("INSERT INTO survey(id,name,Sid) values (?,?,?)");
	$statement->bind_param ('dsd',$product_id,$name,$greatest_order_id );
	$statement->execute();
}

function display_survey_results($db,$username,$product_id)
{
	echo ' <a href="http://csweb/CS368/Medina_Moise/index.html" id = "home" >home</a> ';
	$data_set = $db->query("SELECT * FROM choices WHERE id = $product_id ");
	$data = $data_set->fetch_assoc();

echo "<table id = 'description'>";
echo "<tr>";
echo '<td class = "pictures" >
	  <img src = '.$data["pictures"].' alt='.$data["username"].'
											height="150" width="86.367"></td>';
echo '	  <td class = "pictures" >
	  <img src = '.$data["pictures"].' alt='.$data["username"].'
											height="150" width="86.367"></td>';
echo "<td id =\"detail_3\" >";
echo "<p id = 'topline'>";
echo $data["username"];
echo '<br/>';
echo $data["year"];
echo "</p>";

echo '<img src = '.$data["pictures"].' alt='.$data["username"].' id = "midlepic"
													height="150" width="86.367">';

echo '<br/>';
echo "<p id = bottomline> $ ";
printf('%.2f',$data["price"]);
echo "</p></td>";
echo '<td class = "pictures" >
	 <img src = '.$data["pictures"].' alt='.$data["username"].'
												height="150" width="86.367"></td>
	 <td class = "pictures" >
	 <img src = '.$data["pictures"].' alt='.$data["username"].'
												height="150" width="86.367"></td>';
echo "</tr><tr><td class='synopsis' colspan = 5><p class='synopsis'>";
echo $data["description"];
echo "</p></td></tr>";
echo "</table>";

}
	
?>
