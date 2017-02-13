<?php
header("Content-Type: application/json; charset=UTF-8");


$_POST['start'];
$_POST['end'];
$_POST['setCode'];
$_POST['pokedexMode'];
$_POST['search_card'];

$servername = '';
$dbname = '';
$dbuser = '';
$dbpass = '';

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
min(c.set_num)
,c.np_num as pokedex_number
,min(c.imageurl) as url 
FROM cards c
join sets s on s.code = c.set_code
left outer join cards c2 
join sets s2 on s2.code = c2.set_code on c2.np_num = c.np_num and s2.release_date < s.release_date
where c2.id is null
and c.np_num between ? and ?
group by pokedex_number
order by c.np_num asc 
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
c.set_num
,c.np_num as pokedex_number
,c.imageurl as url
,s.release_date
FROM cards c
join sets s on s.code = c.set_code
where c.name like concat('%', ? , '%')
order by s.release_date asc
limit ". ($_POST['start'] - 1).",18;
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
    c.set_num
    ,c.np_num as pokedex_number
    ,c.imageurl as url 
    from cards c
    where c.set_code = ?
    and c.set_num >= ?
    and c.set_num <= ?
    order by set_num asc
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