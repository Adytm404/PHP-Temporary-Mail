<?php

$count = $_GET['id'];
$default = 0;

if(!empty($count)){
  $default = 0+$count;
}

if(!empty($count)){

  $url = "https://www.1secmail.com/api/v1/?action=genRandomMailbox&count=$count";
  $json = file_get_contents($url);
  $data = json_decode($json, true);

}else if($count == NULL){
  $count = 1;
  $url = "https://www.1secmail.com/api/v1/?action=genRandomMailbox&count=$count";
  $json = file_get_contents($url);
  $data = json_decode($json, true);
  
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mass TempMail Generator</title>
</head>
<body>

<h1 align="center">Mass TempMail Generator</h1>

<table align="center" style="justify-content: center" border="1">
  <tr>
    <td><strong>Login:<strong></td>
    <td><input type="text" id="inputMail" class="custom-search-input" placeholder="enter your mail"></td>
    <td colspan="3" align="center"><button id="checkButton" class="custom-search-botton" type="submit">Check</button></td>
  </tr>
  <tr>
    <td style="padding: 20px; border: none"></td>
  </tr>
  
    <?php
      for ($i = 0; $i < $count; $i++) {
          echo '<tr><td><strong>Email:</strong></td>';
          echo '<td id="email-'.$i.'">' . $data[$i] . '</td>';
          echo '<td><button class="btn-copy-'.$i.'" data-clipboard-target="#email-'.$i.'">Copy</button></td><td><a href="./view.php?id=' . $data[$i] . '" target="_blank"><button>Check Mail</button></a></td></tr>';

          


          echo '<script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>';
          echo '<script> var clipboard = new ClipboardJS(".btn-copy-'.$i.'"); clipboard.on("success", function(e) { audio.play(); e.clearSelection(); }); </script>';
      }
    ?>

    
  <tr>
    <td><strong>Mass:<strong></td>
    <td><input type="text" id="inMail" class="custom-search-input" placeholder="example: 10"></td>
    <td colspan="3" align="center"><button id="genMail" class="custom-search-botton" type="submit">Generate</button></td>
  </tr>
</table>

<h6 align="center">Built simple with ❤️ by Ogya Adyatma Putra</h6>

<audio id="myAudio">
  <source src="./sound/copy.mp3" type="audio/mpeg">
</audio>

<script>
  var audio = document.getElementById("myAudio");

  document.getElementById('checkButton').onclick = function() {
    window.location = "./view.php?id=" + document.getElementById('inputMail').value;
    return false;
      }
</script>
<script>
  document.getElementById('genMail').onclick = function() {
    window.location = "./?id=" + document.getElementById('inMail').value;
    return false;
      }
</script>
</body>
</html>
