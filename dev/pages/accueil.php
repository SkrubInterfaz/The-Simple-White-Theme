<style>
header{
	overflow-x: hidden;	
}
</style>
<header>
      <div class="i-medium">
          <h1 class="wow fadeInLeft" data-wow-delay="0.8s"><?php echo $_Serveur_['General']['name']; ?></h1>
          <h2 class="wow fadeInRight" data-wow-delay="0.8s"><?php echo $_Serveur_['General']['description']; ?></h2>
          <br/>
		  <input type="text" value="<?php echo $_Serveur_['General']['ipTexte']; ?>" id="myInput" style="opacity: 0">
		  <?php if($_Serveur_['General']['statut'] == 0)
                { ?>
				<center><button onclick="myFunction()" class="btn btn-lg btn-primary btn-ip hvr-pulse wow bounceIn" data-wow-delay="1s" data-wow-duration="1s" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Serveur éteint"><?php echo $_Serveur_['General']['ipTexte']; ?></button>	</center>
				<?php
				}
                elseif($_Serveur_['General']['statut'] == 1)
                { ?>
				<center><button onclick="myFunction()" class="btn btn-lg btn-success btn-ip hvr-pulse wow bounceIn" data-wow-delay="1s" ata-wow-duration="1s"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Serveur en ligne (Cliquer pour copier l'adresse IP)"><?php echo $_Serveur_['General']['ipTexte']; ?></button>
					  <br/>
                    <strong class='text-success'>(En Ligne : <?php echo $playeronline ?> / <?php echo $maxPlayers ?> )</strong></center>
				<?php
				}
                else{ ?>
				<center><button onclick="myFunction()" class="btn btn-lg btn-danger btn-ip hvr-pulse wow bounceIn" data-wow-delay="1s" ata-wow-duration="1s"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Serveur en maintenance"><?php echo $_Serveur_['General']['ipTexte']; ?></button></center>
			<?php } ?>
      </div>
	  <script>
            function myFunction() {
              var copyText = document.getElementById("myInput");
              copyText.select();
			  document.execCommand("copy");
			  toastr["success"]("Vous avez copier l'adresse IP du serveur !", "Succés");
			  toastr.options = {
			  "closeButton": true,
			  "debug": false,
			  "newestOnTop": false,
			  "progressBar": true,
			  "positionClass": "toast-bottom-left",
			  "preventDuplicates": false,
			  "onclick": null,
			  "showDuration": "1000",
			  "hideDuration": "1000",
			  "timeOut": "5000",
			  "extendedTimeOut": "1000",
			  "showEasing": "swing",
			  "hideEasing": "linear",
			  "showMethod": "fadeIn",
			  "hideMethod": "fadeOut"
			}
            }
    </script>
</header>
<br/>
      <div class="container">
          <div class="row">
              <div class="col-xs-6 col-md-4">
                  <center><img class="icone hvr-rotate wow fadeInLeftBig" data-wow-delay="0.5s" src="theme/<?php echo $_Serveur_['General']['theme']; ?>/img/1.png"></center>
                  <h3 class="text-center wow fadeInLeft" data-wow-delay="1s"><?php echo $_Theme_['All']['1']['titre']; ?></h3>
                  <p class="text-center wow fadeInUp" data-wow-delay="2s">
                          <?php echo $_Theme_['All']['1']['texte']; ?>
                  </p>
              </div>
              <div class="col-xs-6 col-md-4">
                      <center><img class="icone hvr-rotate wow fadeInDownBig" data-wow-delay="0.5s" src="theme/<?php echo $_Serveur_['General']['theme']; ?>/img/2.png"></center>
                      <h3 class="text-center wow fadeInLeft" data-wow-delay="1s"><?php echo $_Theme_['All']['2']['titre']; ?></h3>
                      <p class="text-center wow fadeInUp" data-wow-delay="2s">
                          <?php echo $_Theme_['All']['2']['texte']; ?>
                      </p>
              </div>
              <div class="col-xs-6 col-md-4">
                      <center><img class="icone hvr-rotate wow fadeInRightBig" data-wow-delay="0.5s" src="theme/<?php echo $_Serveur_['General']['theme']; ?>/img/3.png"></center>
                      <h3 class="text-center wow fadeInLeft" data-wow-delay="1s"><?php echo $_Theme_['All']['3']['titre']; ?></h3>
                      <p class="text-center wow fadeInUp" data-wow-delay="2s">
                          <?php echo $_Theme_['All']['3']['texte']; ?>
                      </p>
              </div>
          </div>
          <section id="news">
                  <div class="text-center mb-3">
                          <h1 class="text-primary">News</h1>
                          <p class="wow flipInX" data-wow-delay="0.3s">Suivez notre fil d'actualités</p>
                  </div>
            <div class="row">
			<?php 
			$i = 0;
				if(isset($news) && count($news) > 0)
				{
					for($i = 0; $i < 10; $i++)
					{
						if($i < count($news))
						{
							$getCountCommentaires = $accueilNews->countCommentaires($news[$i]['id']);
							$countCommentaires = $getCountCommentaires->rowCount();

							$getcountLikesPlayers = $accueilNews->countLikesPlayers($news[$i]['id']);
							$countLikesPlayers = $getcountLikesPlayers->rowCount();
							$namesOfPlayers = $getcountLikesPlayers->fetchAll();

							$getNewsCommentaires = $accueilNews->newsCommentaires($news[$i]['id']);
							?>
							<div class="<?php if(count($news) == 1) echo 'col-lg-12 col-md-12 col-sm-12'; elseif(count($news) >= 2) echo 'col-lg-6 col-md-6 col-sm 6'; ?>">
								<div class="card hvr-float-shadow w-100 wow zoomInUp" data-wow-duration="2s" data-wow-delay="0.8s" style="margin-bottom:15px;">
									<h5 class="card-header text-uppercase bg-primary" style="color:white;"><small class="text-muted">#<?php echo $news[$i]['id'] - 1; ?></small> <?php echo $news[$i]['titre']; ?></h5><br/>
									<div class="card-block">
										<p class="card-body"><?php echo $news[$i]['message']; ?></p>
										<!--<a href="news.html" class="card-link btn btn-primary">Lire plus</a>-->
										<?php
											if(isset($_Joueur_)) {
												$reqCheckLike = $accueilNews->checkLike($_Joueur_['pseudo'], $news[$i]['id']);
												$getCheckLike = $reqCheckLike->fetch(PDO::FETCH_ASSOC);
												$checkLike = $getCheckLike['pseudo'];
												if($_Joueur_['pseudo'] == $checkLike) {
													echo '<a href="#" data-toggle="modal" data-target="#news'.$news[$i]['id'].'" class="card-link"><i class="fa fa-comment" aria-hidden="true"></i> '.$countCommentaires.' Commentaires</a>';
												} else {
													echo '<a href="?&action=likeNews&id_news='.$news[$i]['id'].'" class="card-link"><i class="fa fa-thumbs-up" aria-hidden="true"></i> J\'aime !</a> | <a href="#" class="card-link" data-toggle="modal" data-target="#news'.$news[$i]['id'].'"><i class="fa fa-comment" aria-hidden="true"></i> '.$countCommentaires.' Commentaires</a>';
												}
											} else {
												echo '<a href="#" data-toggle="modal" class="card-link" data-target="#news'.$news[$i]['id'].'"><i class="fa fa-comment" aria-hidden="true"></i> '.$countCommentaires.' Commentaires</a>';
											}
											
											if($countLikesPlayers != 0) {
												echo '<a href="#" class="card-link"><i class="fa fa-thumbs-up"></i> '.$countLikesPlayers;
												//foreach ($namesOfPlayers as $likesPlayers) {
												//	echo $likesPlayers['pseudo'];
												//}
												echo '</a>';
											}
											unset($Img);
											$Img = new ImgProfil($news[$i]['auteur'], 'pseudo');
											?>
									</div>
									<div class="card-footer text-muted" style="height: 52px;">
										<div style="float: left;"><?php echo 'Posté le '.date('d/m/Y', $news[$i]['date']).' &agrave; '.date('H:i:s', $news[$i]['date']); ?></div>
											<div style="float: right;">Par : <a href="?page=profil&profil=<?php echo $news[$i]['auteur']; ?>" alt="aller voir le profil de l'auteur"><img src="<?=$Img->getImgToSize(24, $width, $height);?>" style="width: <?=$width;?>px; height: <?=$height;?>px;" alt="auteur"/> <?php echo $news[$i]['auteur']; ?></a></div>
									</div>
								</div>
							</div>
							<?php 
							unset($Img);
							if(isset($_Joueur_)) {
								$getNewsCommentaires = $accueilNews->newsCommentaires($news[$i]['id']);
								while($newsComments = $getNewsCommentaires->fetch(PDO::FETCH_ASSOC)) {
									$reqEditCommentaire = $accueilNews->editCommentaire($newsComments['pseudo'], $news[$i]['id'], $newsComments['id']);
									$getEditCommentaire = $reqEditCommentaire->fetch(PDO::FETCH_ASSOC);
									$editCommentaire = $getEditCommentaire['commentaire'];
									if($newsComments['pseudo'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1) {  ?>
										<div class="modal fade" id="news<?php echo $news[$i]['id'].'-'.$newsComments['id'].'-edit'; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-support">
												<div class="modal-content modal-lg">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<center><h4 class="modal-title" id="myModalLabel">Edition du commentaire</h4></center>
													</div>
													<form action="?&action=edit_news_commentaire&id_news=<?php echo $news[$i]['id'].'&auteur='.$newsComments['pseudo'].'&id_comm='.$newsComments['id']; ?>" method="post">
														<div class="modal-body">
															<textarea name="edit_commentaire" class="form-control" rows="3" style="resize: none;" maxlength="255" required><?php echo $editCommentaire; ?></textarea>
														</div>
														<div class="modal-footer text-center">
															<h4><b>Minimum de 6 caractères<br>Maximum de 255 caractères</b></h4><br>
															<button type="submit" class="btn btn-primary btn-block">Valider la modification</button>
														</div>
													</form>
												</div>
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
										<?php }
									}
								} ?>
							<div class="modal fade" id="<?php echo "news".$news[$i]['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-support">
								<div class="modal-content modal-lg">
									<div class="modal-header">
										<h4 class="modal-title" id="myModalLabel"><b>News: <?php echo $news[$i]['titre']; ?></b></h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div> <!-- Modal-Header -->
									<div class="modal-body">
									<br>
									<?php
									$getNewsCommentaires = $accueilNews->newsCommentaires($news[$i]['id']);
									while($newsComments = $getNewsCommentaires->fetch(PDO::FETCH_ASSOC)) {
										if(isset($_Joueur_)) {
											
											$getCheckReport = $accueilNews->checkReport($_Joueur_['pseudo'], $newsComments['pseudo'], $news[$i]['id'], $newsComments['id']);
											$checkReport = $getCheckReport->rowCount();

											$getCountReportsVictimes = $accueilNews->countReportsVictimes($newsComments['pseudo'], $news[$i]['id'], $newsComments['id']);
											$countReportsVictimes = $getCountReportsVictimes->rowCount();
										}
										unset($Img);
										$Img = new ImgProfil($newsComments['pseudo'], 'pseudo');
										?>

										<div class="container">
											<div class="row">
													<div class="col-md-4 col-lg-4 col-sm-12">
  															<h4><?php echo '<B> '.$newsComments['pseudo'].'</B>'; ?></h4>
															<img class="img_news" src="<?=$Img->getImgToSize(64, $width, $height);?>" style="margin-left: auto; margin-right: auto; display: block;  width: <?=$width;?>px; height: <?=$height;?>px;" alt="><?php echo '<B> '.$newsComments['pseudo'].'</B>'; ?> photo de profil" />
															<div class="card-footer text-muted">
																<?php echo '<B>Le '.date('d/m', $newsComments['date_post']).' à '.date('H:i:s', $newsComments['date_post']).'</B>'; ?></p>
															</div>
														<?php if(isset($_Joueur_)) { ?>
															<span style="color: red;"><?php if($newsComments['nbrEdit'] != "0"){echo 'Nombre d\'édition: '.$newsComments['nbrEdit'].' | ';}if($countReportsVictimes != "0"){echo '<B>'.$countReportsVictimes.' Signalement</B> |';} ?></span>
															<div class="dropdown">
																<button class="btn btn-info" data-toggle="dropdown" style="font-size: 10px;">Action <b class="caret"></b></button>
																<ul class="dropdown-menu">
																	<?php if($newsComments['pseudo'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1) {
																		echo '<li><a href="#" data-toggle="modal" data-target="#news'.$news[$i]['id'].'-'.$newsComments['id'].'-edit">Editer</a></li>';
																		echo '<li><a href="?&action=delete_news_commentaire&id_comm='.$newsComments['id'].'&id_news='.$news[$i]['id'].'&auteur='.$newsComments['pseudo'].'">Supprimer</a></li>';
																	}
																	if($newsComments['pseudo'] != $_Joueur_['pseudo']) {
																		if($checkReport == "0") {
																			echo '<li><a href="?&action=report_news_commentaire&id_news='.$news[$i]['id'].'&id_comm='.$newsComments['id'].'&victime='.$newsComments['pseudo'].'">Signaler</a></li>';
																		} else {
																			echo '<li><a href="#">Déjà report</a></li>';
																		}
																	} ?>
																</ul>
															</div> <!-- dropdown -->
															<?php } ?>
													</div>
													<div class="col-md-6 col-lg-6 col-sm-12">
														<?php $com = espacement($newsComments['commentaire']); echo BBCode($com, $bddConnection); ?>
													</div>
											</div> <!-- Ticket-Commentaire-->
										</div> <!-- Panel Panel-Default -->
											<?php } ?>
									</div> <!-- Modal-Body -->
										<?php
										if(isset($_Joueur_)) { ?>
											<div class="modal-footer w-100">
												<form action="?&action=post_news_commentaire&id_news=<?php echo $news[$i]['id']; ?>" method="post" class="w-100">
													<textarea name="commentaire" class="form-control w-100" required></textarea>
													<h4 class="text-center"><b>Minimum de 6 caractères<br>Maximum de 255 caractères</b></h4>
												<br>
												<center><button type="submit" class="btn btn-primary btn-block">Commenter</button></center>
												</form>
											</div>
									<?php } else { ?>
										<div class="modal-footer text-center">
											<div class="alert alert-danger">Veuillez-vous connecter pour mettre un commentaire.</div>
											<a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning">Connexion</a>
										</div> <!-- Modal-Footer -->
										<?php } ?>
									</div><!-- Modal-Footer -->
									</div> <!-- Modal-Content -->
						</div>

							<?php }  }
						}
							else
								echo '<div class="col-md-12 col-lg-12 col-sm-12"><div class="alert alert-warning"><p class="text-center">Aucune news n\'a été créée à ce jour...</p></div></div>'; ?>
            </div>
        </div>
    </section>
