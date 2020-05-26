<?php
class JoueurManager
{
    public static function add(Joueur $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("INSERT INTO joueurs (nom,prenom,licence,etat) VALUES (:nom,:prenom,:licence,:etat)");
        $q->bindValue(":nom", $obj->getNom());
        $q->bindValue(":prenom", $obj->getPrenom());
        $q->bindValue(":licence", $obj->getLicence());
        $q->bindValue(":etat", $obj->getEtat());
        $q->execute();
    }

    public static function update(Joueur $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("UPDATE joueurs SET nom=:nom, prenom=:prenom, licence=:licence, etat=:etat WHERE id=:id");
        $q->bindValue(":nom", $obj->getNom());
        $q->bindValue(":prenom", $obj->getPrenom());
        $q->bindValue(":licence", $obj->getLicence());
        $q->bindValue(":etat", $obj->getEtat());
        $q->bindValue(":id", $obj->getId());
        $q->execute();
    }

    public static function delete(Joueur $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM joueurs WHERE id=" . $obj->getId());
    }

    public static function findById($id)
    {
        $db = DbConnect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM joueurs WHERE id=" . $id);
        $results = $q->fetch(PDO::FETCH_ASSOC);
        if ($results != false) {
            return new Joueur($results);
        } else {
            return false;
        }
    }

    public static function getList()
    {
        $db = DbConnect::getDb();
        $tab = [];
        $q = $db->query("SELECT * FROM joueurs");
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $tab[] = new Joueur($donnees);
            }
        }
        return $tab;
    }

}
