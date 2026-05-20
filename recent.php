<html>

<head>
  <link rel="stylesheet" type="text/css" href="css.css">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <meta http-equiv="refresh" content="30">
</head>

<body bgcolor="#669966">

<br><br>

<?php

$api_key = "my_apikey";
$username = "my_username";
$timezone = 'America/Denver';


$info_url = "http://ws.audioscrobbler.com/2.0/?method=user.getinfo&user=$username&api_key=$api_key";
$info_xml = @simplexml_load_file($info_url);
$num = $info_xml ? $info_xml->user->playcount : "0";

echo "Total songs scrobbled:  $num";
?>

<br><br>
Last 25 songs <a href="http://en.wikipedia.org/wiki/Audioscrobbler" target="_new">scrobbled</a>:
<br><br>

<center>

<table width="80%" border=0>
  <tr>
    <td width="25%"><b>artist</b></td>
    <td width="60%"><b>song</b></td>
    <td width="15%"><b>scrobbled</b></td>
  </tr>

<?php

$recent_url = "http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user=$username&api_key=$api_key&limit=25";
$recent_xml = @simplexml_load_file($recent_url);

if ($recent_xml && isset($recent_xml->recenttracks->track)) {
    foreach ($recent_xml->recenttracks->track as $track) {
        $trackname = (string)$track->name;
        $artist = (string)$track->artist;
        
        echo "  <tr>\n";
        echo "    <td width=\"25%\"> " . htmlspecialchars($artist) . "</td>\n";
        echo "    <td width=\"50%\"> " . htmlspecialchars($trackname) . "</td>\n";


        if (isset($track->date) && isset($track->date['uts'])) {
            $epoch = (integer)$track->date['uts'];
            $dt = new DateTime("@$epoch");
            $dt->setTimezone(new DateTimeZone($timezone));
            

            $scrobbled = $dt->format('M d Y') . '&nbsp;&nbsp;' . $dt->format('H:i');
            echo "    <td width=\"25%\"> $scrobbled</td>\n";
        } else {
            echo "    <td width=\"25%\"> <i>now playing</i></td>\n";
        }

        echo "  </tr>\n";
    }
}
?>

</table>

</center>
<br><br>
A complete list of what I've been listening to can be found <a href="http://last.fm/user/danradom/library" target="_new">here</a>.  The code used to generate this page can be found <a href="https://github.com/danradom/scrobbled/blob/master/recent.php" target="_new">here</a>.
<br><br>

</body>
</html>
