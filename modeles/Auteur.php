<?php

class Auteur
{
    /**Début déclaration variable******************************************************************************************/
    /*** @var int */
    private $num;

    /*** @var int */
    private $numNationalite;

    /*** @var string */
    private $nom;

    /*** @var string */
    private $prenom;
    /**Fin déclaration variable******************************************************************************************/

    /**Début GET et SET******************************************************************************************/
    /*** @return int
     */
    public function getNum()
    {
        return $this->num;
    }

    public function setNum(int $num)
    {
        $this->num = $num;

        return $this;
    }

    /*** @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /*** @param string $nom
     * @return $this
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /*** @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /*** @param string $prenom
     * @return $this
     */
    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    /*** @return Nationalite
     */
    public function getnumNationalite(): Nationalite
    {
        return Nationalite::findById($this->numNationalite);
    }

    /*** @param Nationalite $nationalite
     * @return $this
     */
    public function setNumNationalite(Nationalite $nationalite): self
    {
        $this->numNationalite = $nationalite->getNum();
        return $this;
    }
    /**Fin GET et SET******************************************************************************************/

    /*** @param string $nom
     * @param string $prenom
     * @param string $Nationalite
     * @return array
     */
    public static function findAll($nom = "", $prenom = "", $Nationalite = "Tous"): array
    {
        /*** Requete pour trouver le num, le nom, prenom, et le libelle d'un auteur*/
        $textRequete = "select  a.num, nom, prenom, n.libelle as 'libNationalite' from auteur a, nationalite n where a.numNationalite=n.num";
        if ($nom != "") {
            $textRequete .= " and nom like '%" . $nom . "%'";
        }
        if ($prenom != "") {
            $textRequete .= " and prenom LIKE '%" . $prenom . "%'";
        }
        if ($Nationalite != "Tous") {
            $textRequete .= " and n.num = " . $Nationalite;
        }
        $textRequete .= " order by  nom";
        $req = MonPdo::getInstance()->prepare($textRequete);
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Auteur');
        $req->execute();
        return $lesResultats = $req->fetchAll();
    }

    /** Trouve un auteur en fonction d'un num donné
     * @param int $id
     * @return Auteur
     */
    public static function findById(int $id): Auteur
    {
        $req = MonPdo::getInstance()->prepare("select * from auteur where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'auteur');
        $req->bindParam(':id', $id);
        $req->execute();
        return $leResultat = $req->fetch();
    }

    /**Ajoute un auteur avec les parametres donné
     * @param Auteur $auteur
     * @return int
     */
    public static function add(Auteur $auteur): int
    {
        $req = MonPdo::getInstance()->prepare("insert into auteur (nom, prenom, numNationalite) Values (:nom, :prenom, :numNationalite)");
        $nom = $auteur->getNom();
        $prenom = $auteur->getPrenom();
        $numNationalite = $auteur->numNationalite;
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':numNationalite', $numNationalite);
        return $nb = $req->execute();
    }

    /**modifie un auteur en modifiant son nom, prenom, et sa nationalité
     * @param Auteur $auteur
     * @return int
     */
    public static function update(Auteur $auteur): int
    {
        $req = MonPdo::getInstance()->prepare("update auteur set nom = :nom, prenom = :prenom, numNationalite= :numNationalite where num= :id");
        $num = $auteur->getNum();
        $nom = $auteur->getNom();
        $prenom = $auteur->getPrenom();
        $numNationalite = $auteur->numNationalite;
        $req->bindParam(':id', $num);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':numNationalite', $numNationalite);
        return $nb = $req->execute();
    }

    /**Supprime un auteur grâce à un num qui lui est propre
     * @param Auteur $auteur
     * @return int
     */
    public static function delete(Auteur $auteur): int
    {
        $req = MonPdo::getInstance()->prepare("delete from auteur where num= :id");
        $num = $auteur->getNum();
        $req->bindParam(':id', $num);
        return $nb = $req->execute();

    }

    /**Fonction pour compter le nombre d'auteur dans la table auteur
     * @return int
     */
    public static function nbAuteur() :int //
    {
        $req=MonPdo::getInstance()->prepare("select  count(*) as 'nombreAuteur'  FROM Auteur");
        $req->execute();
        $leResultat=$req->fetch();

        return  $leResultat[0];
    }
}

?>



