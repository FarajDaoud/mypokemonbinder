<?php
header("Content-Type: application/json; charset=UTF-8");

$servername = '###########';
$dbname = '###########';
$dbuser = '###########';
$dbpass = '###########';

try {
    //set the variable $dbc for calling attr about the connection to the database.
    $dbc = new PDO("mysql:host=$servername;dbname=$dbname", $dbuser, $dbpass);
    $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "connected \r\n \r\n";
}
catch(PDOException $e) {
    echo "failed to connect with Server \r\n \r\n";
    echo "Error: " . $e->getMessage();
    die();
}


try{

$stmt = $dbc->prepare(
    "select 
    s.code
    ,s.name
    ,s.release_date
    from sets as s
    order by release_date asc"
    );

    //echo "array results: \r\n";
    if($stmt->execute()){ //replace with variable based on page
        $outp = '{"sets": [';
        while ($row = $stmt->fetch()) {
            //print_r($row);
            if ($outp != '{"sets": [') {$outp .= ",";}
            $outp .= '{"code":"' . $row["code"] . '", "name":"' . $row["name"] . '"}';
        }
        $outp .= ']}';
    }
    echo $outp;
    //$stmt->execute();
    //$results = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

}
catch(PDOException $e) {
    echo "could not echo array";
    echo "Error: " . $e->getMessage();
    die();
}

?>
