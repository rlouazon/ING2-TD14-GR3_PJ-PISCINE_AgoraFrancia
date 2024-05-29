<?php

if(isset($_GET["redir"]) && $success == 1){
    if($_GET["redir"] != ""){
        echo $_GET["redir"];
        echo "<script>setTimeout(() => window.location.replace(\"".base64_decode($_GET["redir"])."\"), ".$delay.");</script>";
    }
}

?>