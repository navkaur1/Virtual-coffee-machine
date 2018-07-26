<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title> Virtual Coffee Machine</title>
<style>

h2{
	color: rgb(9, 55, 130);
    text-shadow: 3px 3px white;
}
</style>
</head>
<body>
<table align="center" bgcolor="#dbfdff">
<tr><td>
<form action="vcm.php" method="post">
<h2> VIRTUAL COFFEE MACHINE </h2>
Please select coin of 1,2,5,10,20,50 cent or 1, 2 dollar and desposit<br><br>
<table cellpadding="10" border="1">
<tr>
<td><label><input type="radio" name="coin" value="0">1 Cent</label></td>
<td><label><input type="radio" name="coin" value="0">2 Cents</label></td>
</tr><tr>
<td><label><input type="radio" name="coin" value="0.05">5 Cents</label></td>
<td><label><input type="radio" name="coin" value="0.10">10 Cents</label></td>
</tr><tr>
<td><label><input type="radio" name="coin" value="0.20">20 Cents</label></td>
<td><label><input type="radio" name="coin" value="0.50">50 Cents</label></td>
</tr><tr>
<td><label><input type="radio" name="coin" value="1">1 Dollar</label></td>
<td><label><input type="radio" name="coin" value="2">2 Dollars</label></td>
</tr><tr>
<td colspan="2"><input type="submit" name="submit" value="Deposit coin"/>&nbsp;&nbsp;&nbsp;
<input type="submit" name="unset" value="Restart" /></td>
</tr>
</table>
</form>

<?php
if(!isset($_SESSION["total"])){
    $_SESSION["total"] = 0;
}
if(isset($_POST['submit'])){
	if(isset($_POST['coin'])){ // value is selected and "deposit coin" button is clicked.`
		if($_POST['coin']==0)
		{
			echo " <font color=red>Sorry, coin rejected.</font><br>";
		}
	$_SESSION["credit"] = $_POST['coin'];  // Storing Selected Value In Variable
	$_SESSION["total"]= $_SESSION["total"]+$_SESSION["credit"];
	echo "You have desposited : " .$_SESSION["credit"]." dollar(s)<br>";  // Displaying Selected Value
	echo "<font color=green> Total available funds : " .$_SESSION["total"]." dollar(s)</font>"; // displaying the total value;
	}
	
	else{
		echo "<font color=red>Please select one value to deposit coin.</font>"; // message when "Despoit coin" button is clicked without selected any radio button.
		echo "<br><font color=green> Total available funds : " .$_SESSION["total"]." dollar(s)</font>";
	}
}


if(isset($_POST['unset'])){
	 session_destroy(); 
}
?>

<br><br>
<form action="vcm.php" method="post">
<h3> Coffee Options: </h3>
Please select one <br><br>
<label><input type="radio" name="coffee" value="1"> $3.50 Cappuccino</label>
<label><input type="radio" name="coffee" value="2"> $3.00 Latte</label>
<label><input type="radio" name="coffee" value="3"> $4.00 Decaf</label>
<br><br>
<input type="submit" name="dispense" value="Dispense Coffee"/>
<input type="submit" name="ch" value="Collect Change"/>
</form>

<?php
if(isset($_POST['dispense'])){
	echo "<br>Your total amount : " .$_SESSION["total"]." dollar(s) <br>";
	if(isset($_POST['coffee'])){ //check if one of the options is selceted from coffee option
		
			// for cappuccino
		if($_POST["coffee"]==1){ // cappuccino is selected
							
							
						
							if($_SESSION["total"]>=3.50) // check enough money for cappuccino $3.50
							{
							$_SESSION["change"]= $_SESSION["total"]-3.50;
							$_SESSION["total"]=$_SESSION["change"];
							echo "<font color=green>Your Cappuccino is ready. Thank You.</font><br>";
							echo "Total amount left:".$_SESSION["total"];
							}
							else{
								echo" <font color=red>Sorry insufficient funds for Cappuccino. Please deposit more.</font>";
							}
		}
							
						// for Latte
		if($_POST["coffee"]==2){
						if($_SESSION["total"]>=3.00) // check enough money for latte $3.00
							{
							$_SESSION["change"]= $_SESSION["total"]-3.00;
							$_SESSION["total"]=$_SESSION["change"];
							echo "<font color=green>Your Latte is ready. Thank You.</font><br>";
							echo "Total amount left:".$_SESSION["total"];
							}
							else{
								echo"<font color=red>Sorry insufficient funds for Latte. Please deposit more.</font>";
							}
							
		}
							// for Decaf
				if($_POST["coffee"]==3){
							if($_SESSION["total"]>=4.00) // check enough money for Decaf $4.00
							{
							$_SESSION["change"]= $_SESSION["total"]-4.00;
							$_SESSION["total"]=$_SESSION["change"];
							echo "<font color=green>Your Decaf is ready. Thank You.</font><br>";
							echo "Total amount left:".$_SESSION["total"];
							}
							else{
								echo"<font color=red>Sorry insufficient funds for Decaf. Please deposit more.</font>";
							}
				}
						
									
		
		
		
		}
		else{
			echo "<font color=red>Please Select one coffee and then click dispense button</font>";
			}
	
}

//for collecting change
if(isset($_POST['ch'])){ 
			echo "<br><font color=green>Total change given: $".$_SESSION["total"];
			echo "<br><br><font color=green>Coinage breakdown:<br> ";
			if($_SESSION["total"]==0)
			{
				echo"No change.";
			}
			while($_SESSION["total"]>=2.00){
				$_SESSION["total"] = round($_SESSION["total"]-2.00,2); 
				echo"$2 <br>";
			}
			while($_SESSION["total"]>=1.00){
				$_SESSION["total"]=round($_SESSION["total"]-1.00,2);
				echo"$1<br> ";
			}
			while($_SESSION["total"]>=0.50){
				$_SESSION["total"] = round($_SESSION["total"]-0.50,2); 
				echo"50c <br>";
			}
			while($_SESSION["total"]>=0.20)
			{
				$_SESSION["total"] = round($_SESSION["total"]-0.20,2);
				echo"20c <br>";
			}
			while($_SESSION["total"]>=0.10){
				$_SESSION["total"] = round($_SESSION["total"]-0.10,2); 
				echo"10c <br>";
			}
			while($_SESSION["total"]>=0.05){
				$_SESSION["total"] = round($_SESSION["total"]-0.05,2); 
				echo"5c <br>";
			}
			
}


?>

</td></tr>
</table>
</body>
</html>