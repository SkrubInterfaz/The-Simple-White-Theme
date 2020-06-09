<div class="heading">
		<h1 class="text-center wow fadeInDown"  data-wow-delay="2.1s" style="color:white;">Membres inscrits</h1>
	</div>
<section class="layout" id="page"><br/>
    <div class="container">
		<div class="alert alert-info alert-dismissable" role="alert">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
		Vous retrouverez sur cette page la liste des membres inscrit sur notre site web</div>
        <br>
        <?php 
        $Membres = new MembresPage($bddConnection);
        if(isset($_GET['page_membre']))
        {
        	$page = htmlentities($_GET['page_membre']);
        	$membres = $Membres->getMembres($page);
        }
        else
        {
        	$page = 1;
        	$membres = $Membres->getMembres();
        }
        ?>
        <div class="row">
        	<div class="col-md-12">
        		<input type="text" onChange="rechercheAjaxMembre();" class="form-control" id="recherche" placeholder="Entrée un pseudo . (Appuyez sur 'Entrée' pour valider)" />
        	</div>
        </div>
        <table class="table table-hover table-striped">
        	<thead>
        		<tr>
        			<th scope="col">#ID</th>
        			<th scope="col">Pseudo</th>
        			<th scope="col">Grade Site</th>
        			<th scope="col">Jetons</th>
        		</tr>
        	</thead>
        	<tbody id="tableMembre">
	        	<?php
	        		foreach($membres as $value)
	        		{
	        			$Img = new ImgProfil($value['id']);
	        			?><tr>
	        				<td scope="row"><a href="?page=profil&profil=<?=$value['pseudo'];?>" style="color: inherit;">#<?=$value['id'];?></a></td>
	        				<td><a href="?page=profil&profil=<?=$value['pseudo'];?>" style="color: inherit;"><img src='<?=$Img->getImgToSize(32, $width, $height);?>' style='width: <?=$width;?>px; height: <?=$height;?>px;' alt='Profil' /> <?=$value["pseudo"];?></a></td>
	        				<td><a href="?page=profil&profil=<?=$value['pseudo'];?>" style="color: inherit;"><?=$Membres->gradeJoueur($value["pseudo"]);?></a></td>
	        				<td><a href="?page=profil&profil=<?=$value['pseudo'];?>" style="color: inherit;"><?=$value['tokens'];?></a></td>
	        			</tr>
	        			<?php
	        		}
	        	?>
        	</tbody>
        </table>
        <br>
        <nav aria-label="Page navigation example">
          <ul class="pagination">
		  	<?php if($page > 1)
		  	echo '<li class="page-item">
		      <a class="page-link" href="?page=membre&page_membre='. ($page-1) .'" aria-label="Précédente">
		        <span aria-hidden="true">&laquo;</span>
		        <span class="sr-only">Précédente</span>
		      </a>
		    </li>';
		    for($i = 1; $i <= $Membres->nbPages; $i++)
		    {
		    	 ?><li class="page-item"><a class="page-link" href="?page=membre&page_membre=<?=$i;?>"><?=$i;?></a></li><?php
		  	}
			if($page < $Membres->nbPages)
				echo '<li class="page-item">
		      <a class="page-link" href="?page=membre&page_membre='. ($page+1) .'" aria-label="Suivante">
		        <span aria-hidden="true">&raquo;</span>
		        <span class="sr-only">Suivante</span>
		      </a>
		    </li>';
		    ?>
		  </ul>
		</nav>
    </div>
</section>
<script>
	function rechercheAjaxMembre()
	{
		$("#tableMembre").html("<img src='theme/<?=$_Serveur_['General']['theme'];?>/img/gif-search.gif'>Recherche en cours ...");
		$.ajax({
			url: 'index.php?action=rechercheMembre',
			type: 'POST',
			data: 'ajax=true&recherche='+$('#recherche').val(),
			success: function(code, statut){
				$("#tableMembre").html(code);
			}
		});
	}
</script>