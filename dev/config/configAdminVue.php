<?php include('theme/'.$_Serveur_['General']['theme'].'/config/configTheme.php');
?>
<script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/config/jscolor.js"></script>
<div class="col-xs-12 text-center">
    <div class="panel panel-default cmw-panel">
        <div class="panel-heading cmw-panel-header">
            <h3 class="panel-title"><strong>Configuration du thème</strong></h3>
        </div>
        <div class="panel-body">
            <form method="POST" action="?&action=configTheme">
                <span class="text-muted">Version théme: 1.7.3 - (2.1)</span>
                <div class="row">
                    <label class="control-label">Google (Token de Validation)</label>
                    <input type="text" class="form-control" name="google" value="<?php echo $_Theme_['All']['Seo']['google']; ?>">
                </div>
                <div class="row">
                    <label class="control-label">Bing / Yahoo (Token de Validation)</label>
                    <input type="text" class="form-control" name="bing" value="<?php echo $_Theme_['All']['Seo']['bing']; ?>">
                </div>
                <center>Open Graph Settings</center>
                <style>
                .open-g-bg{
                    background-color: #32363C;
                }
                </style>
                <div class="open-g-bg">
                <div class="panel-body">
                    <div class="row">
                        <input type="text" class="form-control" name="name" value="<?php echo $_Theme_['All']['Seo']['name']; ?>" style="border: none !important;background-color: rgba(255, 255, 255, 0);color: #0993CF;">
                        <br/>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="description" value="<?php echo $_Theme_['All']['Seo']['description']; ?>" style="border: none !important;background-color: rgba(255, 255, 255, 0);color: #ABADAF;">
                    </div>
                    <div class="col-md-4">
                        <img src="<?php echo $_Theme_['All']['Seo']['image']; ?>" style="max-width: 82px;">
                        <br/>
                        <input type="text" class="form-control-file" name="image" value="<?php echo $_Theme_['All']['Seo']['image']; ?>" style="border: none !important;background-color: rgba(255, 255, 255, 0);color: #f4f4f4;">
                    </div>
                </div><br/>
                </div>
                <input name="color" class="jscolor" value="<?php echo $_Theme_['All']['Seo']['color']; ?>" style="width: 100%">
                </div>
                <br/>
                <center>Social Settings</center>
                <br/>
                <div class="row">
                    <label class="control-label">Facebook (URL de votre page Facebook)</label>
                    <input type="text" class="form-control" name="facebook" value="<?php echo $_Theme_['Pied']['facebook']; ?>">
                </div>
                <div class="row">
                    <label class="control-label">Twitter (URL de votre compte Twitter)</label>
                    <input type="text" class="form-control" name="twitter" value="<?php echo $_Theme_['Pied']['twitter']; ?>">
                </div>
                <div class="row">
                    <label class="control-label">Youtube (URL de votre page Youtube)</label>
                    <input type="text" class="form-control" name="youtube" value="<?php echo $_Theme_['Pied']['youtube']; ?>">
                </div>
                <div class="row">
                    <label class="control-label">Discord (URL de votre serveur Discord)</label>
                    <input type="text" class="form-control" name="discord" value="<?php echo $_Theme_['Pied']['discord']; ?>">
                </div>
                <br/>
                <center>Acceuil settings</center>
                <br/>
                <div class="row">
                    <label class="control-label">Titre (1)</label>
                    <input type="text" class="form-control" name="titre1" value="<?php echo $_Theme_['All']['1']['titre']; ?>">
                </div>
                <div class="row">
                    <label class="control-label">Texte (1)</label>
                    <input type="text" class="form-control" name="texte1" value="<?php echo $_Theme_['All']['1']['texte']; ?>">
                </div>
                <div class="row">
                    <label class="control-label">Titre (2)</label>
                    <input type="text" class="form-control" name="titre2" value="<?php echo $_Theme_['All']['2']['titre']; ?>">
                </div>
                <div class="row">
                    <label class="control-label">Texte (2)</label>
                    <input type="text" class="form-control" name="texte2" value="<?php echo $_Theme_['All']['2']['texte']; ?>">
                </div>
                <div class="row">
                    <label class="control-label">Titre (3)</label>
                    <input type="text" class="form-control" name="titre3" value="<?php echo $_Theme_['All']['3']['titre']; ?>">
                </div>
                <div class="row">
                    <label class="control-label">Texte (3)</label>
                    <input type="text" class="form-control" name="texte3" value="<?php echo $_Theme_['All']['3']['texte']; ?>">
                </div>
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
