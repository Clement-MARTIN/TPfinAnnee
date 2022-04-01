<?php
class Genre {
    /**Début déclaration variable******************************************************************************************/

    /**numéro du continent @var int*/
    private $num;
    /** @var Libelle du continent @var string */
    private $libelle;

    /**Fin déclaration variable******************************************************************************************/

    /**Début GET et SET******************************************************************************************/

    /*** @return mixed */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * @param int $num
     */
    public function setNum(int $num)
    {
        $this->num = $num;
    }

    /** Lit le libelle  @return string*/
    public function getLibelle() : string
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     * @return $this
     */
    public function setLibelle(string $libelle) : self
    {
        $this->libelle = $libelle;
        return $this;
    }

    /**Fin GET et SET******************************************************************************************/

    /**Retour tous les genres
     * @return array
     */
    public static function findAll() : array
    {
        $req=MonPdo::getInstance()-> prepare("Select * from genre");
        $req-> setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Genre');
        $req->execute();
        $lesGenres = $req->fetchAll();
        return $lesGenres;
    }

    /*** Requète qui me donne le numero du continent le libelle du continent
     * @param int $id
     * @return Genre
     */
    public static function findById (int $id) : Genre
    {
        $req=MonPdo::getInstance()-> prepare("Select * from genre where num = :id");
        $req-> setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Genre');
        $req-> bindParam(':id', $id);
        $req->execute();
        $leResultat = $req->fetch();
        return $leResultat;
    }

    /**Ajoute un genre
     * @param Genre $genre
     * @return int
     */
    public static function add(Genre $genre) :int
    {
        $req=MonPdo::getInstance()-> prepare("insert into genre(libelle) values(:libelle)");
        $libelle = $genre->getLibelle();
        $req-> bindParam(':libelle',$libelle);
        $nb=$req->execute();
        return $nb;
    }

    /**Ajoute un genre
     * @param Genre $genre
     * @return int
     */
    public static function update(Genre $genre) : int
    {
        $req=MonPdo::getInstance()-> prepare("update genre set libelle =:libelle where num =:id");
        $num=$genre->getNum();
        $libelle=$genre->getLibelle();
        $req-> bindParam(':id', $num );
        $req-> bindParam(':libelle', $libelle);
        $nb=$req->execute();
        return $nb;
    }

    /**Supprime un genre
     * @param Genre $genre
     * @return int
     */
    public static function delete(Genre $genre) : int
    {
        $req=MonPdo::getInstance()-> prepare("delete from genre where num = :id");
        $num=$genre->getNum();
        $req-> bindParam(':id', $num);
        $nb=$req->execute();
        return $nb;
    }

    /**Fonction qui permet de compter le nombre de genre dans la table genre
     * @return int
     */
    public static function nbGenre() :int //
    {
        $req=MonPdo::getInstance()->prepare("SELECT  COUNT(*) as 'nombreGenre'  FROM genre");
        $req->execute();
        $leResultat=$req->fetch();

        return  $leResultat[0];

    }

}