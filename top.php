<html>
<body bgcolor="#669966">

<center>
<img src="images/solar-bus.jpg">
</center>

<?php
$url = "http://ws.audioscrobbler.com/2.0/?method=user.getinfo&user=USERNAME&api_key=API_KEY";
$xml = simplexml_load_file($url);
$num = $xml->user->playcount;
echo "Total songs scrobbled:  $num";
?>

<br><br>
Top 50 songs <a href="http://en.wikipedia.org/wiki/Audioscrobbler" target="_new">scrobbled<a/>:
<br><br>

<center>

<table width="60%" border=0>
<tr>
<td><b>artist</b></td>
<td><b>song</b></td>
<td><b>times scrobbled</b></td>
</tr>

<?php

$url = "http://ws.audioscrobbler.com/2.0/?method=user.gettoptracks&user=USERNAME&api_key=API_KEY";
$xml = simplexml_load_file($url);
$tracks = $xml->toptracks->track;

for ($i = 0; $i < 50; $i++) {
        $trackname = $tracks[$i]->name;
        $artist = $tracks[$i]->artist->name;
        $count = $tracks[$i]->playcount;
        echo "<td> $artist</td>
        <td> $trackname</td>
        <td> $count</td>
        </tr>";
}

echo "</table>";

?>

</center>
<br><br>
A complete list of what I've been listing to can be found <a href="http://last.fm/user/USERNAME/library" target="_new">here</a>

</body>
</html>
