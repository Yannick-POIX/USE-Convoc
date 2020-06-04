<?php
// Récupération de la liste des joueurs
$playersList  =  JoueurManager::getList();

    echo '  <div id="list">     
                <div class="line">
                    <div class="block headList">NOM</div>
                    <div class="block headList">PRENOM</div>
                    <div class="block headList">LICENCE</div>
                </div>';
foreach($playersList as $elt)
{
    echo        '<div class="line">
                    <div class="block contentList">' . $elt->getNom() . '</div>
                    <div class="block contentList">' . $elt->getPrenom() . '</div>
                    <div class="block contentList">' . $elt->getLicence() . '</div>
                </div>';
}
            
    echo'   <div class="btn">
                <a href="?a=load">Mettre à jour</a>
            </div>';