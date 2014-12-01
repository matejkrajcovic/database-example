<?php

function processQuery($query, $title, $columns) {
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());

    echo "<h1>$title</h1>\n";

    echo "<table border=\"2\">\n<tr>";
    foreach($columns as $column) {
        echo "<th>$column</th>";
    }
    echo "</tr>\n";
    
    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        echo "\t<tr>\n";
        foreach ($line as $col_value) {
            echo "\t\t<td>$col_value</td>\n";
        }
        echo "\t</tr>\n";
    }
    echo "</table>\n";

    pg_free_result($result);
}

$url=parse_url(getenv("DATABASE_URL"));
$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"],1);

$dbconn = pg_connect(sprintf("host=%s dbname=%s user=%s password=%s", $server, $db, $username, $password))
        or die('Could not connect: ' . pg_last_error());

$query1 = file_get_contents("query1.sql");
processQuery($query1, "Prvá úloha", array("Meno", "Počet podriadených", "Priemerný plat"));

$query2 = file_get_contents("query2.sql");
processQuery($query2, "Druhá úloha", array("Meno", "Platový stupeň", "Počet zamestnancov"));

$query3 = file_get_contents("query3.sql");
processQuery($query3, "Tretia úloha", array("Platový stupeň", "Maximálny plat", "Počet zamestnancov", "Celkové náklady", "Priemerné zvýšenie"));

pg_close($dbconn);

?>
