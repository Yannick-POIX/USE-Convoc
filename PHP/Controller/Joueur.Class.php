<?php
class Joueur
{
    private $_id;
    private $_nom;
    private $_prenom;
    private $_licence;
    private $_etat;

    public function getId()
    {
        return $this->_id;
    }
    public function setId($_id)
    {
        return $this->_id = $_id;
    }
    public function getNom()
    {
        return $this->_nom;
    }
    public function setNom($_nom)
    {
        return $this->_nom = $_nom;
    }
    public function getPrenom()
    {
        return $this->_prenom;
    }
    public function setPrenom($_prenom)
    {
        return $this->_prenom = $_prenom;
    }
    public function getLicence()
    {
        return $this->_licence;
    }
    public function setLicence($_licence)
    {
        return $this->_licence = $_licence;
    }
    public function getEtat()
    {
        return $this->_etat;
    }
    public function setEtat($_etat)
    {
        return $this->_etat = $_etat;
    }

    public function __construct(array $options = [])
    {
        if (!empty($options)) {
            $this->hydrate($options);
        }
    }

    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $methode = "set" . ucfirst($key);
            if (is_callable(([$this, $methode]))) {
                $this->$methode($value);
            }
        }
    }

}
