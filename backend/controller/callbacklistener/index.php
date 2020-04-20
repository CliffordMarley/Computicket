<?php
    header("Access-Control-Allow-Origin: *");
    
    $xml = "<?xml version='1.0' encoding='utf-8'?>
            <API3G>
              <Response>OK</Response>
            </API3G>";
    //$xml = simplexml_load_string($xml);
    echo $xml;
?>