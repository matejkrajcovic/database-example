<?php

$url=parse_url(getenv("DATABASE_URL"));
$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"],1);

$dbconn = pg_connect(sprintf("host=%s dbname=%s user=%s password=%s", $server, $db, $username, $password))
        or die('Could not connect: ' . pg_last_error());

$query = file_get_contents("query1.sql");
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

echo "<h1>Prvá uloha</h1>\n";

echo "<table border=\"2\">\n<tr><th>Meno</th><th>Počet podriadených</th><th>Priemerný plat</th></tr>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

pg_free_result($result);

$query = file_get_contents("query2.sql");
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

echo "<h1>Druhá uloha</h1>\n";

echo "<table border=\"2\">\n<tr><th>Oddelenie</th><th>Platový stupeň</th><th>Počet zamestnancov</th></tr>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

pg_free_result($result);

$query = file_get_contents("query3.sql");
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

echo "<h1>Prvá uloha</h1>\n";

echo "<table border=\"2\">\n<tr><th>Platový stupeň</th><th>Maximálny plat</th><th>Počet zamestnancov</th><th>Celkové náklady</th><th>Priemerné zvýšenie</th></tr>\n";
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
