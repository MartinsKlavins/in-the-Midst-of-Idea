<?php
        // check if the POST variable exists
        if (isset($_POST['blink'])){
                MOfind();
        }

        function MOfind(){

                $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

                $RPIaddr = explode('.', $_SERVER['SERVER_ADDR']);
                $target = $RPIaddr[0]. '.';
                $target .= $RPIaddr[1]. '.';
                $target .= $RPIaddr[2]. '.';
                $target .= $_POST["IP"];

                $quaziRDM = "find";
                $len = strlen($quaziRDM);

                socket_sendto($socket, $quaziRDM, $len, 0, $target, 6470);
                socket_close($socket);

        }
?>
