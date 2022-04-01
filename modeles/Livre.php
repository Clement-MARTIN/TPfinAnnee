<?php

class Livre
{
    /**Début déclaration variable******************************************************************************************/
    /*** @var int*/
    private $num;

    /*** @var int*/
    private $numAuteur;

    /*** @var int*/
    private $numGenre;

    /*** @var string*/
    private $isbn;

    /*** @var string*/
    private $titre;

    /*** @var float*/
    private $prix;

    /*** @var string*/
    private $editeur;

    /*** @var int*/
    private $annee;

    /*** @var string*/
    private $langue;
    /**Fin déclaration variable******************************************************************************************/

    /**Début GET et SET******************************************************************************************/

    /*** @return int
     */
    public function getNum()
    {
        return $this->num;
    }

    /*** @param int $num
     * @return $this
     */
    public function setNum(int $num)
    {
        $this->num = $num;
        return $this;
    }


    /*** @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /*** @param string $isbn
     * @return $this
     */
    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;
        return $this;
    }

    /*** @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /*** @param string $titre
     * @return $this
     */
    public function setTitre(string $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    /*** @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /*** @param float $prix
     * @return $this
     */
    public function setPrix(float $prix): self
    {
        $this->prix = $prix;
        return $this;
    }

    /*** @return string
     */
    public function getEditeur()
    {
        return $this->editeur;
    }

    /*** @param string $editeur
     * @return $this
     */
    public function setEditeur(string $editeur): self
    {
        $this->editeur = $editeur;
        return $this;
    }

    /*** @return int
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /*** @param int $annee
     * @return $this
     */
    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;
        return $this;
    }

    /*** @return string
     */
    public function getLangue()
    {
        return $this->langue;
    }

    /*** @param string $langue
     * @return $this
     */
    public function setLangue(string $langue): self
    {
        $this->langue = $langue;
        return $this;
    }

    /*** @return Auteur
     */
    public function getnumAuteur(): Auteur
    {
        return Auteur::findByid($this->numAuteur);
    }

    /*** @param Auteur $auteur
     * @return $this
     */
    public function setnumAuteur(Auteur $auteur): self
    {
        $this->numAuteur = $auteur->getNum();
        return $this;
    }

    /*** @return Genre
     */
    public function getnumGenre(): Genre
    {
        return Genre::findByid($this->numGenre);
    }

    /*** @param Genre $genre
     * @return $this
     */
    public function setnumGenre(Genre $genre): self
    {
        $this->numGenre = $genre->getNum();
        return $this;
    }

    /**Fin GET et SET******************************************************************************************/

    /*** @param string $titre
     * @param string $auteur
     * @param string $genre
     * @return array
     */
    public static function findAll($titre = "", $auteur = "Tous", $genre = "Tous"): array
    {
        /*** Requète qui me donne le numero, le code, le titre, le prix, l'editeur, la date, la langue du livre, le nom et le prenom de l'auteur*/
        $textRequete = "select l.num as 'numero', isbn as 'code', titre as 'titreL', prix as 'prixL', editeur 'editeurL', annee as 'date', langue as 'langueL', a.nom as 'nomA', a.prenom as 'prenomA', g.libelle as 'libGenre' 
                        from livre l, auteur a, genre g 
                        where l.numAuteur=a.num and l.numGenre=g.num";
        if ($titre != "") {
            $textRequete .= " and titre LIKE '%" . $titre . "%'";
        }
        if ($auteur != "Tous") {
            $textRequete .= " and a.num = " . $auteur;
        }
        if ($genre != "Tous") {
            $textRequete .= " and g.num = " . $genre;
        }

        $textRequete .= " order by  titre";
        $req = MonPdo::getInstance()->prepare($textRequete);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        return $lesResultats = $req->fetchAll();
    }

    /**Trouve un livre en fonction d'un numeri
     * @param int $id
     * @return Livre
     */
    public static function findByid(int $id): Livre
    {
        $req = MonPdo::getInstance()->prepare("select * from livre where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'livre');
        $req->bindParam(':id', $id);
        $req->execute();
        return $leResultat = $req->fetch();
    }

    /*** @param Livre $livre
     * @return int
     */
    public static function add(Livre $livre): int
    {
        $req = MonPdo::getInstance()->prepare("insert into livre (isbn, titre, prix, editeur, annee, langue, numAuteur, numGenre) values (:isbn, :titre, :prix, :editeur, :annee, :langue, :numAuteur, :numGenre)");
        $isbn = $livre->getIsbn();
        $titre = $livre->getTitre();
        $prix = $livre->getPrix();
        $editeur = $livre->getEditeur();
        $annee = $livre->getAnnee();
        $langue = $livre->getLangue();
        $numAuteur = $livre->numAuteur;
        $numGenre = $livre->numGenre;
        $req->bindParam(':isbn', $isbn);
        $req->bindParam(':titre', $titre);
        $req->bindParam(':prix', $prix);
        $req->bindParam(':editeur', $editeur);
        $req->bindParam(':annee', $annee);
        $req->bindParam(':langue', $langue);
        $req->bindParam(':numAuteur', $numAuteur);
        $req->bindParam(':numGenre', $numGenre);
        $nb = $req->execute();
        return $nb;
    }

    /*** @param Livre $livre
     * @return int
     */
    public static function update(Livre $livre): int
    {
        $req = MonPdo::getInstance()->prepare("update livre set isbn = :isbn, titre = :titre, prix = :prix, editeur = :editeur, annee = :annee, langue = :langue, numAuteur= :numAuteur, numGenre = :numGenre where num= :id");
        $isbn = $livre->getIsbn();
        $titre = $livre->getTitre();
        $prix = $livre->getPrix();
        $editeur = $livre->getEditeur();
        $annee = $livre->getAnnee();
        $langue = $livre->getLangue();
        $numAuteur = $livre->numAuteur;
        $numGenre = $livre->numGenre;
        $num = $livre->getNum();
        $req->bindParam(':id', $num);
        $req->bindParam(':isbn', $isbn);
        $req->bindParam(':titre', $titre);
        $req->bindParam(':prix', $prix);
        $req->bindParam(':editeur', $editeur);
        $req->bindParam(':annee', $annee);
        $req->bindParam(':langue', $langue);
        $req->bindParam(':numAuteur', $numAuteur);
        $req->bindParam(':numGenre', $numGenre);
        return $nb = $req->execute();
    }

    /*** @param Livre $livre
     * @return int
     */
    public static function delete(Livre $livre): int
    {
        $req = MonPdo::getInstance()->prepare("delete from livre where num= :id");
        $num = $livre->getNum();
        $req->bindParam(':id', $num);
        return $nb = $req->execute();
    }

    /**Fonction qui permet de faire le graph à l'acceuil, qui compte le nombre de genre dans la table genre
     * @return array
     */
    public static function nbgenre() :array
    {
        $req=MonPdo::getInstance()->prepare("select g.libelle, count(g.libelle) as 'nombreGenre'  from livre l, genre g where l.numGenre=g.num group by libelle;");
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $lesResultats=$req->fetchAll();
        $dataPoints=[];
        foreach ($lesResultats as $leResultat) {
            $dataPoints[]=["label"=>"$leResultat->libelle","y"=>intval($leResultat->nombreGenre)];
        }
        return  $dataPoints;

    }

    /**Fonction qui compte le nombre d'auteur dans la table auteur
     * @return int
     */
    public static function nbLivre() :int //
    {
        $req=MonPdo::getInstance()->prepare("select  count(*) as 'nombreAuteur'  from livre");
        $req->execute();
        $leResultat=$req->fetch();

        return  $leResultat[0];
    }
}

?>

