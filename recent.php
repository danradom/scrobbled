<html>
<body bgcolor="#669966">

<?php
$url = "http://ws.audioscrobbler.com/2.0/?method=user.getinfo&user=USERNAME&api_key=API_KEY";
$xml = simplexml_load_file($url);
$num = $xml->user->playcount;

echo "Total songs scrobbled:  $num";
?>

<br><br>
Last 25 songs <a href="http://en.wikipedia.org/wiki/Audioscrobbler" target="_new">scrobbled<a/>:
<br><br>

<center>

<table width="80%" border=0>
<tr>
<td width="25%"><b>artist</b></td>
<td width="50%"><b>song</b></td>
<td width="25%"><b>scrobbled</b></td>
</tr>

<?php

$url = "http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user=USERNSME&api_key=API_KEY&limit=25";
$xml = simplexml_load_file($url);
$tracks = $xml->recenttracks->track;

for ($i = 0; $i < 25; $i++) {
        $trackname = $tracks[$i]->name;
        $artist = $tracks[$i]->artist;
        $epoch = (integer) $tracks[$i]->date['uts'];

        $dt = new DateTime("@$epoch");
        $dt->setTimezone(new DateTimeZone('America/Denver'));
        $scrobbled = $dt->format('d M Y,  H:i');

        echo "<td width=\"25%\"> $artist</td>
        <td width=\"50%\"> $trackname</td>";

        if (! $epoch) {
            echo "<td width=\"25%\"> now playing</td>";
        } else {
            echo "<td width=\"25%\"> $scrobbled</td>";
        }

        echo "</tr>";
}

echo "</table>";

?>

</center>
<br><br>
A complete list of what I've been listing to can be found <a href="http://last.fm/user/USERNAME/library" target="_new">here</a>

</body>
</html>
