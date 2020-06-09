<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand wow fadeInDown" href="#" data-wow-delay="1.2s"><?php echo $_Serveur_['General']['name']; ?></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarColor03">
			<ul class="navbar-nav mr-auto">
					<?php
					// Je rappelle que _Menu_ est une variable utilisable partout. Elle est générée en début d'index.
					// Cette variable contient le texte des liens de la barre des menus, l'adresse des liens, les liste déroulantes etc...

					// Cette boucle affiche un lien / menu déroulant à chaque tour. On fait autant de tour qu'il y a de textes à afficher.
					for($i = 0; $i < count($_Menu_['MenuTexte']); $i++)
					{
						// Si il y a une liste déroulante contenant le texte du texte de ce tour de boucle, le lien devient un menu déroulant.
						if(isset($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]]))
						{
							// On affiche la structure de base du menu déroulant de Bootstrap :
							?>
									<li class="nav-item dropdown">
									<a id="Listdefil<?php echo $i; ?>" href="#" class="nav-link dropdown-toggle wow fadeInDown link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-wow-delay="<?php echo $i/10; ?>s"><?php echo $_Menu_['MenuTexte'][$i]; ?></a>
										<div class="dropdown-menu" aria-labelledby="Listdefil<?php echo $i; ?>">
							<?php

							// On affiche la puce dans le menu déroulant depuis une boucle, qui fait autant de tour qu'il y a de lignes à afficher dans la liste déroulante.
							for($k = 0; $k < count($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]]); $k++)
							{
								// Dans le cas où le texte de la puce vaut "-divider-", on met une ligne de division à la place du texte (fonctionnalité css de bootstrap).

								if($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]][$k] == '-divider-')
								{
									echo'<div class="dropdown-divider"></div>';
								}
								// Sinon on met un lien avec texte + adresse.
								else
								{
									echo '<a href="' .$_Menu_['MenuListeDeroulanteLien'][$_Menu_['MenuTexteBB'][$i]][$k]. '" class="dropdown-item">' .$_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]][$k]. '</a>';
								}
							}
							?>
										</div>
									</li>
						<?php
						}
						else
						{
							// On garde juste l'essentiel
							$quellePage = str_replace('index.php?&page=', '', $_Menu_['MenuLien'][$i]);
							$quellePage1 = str_replace('?&page=', '', $_Menu_['MenuLien'][$i]);
							$quellePage2 = str_replace('?page=', '', $_Menu_['MenuLien'][$i]);

							// On regrade sur quel page on et et si le lien et sur la page on dit qu'il et actif
							if(isset($_GET['page']) AND ($quellePage == $_GET['page'] OR $quellePage1 == $_GET['page'] OR $quellePage2 == $_GET['page']))
								$active = ' active';

						 // Si on trouve pas la page on met sur le premier lien qui et en général l'index
							elseif(!isset($_GET['page']) AND $i == 0)
								$active = ' active';

							// Si on a pas trouvé on met rien
							else $active = ' inactive';

							// On affiche enfin la puce !
							echo '<li class="nav-item"><a href="' .$_Menu_['MenuLien'][$i]. '" class="nav-link wow fadeInDown ' .$active. '" data-wow-delay="'. $i/10 .'s">' .$_Menu_['MenuTexte'][$i]. '</a></li>';
						}
					} ?>
				</ul>
					<?php
					if(isset($_Joueur_))
					{
						$Img = new ImgProfil($_Joueur_['id']);
					?>
					<div class="btn-group" role="group" aria-label="Dropdown Membres">
					              <div class="btn-group" role="group">
					                  <button id="btnGroupDrop3" type="button" class="btn btn-primary dropdown-toggle wow fadeInDown link btn-colored" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-wow-delay="<?php echo ($i+1)/10; ?>s">&nbsp;<img src="<?=$Img->getImgToSize(20, $width, $height); ?>" style="margin-left: -10px; width: <?=$width;?>px; height: <?=$height;?>px;"> <?php echo $_Joueur_['pseudo']; ?></button>
					                  <div class="dropdown-menu  dropdown-menu-right animated fadeIn" aria-labelledby="btnGroupDrop3">
					      <?php
					        $req_topic = $bddConnection->prepare('SELECT cmw_forum_topic_followed.pseudo, vu, cmw_forum_post.last_answer AS last_answer_pseudo
					          FROM cmw_forum_topic_followed
					          INNER JOIN cmw_forum_post WHERE id_topic = cmw_forum_post.id AND cmw_forum_topic_followed.pseudo = :pseudo');
					        $req_topic->execute(array(
					          'pseudo' => $_Joueur_['pseudo']
					        ));
					        $alerte = 0;
					        while($td = $req_topic->fetch())
					        {
					          if($td['pseudo'] != $td['last_answer_pseudo'] AND $td['last_answer_pseudo'] != NULL AND $td['vu'] == 0)
					          {
					            $alerte++;
					          }
					        }
					        $req_answer = $bddConnection->prepare('SELECT vu
					        FROM cmw_forum_like INNER JOIN cmw_forum_answer WHERE id_answer = cmw_forum_answer.id
					        AND cmw_forum_like.pseudo != :pseudo AND cmw_forum_answer.pseudo = :pseudo');
					        $req_answer->execute(array(
					          'pseudo' => $_Joueur_['pseudo'],
					        ));
					        while($answer_liked = $req_answer->fetch())
					        {
					          if($answer_liked['vu'] == 0)
					          {
					            $alerte++;
					          }
					        }
					        if($_PGrades_['PermsPanel']['access'] == "on" OR $_Joueur_['rang'] == 1)
					          echo '<a href="admin.php" class="dropdown-item text-success"><i class="fas fa-tachometer-alt"></i> Administration</a>';
					        if($_PGrades_['PermsForum']['moderation']['seeSignalement'] == true OR $_Joueur_['rang'] == 1)
					        {
					          $req_report = $bddConnection->query('SELECT id FROM cmw_forum_report WHERE vu = 0');
					          $signalement = $req_report->rowCount();
					          echo '<a href="?page=signalement" class="dropdown-item text-warning"><i class="fa fa-bell"></i> Signalement <span class="badge badge-pill badge-warning" id="signalement">' . $signalement . '</span></a>';
					        }
					      ?>

																<a class="dropdown-item" href="?page=profil&profil=<?php echo $_Joueur_['pseudo']; ?>"><i class="fa fa-user"></i> Mon Profil</a>
																<a class="dropdown-item" href="?page=alert"><i class="fa fa-envelope"></i> Alertes :  <span class="badge badge-pill badge-primary" id="alerts"><?php echo $alerte; ?></span></a>
					                      <a class="dropdown-item" href="?page=token"><i class="ion-cash"></i> Mon solde : <?php if(isset($_Joueur_['tokens'])) echo $_Joueur_['tokens'] . ' '; ?><i class="fas fa-gem"></i></a>
																<a class="dropdown-item" href="?page=messagerie"><i class="fa fa-envelope"></i> Messagerie</a>
																<div class="dropdown-divider"></div>
																<a class="dropdown-item text-primary" href="?action=deco"><i class="fas fa-sign-out-alt"></i> Se déconnecter</a>
					                  </div>
					              </div>
					          </div>
				<?php }else{ ?>
					<form class="form-inline my-2 my-lg-0" role="form" method="post" action="?&action=connection">
            <input class="form-control mr-sm-2" type="text" name="pseudo" id="PseudoConectionForm" placeholder="Votre Pseudo" required>
            <input class="form-control mr-sm-2" type="password" name="mdp" id="MdpConnectionForm" placeholder="Votre mot de passe">
            <input class="form-control mr-sm-2" type="checkbox" name="reconnexion" checked> <span title="Se reconnecter automatiquement a chaque visites">Rester conn. &nbsp;</span>
            <button class="btn btn-sm btn-success my-2 my-sm-0" type="submit"><i class="fa fa-check"></i></button>
          </form>
					<div class="dropdown">
											    <a class="nav-link dropdown-toggle wow fadeInDown link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-wow-delay="<?php echo ($i+1)/10;?>s" style="margin-right: 32px;">
											         <i class="fa fa-user"></i> Compte
											    </a>
											    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
											        <a class="dropdown-item hvr-forward" href="#" data-toggle="modal" data-target="#ConnectionSlide"><i class="fas fa-sign-in-alt"></i> Connexion</a>
											        <a class="dropdown-item hvr-forward" href="#" data-toggle="modal" data-target="#InscriptionSlide"><i class="fa fa-user-plus"></i> Inscription</a>
											    </div>
											</div>
				<?php } ?>
        </div>
    </nav>
</header>
