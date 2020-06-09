<div class="heading">
		<h1 class="text-center wow fadeInDown"  data-wow-delay="2.1s" style="color:white;">Forums</h1>
	</div>
<section class="layout" id="page">
<div class="container"><br/>
<div class="alert alert-info alert-dismissable" role="alert">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	Bienvenue sur notre forum ,
	Ici vous pourrez échanger et partager avec le reste de la communauté du serveur </div>
<?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['modeJoueur'] == true)
 	{
 		?>
 			<p class="text-center">
 				<a href="?action=mode_joueur" class="btn btn-primary">[STAFF] Passer en mode visuel <?php echo ($_SESSION['mode']) ? "Administrateur" : "Joueur"; ?></a>
 			</p>
 		<?php 
 	}
$fofo = $_Forum_->affichageForum();
for($i = 0; $i < count($fofo); $i++)
{ 
	if($_PGrades_['PermsDefault']['forum']['perms'] >= $fofo[$i]['perms'] OR ($_Joueur_['rang'] == 1 AND !$_SESSION['mode']) OR $fofo[$i]['perms'] == 0)
	{
	?>
		<br><br/>
		<table class="table table-striped">
		<div class="row">
		<?php if(isset($_Joueur_) AND ($_PGrades_['PermsForum']['general']['deleteForum'] == true OR $_Joueur_['rang'] == 1) AND !$_SESSION['mode']){ ?>
			<div class="col-md-6 offset-md-6" style="text-align: right;">	
			
			<div style="text-overflow: clip;word-wrap: break-word;">
			    <a class="btn btn-primary" data-toggle="collapse" href="#spoiler<?php echo $fofo[$i]['id'];?>" role="button" aria-expanded="false" aria-controls="spoiler<?php echo $fofo[$i]['id'];?>">Paramétres du forum <i class="fas fa-cogs"></i></a>
    				<div class="collapse" id="spoiler<?php echo $fofo[$i]['id'];?>">
<!-- -->
				<div class="btn-group btn-sm" role="group" aria-label="Button group with nested dropdown">
					<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="[AIDE] Forum > Ordre: Cliquer sur l'extention du boutton pour modifier l'odre de votre forum">Modifier l'odre <i class="fas fa-sort"></i></button>
					<div class="btn-group" role="group">
						<button id="btnGroupDrop4" type="button" id="ordreforum<?=$fofo[$i]['id']; ?>" class="btn btn-outline-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
						<div class="dropdown-menu" aria-labelledby="btnGroupDrop4">
						<a class="dropdown-item" href="?action=ordreForum&ordre=<?=$fofo[$i]['ordre']; ?>&id=<?=$fofo[$i]['id']; ?>&modif=monter"><i class="fas fa-arrow-up"></i> Monter d'un cran</a>
						<a class="dropdown-item" href="?action=ordreForum&ordre=<?=$fofo[$i]['ordre']; ?>&id=<?=$fofo[$i]['id']; ?>&modif=descendre"><i class="fas fa-arrow-down"></i> Descendre d'un cran</a>
						</div>
					</div>
				</div>
				<a href="?action=remove_forum&id=<?php echo $fofo[$i]['id']; ?>" class="btn btn-sm btn-outline-primary" style="text-align: right;">Supprimer <i class="fas fa-trash-alt"></i></a>
				&nbsp;
				<a class="btn btn-outline-danger btn-sm" data-toggle="modal" href="#NomForum" data-entite="0" data-nom="<?=$fofo[$i]['nom'];?>" data-id="<?=$fofo[$i]['id'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="[AIDE] Forum > Nom: Cliquer sur le boutton pour modifier le nom de votre forum">Modifier le nom / icon <i class="fas fa-edit"></i></a>
				
				<div class="btn-group btn-sm" role="group" aria-label="Button group with nested dropdown">
					<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="[AIDE] Forum > Permission: Cliquer sur l'extention du boutton pour modifier les permission de votre forum">Permissions <i class="fas fa-gavel"></i></button>
					<div class="btn-group" role="group">
					<button id="btnGroupDrop4" type="button" id="perms<?=$fofo[$i]['id']; ?>" class="btn btn-outline-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
					<div class="dropdown-menu" aria-labelledby="btnGroupDrop4">
						<form action="?action=modifPermsForum" method="POST">
							<input type="hidden" name="id" value="<?=$fofo[$i]['id'];?>" />
							<a class="dropdown-item"><input type="number" name="perms" value="<?=$fofo[$i]['perms'];?>" class="form-control"></a>
							<button type="submit" class="dropdown-item text-center">Valider</button>
						</form>
					</div>
				</div>
<!-- -->
				</div>
			</div>
			</div><br/>
		<?php } ?></div>
		<div class="row">
		<div class="col-md-12 col-sm-12">
		<thead>
			<tr>
				<th colspan="5" style="width: <?=(($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['deleteCategorie'] == true) AND !$_SESSION['mode']) ? '75%' : '100%';?>;"><h3 class="text-left"><?php echo ucfirst($fofo[$i]['nom']); ?></h3></th>
				<?php if(($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['deleteCategorie'] == true) AND !$_SESSION['mode'])
				{
					?><th>Actions</th>
					<?php
				}
				?>
			</tr>
		</thead>
<?php
$categorie = $_Forum_->infosForum($fofo[$i]['id']);
?>
    <tbody>
<?php   for($j = 0; $j < count($categorie); $j++) { 
			
			$derniereReponse = $_Forum_->derniereReponseForum($categorie[$j]['id']);
			if(($_Joueur_['rang'] == 1 AND !$_SESSION['mode']) OR $_PGrades_['Permsdefault']['forum']['perms'] >= $categorie[$j]['perms'] OR $categorie[$j]['perms'] == 0)
			{
			?>
            <tr>

				<td style="width: 3%;"><?php if($categorie[$j]['img'] == NULL) { ?><a href="?&page=forum_categorie&id=<?php echo $categorie[$j]['id']; ?>"><i class="material-icons">chat</i></a><?php }
					else { ?><a href="?page=forum_categorie&id=<?php echo $categorie[$j]['id']; ?>"><i class="material-icons"><?php echo $categorie[$j]['img']; ?></i></a><?php }?></td>
				<td style="width: 32%;"><a href="?&page=forum_categorie&id=<?php echo $categorie[$j]['id']; ?>"><?php echo $categorie[$j]['nom']; ?></a>
				<?php 	if($_Joueur_['rang'] == 1 AND !$_SESSION['mode'])
							$perms = 100;
						elseif($_PGrades_['PermsDefault']['forum']['perms'] > 0)
							$perms = $_PGrades_['PermsDefault']['forum']['perms'];
						else
							$perms = 0;

				$sousforum = $bddConnection->prepare('SELECT * FROM cmw_forum_sous_forum WHERE id_categorie = :id_categorie AND perms <= :perms');
							$sousforum->execute(array(
								'id_categorie' => $categorie[$j]['id'],
								'perms' => $perms
							));
							$sousforum = $sousforum->fetchAll(); 
							if(count($sousforum) != 0)
							{ ?><br/><small>
						<div class="dropdown">
						<a class="dropdown-toggle" href="sous-forum<?php echo $categorie[$j]['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="width: 99.5%;">
						Sous-forum  :<?php echo count($sousforum); ?>
						</a>
						<?php if(count($sousforum) != "0") { ?>
						<div class="dropdown-menu" aria-labelledby="sous-forum<?php echo $categorie[$j]['id']; ?>">
							<?php for($s = 0; $s < count($sousforum); $s++) {
								?><a class="dropdown-item" href="?&page=forum_categorie&id=<?php echo $categorie[$j]['id']; ?>&id_sous_forum=<?php echo $sousforum[$s]['id']; ?>"><?php echo $sousforum[$s]['nom']; ?></a>
							<?php } ?>
						</div>
						<?php } ?>
						</div></small>
				<?php } ?>
				</td>
			<td class="text-center"><a href="?&page=forum_categorie&id=<?php echo $categorie[$j]['id']; ?>"><?php echo $CountTopics = $_Forum_->compteTopicsForum($categorie[$j]['id']); ?></a> discussion</td>
			<td class="text-center"><a href="?page=forum_categorie&id=<?=$categorie[$j]['id']; ?>"><?=$_Forum_->compteMessages($categorie[$j]['id']) + $CountTopics; ?></a> messages</td>
			<td class="text-center"><?php if($derniereReponse) { ?> 
				Dernier <br/><a href="?page=post&id=<?php echo $derniereReponse['id']; ?>" title="<?=$derniereReponse['titre'];?>"><?php $taille = strlen($derniereReponse['titre']);
					echo substr($derniereReponse['titre'], 0, 15);
					if(strlen($taille > 15)){ echo '...'; } ?> (Par <?=$derniereReponse['pseudo'];?>), Le <?php $date = explode('-', $derniereReponse['date_post']); echo '' .$date[2]. '/' .$date[1]. '/' .$date[0]. ''; ?></a>
			<?php
				}
				else { ?><p> Il n'y a pas de sujet dans ce forum </p> <?php } 
				?></td>
			<?php
				if(isset($_Joueur_) AND ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['deleteCategorie'] == true) AND !$_SESSION['mode'])
				{
					?><td><a href="?action=remove_cat&id=<?php echo $categorie[$j]['id']; ?>" class="btn btn-outline-primary" style="text-align: left;"><i class="fas fa-trash-alt"></i></a>
					<div class="dropdown" style="display: inline; text-align: center;">
						<button type="button" class="btn btn-outline-primary" id="Perms<?=$categorie[$j]['id'];?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-edit"></i>
						</button>
						<div class="dropdown-menu">
							<form action="?action=modifPermsCategorie" method="POST">
								<input type="hidden" name="id" value="<?=$categorie[$j]['id'];?>" />
								<a class="dropdown-item"><input type="number" name="perms" value="<?=$categorie[$j]['perms'];?>" class="form-control"></a>
								<button type="submit" class="dropdown-item text-center">Modifier</button>
							</form>
						</div>
					</div>
					<a class="btn btn-outline-primary" data-toggle="modal" href="#NomForum" data-entite="1" data-nom="<?=$categorie[$j]['nom'];?>" data-icone="<?=($categorie[$j]['img'] == NULL) ? 'chat' : $categorie[$j]['img'];?>" data-id="<?=$categorie[$j]['id'];?>"><i class="fas fa-font"></i></a>
					<div class="dropdown" style="display: inline; text-align: center;">
						<button type="button" class="btn btn-outline-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-list"></i>
						</button>
						<div class="dropdown-menu">
						    <a class="dropdown-item" href="?action=ordreCat&ordre=<?=$categorie[$j]['ordre']; ?>&id=<?=$categorie[$j]['id']; ?>&forum=<?=$categorie[$j]['forum'];?>&modif=monter"><i class="fas fa-arrow-up"></i> Monter d'un cran</a>
						    <a class="dropdown-item" href="?action=ordreCat&ordre=<?=$categorie[$j]['ordre']; ?>&id=<?=$categorie[$j]['id']; ?>&forum=<?=$categorie[$j]['forum'];?>&modif=descendre"><i class="fas fa-arrow-down"></i> Descendre d'un cran</a>
						</div>
					</div>
					<a href=<?php if($categorie[$j]['close'] == 0) { ?>"?action=lock_cat&id=<?=$categorie[$j]['id'];?>&lock=1" title="Fermer le forum"><i class="fa fa-unlock-alt"<?php } else { ?>"?action=unlock_cat&id=<?=$categorie[$j]['id'];?>&lock=0" title="Ouvrir le forum"><i class="fa fa-lock"<?php } ?> aria-hidden="true"></i></a></td><?php
				}
?>
			</tr>
			<?php }
			} ?>
	</tbody>
</table><hr/>
<?php
	}
}
if($_PGrades_['PermsForum']['general']['addForum'] == true OR $_Joueur_['rang'] == 1 AND !$_SESSION['mode'])
{
	?><a class="btn btn-primary btn-sm" style="float: right;" role="button" data-toggle="collapse" href="#add_forum" aria-expanded="false" aria-controls="add_forum">
<i class="fas fa-plus-circle"></i> Catégorie
</a>
<div class="collapse" id="add_forum">
	<div class="well"><br/>
		<form action="?action=create_forum" method="post">
			<div>
				<p class="text-center"><label class="control-label" for="nomFo">Nom de la catégorie</label></p>
				<input type="text" name="nom" id="nomFo" maxlength="80" class="form-control" required>
			</div>
			<br/>
			<p class="text-right">
				<button type="submit" class="btn btn-success btn-sm btn-round">Créer une catégorie</button>
			</p>
		</form>
	</div>
</div><br/><?php
}
if(isset($_Joueur_) AND ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['addCategorie'] == true ) AND !$_SESSION['mode'])
{
	?>
	<br/>
	<a class="btn btn-primary btn-sm" role="button" data-toggle="collapse" href="#add_categorie" aria-exepanded="false" aria-controls="add_categorie" style="float: right;"><i class="fas fa-plus-circle"></i> Forum</a>
	<div class="collapse" id="add_categorie">
	<br/>
			<form action="?action=create_cat" method="post"><br>
				<div class="from-group row">
						<label class="col-md-6 col-form-label" for="nomCat">Nom du Forum : </label>
						<div class="col-md-6">
							<input type="text" name="nom" id="nomCat" maxlength="40" class="form-control" required />
						</div>
				</div><br>
				<div class="froum-group row">
						<label class="col-md-6 col-form-label" for="img">Icon disponible sur : <a href="https://design.google.com/icons/" target="_blank">https://design.google.com/icons/</a></label>
						<div class="col-md-6">
							<input type="text" name="img" id="img" maxlength="300" class="form-control" />
						</div>
				</div><br>
				<div class="form-group row">
						<label class="col-md-6 col-form-label">Catégorie : </label>
						<div class="col-md-6">
							<select name="forum" class="form-control" required>
								<?php
								for($z = 0; $z < count($fofo); $z++)
								{
									?><option value="<?php echo $fofo[$z]['id']; ?>"><?php echo $fofo[$z]['nom']; ?></option><?php
								}
								?></select>
						</div><br/>
				</div><br>
				<p class="text-right">
					<button type="submit" class="btn btn-success btn-sm btn-round">Créer un Forum</button>
				</p>
			</form>
	</div>
<?php
}
?>
</div>
</section>