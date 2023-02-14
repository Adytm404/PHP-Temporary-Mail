<?php
$url = 'https://www.1secmail.com/api/v1/?action=genRandomMailbox&count=1';
$json = file_get_contents($url);
$data = json_decode($json, true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<table align="center" style="justify-content: center" border="1">
  <tr>
    <td>
      <strong>Login:</strong>
    </td>
    <td>
      <input type="text" id="inputMail" class="custom-search-input" placeholder="Enter your email">
    </td>
    <td><button id="checkButton" class="custom-search-botton" type="submit">Check</button></td>
  </tr>
  <tr>
    <td style="padding: 20px; border: none"></td>
  </tr>
  <tr>
    <td><strong>Email:</strong></td>
    <td id="email"><?=$data[0]?></td>
    <td><button class="btn-copy" data-clipboard-target="#email">Copy</button></td>
  </tr>
  <tr>
    <td><strong>Action:<strong></td>
    <td><button onclick="location.reload();">Generate More</button></td>
    <td colspan="3" align="center"><a href="./view.php?id=<?=$data[0]?>"><button>Read Mail</button></a></td>
  </tr>
</table>

<script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
<script>
  var clipboard = new ClipboardJS('.btn-copy');

  clipboard.on('success', function(e) {
    alert("Alamat email berhasil di-copy: " + e.text);
    e.clearSelection();
  });
</script>
<script>
  document.getElementById('checkButton').onclick = function() {
    window.location = "./view.php?id=" + document.getElementById('inputMail').value;
    return false;
      }
</script>
</body>
</html>
