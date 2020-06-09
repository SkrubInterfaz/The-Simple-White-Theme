<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['theme']['actions']['editTheme'] == true)
{
	//----------------------------------------------------------------------//
	$ecritureTheme['Pied']['facebook'] = htmlspecialchars($_POST['facebook']);
	$ecritureTheme['Pied']['twitter'] = htmlspecialchars($_POST['twitter']);
	$ecritureTheme['Pied']['youtube'] = htmlspecialchars($_POST['youtube']);
	$ecritureTheme['Pied']['discord'] = htmlspecialchars($_POST['discord']);
  	$ecritureTheme['All']['1']['titre'] = htmlspecialchars($_POST['titre1']);
	$ecritureTheme['All']['2']['titre'] = htmlspecialchars($_POST['titre2']);
  	$ecritureTheme['All']['3']['titre'] = htmlspecialchars($_POST['titre3']);
  	$ecritureTheme['All']['1']['texte'] = htmlspecialchars($_POST['texte1']);
	$ecritureTheme['All']['2']['texte'] = htmlspecialchars($_POST['texte2']);
	$ecritureTheme['All']['3']['texte'] = htmlspecialchars($_POST['texte3']);
	$ecritureTheme['All']['Seo']['color'] = htmlspecialchars($_POST['color']);
	$ecritureTheme['All']['Seo']['name'] = htmlspecialchars($_POST['name']);
	$ecritureTheme['All']['Seo']['description'] = htmlspecialchars($_POST['description']);
	$ecritureTheme['All']['Seo']['image'] = htmlspecialchars($_POST['image']);
	$ecritureTheme['All']['Seo']['google'] = htmlspecialchars($_POST['google']);
	$ecritureTheme['All']['Seo']['bing'] = htmlspecialchars($_POST['bing']);
	//----------------------------------------------------------------------//
	$ecriture = new Ecrire('theme/'.$_Serveur_['General']['theme'].'/config/config.yml', $ecritureTheme);
}
?>
