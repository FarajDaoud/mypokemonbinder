<?php
header("Content-Type: application/json; charset=UTF-8");


$_POST['start'];
$_POST['end'];
$_POST['setCode'];
$_POST['pokedexMode'];
$_POST['search_card'];

$servername = '###############';
$dbname = '#########';
$dbuser = '####';
$dbpass = '########';

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
$dbc->query('SET SQL_BIG_SELECTS=1');

if($_POST['pokedexMode'] == 'on'){
    $stmt = $dbc->prepare(
    "
SELECT
min(c.number_)
,c.nationalpokedexnumber as pokedex_number
,min(c.imageurl) as url 
FROM cards c
join sets s on s.code = c.setCode
left outer join cards c2 
join sets s2 on s2.code = c2.setCode on c2.nationalpokedexnumber = c.nationalpokedexnumber and s2.release_date < s.release_date
where c2.id is null
and c.nationalpokedexnumber between ? and ?
group by pokedex_number
order by c.nationalpokedexnumber asc 
    "
    );

    //echo "array results: \r\n";
    if($stmt->execute(array($_POST['start'], $_POST['end']))){ //replace with variable based on page
        $outp = '{"cards": [';
        while ($row = $stmt->fetch()) {
            //print_r($row);
            if ($outp != '{"cards": [') {$outp .= ",";}
            $outp .= '{"pokedex_number":"' . $row["pokedex_number"] . '", "url":"' . $row["url"] . '"}';
        }
        $outp .= ']}';
    }
    echo $outp;
}
else if($_POST['search_card'] != ''){
    $stmt = $dbc->prepare(
    "
select
c.number_
,c.nationalpokedexnumber as pokedex_number
,c.imageurl as url
,s.release_date
FROM cards c
join sets s on s.code = c.setCode
where c.name like concat('%', ? , '%')
order by s.release_date asc
limit 0,18
    "
    );

    //echo "array results: \r\n";
    if($stmt->execute(array($_POST['search_card']))){ //replace with variable based on page
        $outp = '{"cards": [';
        while ($row = $stmt->fetch()) {
            //print_r($row);
            if ($outp != '{"cards": [') {$outp .= ",";}
            $outp .= '{"pokedex_number":"' . $row["pokedex_number"] . '", "url":"' . $row["url"] . '"}';
        }
        $outp .= ']}';
    }
    echo $outp;
}

else{

$stmt = $dbc->prepare(
    "select
    c.number_
    ,c.nationalpokedexnumber as pokedex_number
    ,c.imageurl as url 
    from cards c
    where c.setCode = ?
    and c.number_ >= ?
    and c.number_ <= ?
    order by number_ asc
    "
    );

    //echo "array results: \r\n";
    if($stmt->execute(array($_POST['setCode'], $_POST['start'], $_POST['end']))){ //replace with variable based on page
        $outp = '{"cards": [';
        while ($row = $stmt->fetch()) {
            //print_r($row);
            if ($outp != '{"cards": [') {$outp .= ",";}
            $outp .= '{"pokedex_number":"' . $row["pokedex_number"] . '", "url":"' . $row["url"] . '"}';
        }
        $outp .= ']}';
    }
    echo $outp;
    //$stmt->execute();
    //$results = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
}
}
catch(PDOException $e) {
    echo "could not echo array";
    echo "Error: " . $e->getMessage();
    die();
}

?>
