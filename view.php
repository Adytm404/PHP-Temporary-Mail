<?php
function extractEmailParts($email) {
    $parts = explode("@", $email);
    $username = $parts[0];
    $domain = $parts[1];

    return [
        'username' => $username,
        'domain' => $domain
    ];
}

function getEmailDetails($email) {
    $emailParts = extractEmailParts($email);
    $username = $emailParts['username'];
    $domain = $emailParts['domain'];

    $url = 'https://www.1secmail.com/api/v1/?action=getMessages&login='.$username.'&domain='.$domain;
    $json = file_get_contents($url);
    $data = json_decode($json, true);

    $id = $data[0]['id'];
    $from = $data[0]['from'];
    $subject = $data[0]['subject'];
    $date = $data[0]['date'];

    return [
        'id' => $id,
        'from' => $from,
        'subject' => $subject,
        'date' => $date,
    ];
}


$email = $_GET['id'];
$details = getEmailDetails($email);

if (isset($details['id']) && !empty($details['id'])) {
    $emailParts = extractEmailParts($email);
    $username = $emailParts['username'];
    $domain = $emailParts['domain'];
    $id = $details['id'];

    echo '<title>📧Found Email!</title>';
    echo '<table align="center" border="1">';
    echo '  <tr>';
    echo '    <td><strong>From:</strong></td>';
    echo '    <td>'.$details['from'].'</td>';
    echo '  </tr>';
    echo '  <tr>';
    echo '    <td><strong>Subject:</strong></td>';
    echo '    <td>'.$details['subject'].'</td>';
    echo '  </tr>';
    echo '  <tr>';
    echo '    <td><strong>Date:</strong></td>';
    echo '    <td>'.$details['date'].'</td>';
    echo '  </tr>';
    echo '  <tr>';
    echo '    <td><strong>Action:</strong></td>';
    echo "<td><a id='viewlink' value='./read.php?login=$username&domain=$domain&id=$id' href='./read.php?login=$username&domain=$domain&id=$id'><button style='display: none'>view</button></a><button onclick='loadData();'>Open Email</button></td><td><button onclick='location.reload();'>Refresh</button></td>";
    echo '  </tr>';
    echo '</table>';


    echo '<script>audio.play();</script>';
  }else{
    echo '<h4 align="center">Automatic refresh every 5 seconds
    <h4>';
    echo '<meta http-equiv="Refresh" content="5">';
    echo '<table align="center" border="1">';
    echo '  <tr>';
    echo '   <td>';
    echo '      <p>Data tidak ditemukan</p>';
    echo '   <td>';
        echo '      <button onclick="location.reload();">Refresh</button>';
    echo '  <tr>';
    echo '</table>';
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waiting email...</title>
</head>
<body>

<audio id="myAudio">
  <source src="./sound/notify.mp3" type="audio/mpeg">
</audio>

<script>
  var audio = document.getElementById("myAudio");
  function loadData() {
    var xhr = new XMLHttpRequest();
    let element = document.querySelector("#viewlink");
    let hrefValue = element.getAttribute("href");

    xhr.open('GET', hrefValue, true);

    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        document.getElementById('dataContainer').innerHTML = xhr.responseText;
      }
    };

    xhr.send();
  }
</script>


<div class="container" id="dataContainer"></div>



<style>
.container {
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
}
@media (min-width: 768px) {
  .container {
    width: 750px;
  }
}
@media (min-width: 992px) {
  .container {
    width: 970px;
  }
}
@media (min-width: 1200px) {
  .container {
    width: 1170px;
  }
}
</style>

</body>
</html>


