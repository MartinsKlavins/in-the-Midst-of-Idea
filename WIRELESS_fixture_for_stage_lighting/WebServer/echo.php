<?php

if (isset($_POST['discover'])){

	$socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
	$discovery = "echo";
	$lenght = strlen($discovery);

	$online = fopen("./onlineLED.bin", "w") or die("nevar atvert onlineLED.bin");


	for ( $IP = 0; $IP <= 255; $IP++ ){
		$RPIaddr = explode('.', $_SERVER['SERVER_ADDR']);
		$target = $RPIaddr[0]. '.';
		$target .= $RPIaddr[1]. '.';
        	$target .= $RPIaddr[2]. '.';
        	$target .= strval($IP);

		socket_sendto($socket, $discovery, $lenght, 0, $target, 6470);
		$atbilde = socket_recv($socket, $data, 1, MSG_DONTWAIT);
		if ( $atbilde != 0 ){
			fwrite($online, $data);
		}
	}

	fclose($online);

	$online = fopen("./onlineLED.bin", "rb") or die("nevar atvert onlineLED.bin");
	$buf = filesize("./onlineLED.bin");
        $liste = fread($online, $buf);
        $byte_array = unpack('C*', $liste);

        echo $buf. " devices found \t";
        $subnet = explode('.', $_SERVER['SERVER_ADDR']);
        echo "IP address list >> ". $subnet[0]. ".". $subnet[1]. ".". $subnet[2]. ".". "[ ";
        while( $buf > 0 ){
                echo $byte_array[$buf]. " ";
                $buf--;
        }
        echo " ]";

	fclose($online);
	socket_close($socket);

}

?>
