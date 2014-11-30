<?php

$url=parse_url(getenv("DATABASE_URL"));
$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"],1);

$dbconn = pg_connect(sprintf("host=%s dbname=%s user=%s password=%s"), $server, $db, $username, $password)
        or die('Could not connect: ' . pg_last_error());

$query = file_get_contents("query1.sql");
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

echo "<h1>Prva uloha<h2>\n";

echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

pg_free_result($result);

pg_close($dbconn);

?>
