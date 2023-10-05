<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $xml = simplexml_load_file("data.xml") or die("Error: Cannot create object");
    $id = $_GET['id'];
    $i = 0;
    foreach ($xml->item as $item) {
        if ($item['id'] == $id) {
            unset($xml->item[$i]);
            
            break;
        }

        $i++;
    }
    
    $xml->saveXML('data.xml');
}

header("Location: http://localhost/lab/list.php", TRUE, 301);
exit( );