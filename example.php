<?php
    require_once('curl.class.php');
    
    $myinit = new curl();
    $myinit->setUrl("https://detik.com");
    $myinit->setRef("http://googl.com");
    $myinit->setFollow();
    $myinit->setTransfer();
    $myinit->setHeader();
    $myinit->buildOpt();
    $myinit->setHeaderOrigin("http://detik.com");
    $myinit->buildHeader();
    $myinit->exec();
    $header = $myinit->getHeaderResponse();
    $body = $myinit->getBodyResponse();

    print_r($header);
    print_r($body);
?>
