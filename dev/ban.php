<?php
$req = $bddConnection->query('SELECT * FROM cmw_ban_config');
$data = $req->fetch(PDO::FETCH_ASSOC);
require('include/version.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Ban - <?php echo $_Serveur_['General']['name']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
    body { text-align: center; padding: 150px; }
    h1 { font-size: 50px; }
    body { font: 20px Helvetica, sans-serif; color: #333; }
    article { display: block; text-align: left; width: 650px; margin: 0 auto; }
    a { color: #dc8100; text-decoration: none; }
    a:hover { color: #333; text-decoration: none; }
</style>
</head>
<body>
<article>
    <h1><?=$data['titre'];?></h1>
    <div>
        <p><?=$data['texte'];?></p>
        <p>&mdash; <a href="mailto:contact@<?php echo $_Serveur_['General']['url']; ?>">Nous contacter</a></p>
    </div>
</article>
<center>avec <a href="https://craftmywebsite.fr">CraftMyWebsite</a></center>
</body>
</html>