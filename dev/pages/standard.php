    <?php if($pages['titre'] == "" && $pageContenu[$j][0] == ""){ 
        header('Location: ?page=erreur&erreur=8000000');
    } else { ?>
    <?php } ?>
    <div class="heading">
        <h1 class="text-center wow fadeInDown"  data-wow-delay="2.1s" style="color:white;"><?php echo $pages['titre']; ?></h1>
    </div>
    <section class="layout" id="page">
    <div class="container"><br/>
    			<?php for($j = 0; $j < count($pages['tableauPages']); $j++) { ?>
    				<h3><?php echo $pageContenu[$j][0]; ?></h3>
    				<div><?php echo $pageContenu[$j][1]; ?></div>		
    			<?php } ?>
    </div>
</section>