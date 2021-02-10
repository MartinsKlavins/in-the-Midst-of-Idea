<?php

	if (isset($_POST['autoPATCH'])){

                $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

		$IPstart = $_POST["IP"];
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
		$pieaugums = $_POST["increment"];
		if ( !$pieaugums ){ $pieaugums = 0; }



		for ( $IPstart; $IPstart <= 255; $IPstart++ ){

			$RPIaddr = explode('.', $_SERVER['SERVER_ADDR']);
                	$target = $RPIaddr[0]. '.';
                	$target .= $RPIaddr[1]. '.';
                	$target .= $RPIaddr[2]. '.';
                	$target .= strval($IPstart);

			$quaziRDM = "MO". chr($uniPT1). chr($uniPT2). chr($addrPT1). chr($addrPT2). chr($mode). chr($wifi);
                	$len = strlen($quaziRDM);
			socket_sendto($socket, $quaziRDM, $len, 0, $target, 6470);

			$addr = $addr + $pieaugums;
                	if ( $addr > 255 ){ $addrPT1 = 255; $addrPT2 = $addr - 255; }
                	else{ $addrPT1 = $addr; $addrPT2 = 0; }

		}

		socket_close($socket);

	}

?>

