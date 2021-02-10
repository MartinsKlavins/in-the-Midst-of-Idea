<?php
        // check if the GET variable exists
        if (isset($_GET['shutdown'])){
                shutdownSERVER();
        }
        // check if the POST variable exists
        if (isset($_POST['dataForLED'])){
                MOUDP();
        }
	// koda parskatamibai
	include 'quasiRDM.php';
	include 'blink.php';

        function shutdownSERVER(){
                system('sudo shutdown now');
        }
        function MOUDP(){

                $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

		$RPIaddr = explode('.', $_SERVER['SERVER_ADDR']);	// $_SERVER['SERVER_ADDR'] -> servera IP uz kura shis skripts strada, explode() -> sadala string in char array
		$target = $RPIaddr[0]. '.';
		$target .= $RPIaddr[1]. '.';
		$target .= $RPIaddr[2]. '.';
		$target .= $_POST["IP"];				// izveidoju target IP no pirmajiem 3 array elementiem + lietotaja ievaditais 
									// JEB - pirmie 3 ir fiksetie IP octet, bet 4 octet ir lietotaja izveletais
                $uni = $_POST["junivers"];
		if ( $uni > 255 ){ $uniPT1 = 255; $uniPT2 = $uni - 255; }
		else{ $uniPT1 = $uni; $uniPT2 = 0; }
		if ( !$uni ){ $uniPT1 = 0; $uniPT2 = 0; }
                $addr = $_POST["adrese"];
                if ( $addr > 255 ){ $addrPT1 = 255; $addrPT2 = $addr - 255; }
                else{ $addrPT1 = $addr; $addrPT2 = 0; }
		if ( !$addr ){ $addrPT1 = 0; $addrPT2 = 0; }
                $mode = $_POST["mode"];
		if ( !$mode ){ $mode = 3; }
		$wifi = $_POST["wifioff"];
		if ( !$wifi ){ $wifi = 0; }

                $quaziRDM = "MO". chr($uniPT1). chr($uniPT2). chr($addrPT1). chr($addrPT2). chr($mode). chr($wifi);
                $len = strlen($quaziRDM);

                socket_sendto($socket, $quaziRDM, $len, 0, $target, 6470);
                socket_close($socket);

	}

?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
<style>

table {
        border-collapse: collapse;
}
td, th {
        border: 0px solid;
}

ul {
        list-style-type: none;
        margin: 1;
        padding: 0;
        overflow: hidden;
        border: 2px solid blue;
        cursor: pointer;
}

li {
	float: left;
}

li a {
        display: block;
        color: red;
        padding: 14px 16px;
        text-decoration: none;
}

li a:hover {
        background-color: #111;
        font-size: 22px;
}

hr {
	border-color: tomato;
	border-style: solid;
}

</style>
</head>

<body  style="background-image:url('bildes/DSC_1064.JPG'); background-size: 100%; background-repeat: repeat-y;">


<fieldset style="border: 2px solid blue">

<legend align="center">
<table align="center">
        <tr><th>
        <font color="red" style="bold; font-size:4vw"><em> WIRELESS LED </em></font>
        </th></tr>
        <tr><th align="right">
        <font color="red" style="font-size:4vw"><em>  Web Server </em></font>
        </th></tr>
</table>
</legend>


</fieldset>

<fieldset style="border: 2px solid blue">
<legend><font color="tomato"><b> quasi-RDM </b></font></legend>

<form action="/index.php" method="POST" autocomplete="off">

<table width="100%">
	<tr>
	<td align="left" width="1%"> <input type="submit" name="discover" value="discovery" size="8" title="discover all online devices"> </td>
	<td align="left"> <textarea rows="1" style="width:100%">
	<?php include 'echo.php'; ?>
	</textarea></td>
	</tr>
	<tr>
	</tr>
</table>
<hr>

<table align="center" bgcolor="#0099ff"><font style="bold; font-size:5">
        <tr>
	<td align="right"> IP address&emsp;
		<?php	$octet = explode('.', $_SERVER['SERVER_ADDR']);
			echo $octet[0]. ".". $octet[1]. ".". $octet[2]. ".";
		?>
	</td>
	<td align="left">
	<input type="text" name="IP" size="1" title="last octet of LED's IP address you gonna speak with">
	<input type="submit" name="blink" value=&#10036; size="1" title="light up device">
	</td>
        </tr>
	<tr>
	<td align="right"> UNIVERSE </td>
	<td align="left"> <input type="text" name="junivers" size="8"></td>
	</tr>
	<tr>
        <td align="right"> ADDRESS </td>
	<td align="left"> <input type="text" name="adrese" size="8"></td>
	</tr>
	<tr>
	<td align="right"> MODE </td>
	<td align="left"> <input type="text" name="mode" size="8" title="3 or 10 channel modes available"></td>
	</tr>
	<tr>
        <td align="right"> <i><small> turn off WiFi! </small></i></td>
        <td align="left"> <input type="radio" name="wifioff" value="251" title="turn off WiFi for static use (saves battery power)"></td>
        </tr>
	<tr>
	<td></td>
	<td align="left"> <input type="submit" name="dataForLED" value="Submit" size="8" title="run quazi-RDM"></td>
	</tr>
</font></table>

<hr>

<table align="right">
	<tr>
	<td align="right"> <input type="text" name="increment" size="1" title="enter 0, 3 or 10 for address increment"> </td>
	<td align="left"> <input type="submit" name="autoPATCH" value="auto-PATCH" size="8" title="run auto-setup mode"> </td>
	</tr>
</table></form>

</fieldset>

<ul style="font-size: 21px; bold">
        <li><a href="/lapas/devices.html"> WIRELESS DEVICES </a></li>
        <li style="float: right"><a href="?shutdown" title="Veciit! Seriously this gonna shutdown this shit"> SHUTDOWN </a></li>
</ul>



<font color="tomato">
<fieldset style="border: 2px solid blue">
<legend> &copy; MARTINS KLAVINS 2018 </legend>

<table><tr>
        <th align="left">
        &emsp; Webserver is on network: </br>
        &emsp; * ssid =  </br>
        &emsp; * pass =   </br>
        &emsp; * IP = <?php echo $_SERVER['SERVER_ADDR']; ?> </br>
        </th>
</tr></table>

</fieldset>
</font>

</body>
</html>
