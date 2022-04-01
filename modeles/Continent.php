<?php
class Continent {
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

    /**Retour tous les continents
     * @return Continent[]
     */
    public static function findAll() : array
    {
        /*** Requète qui me donne un continent avec numero*/
        $req=MonPdo::getInstance()-> prepare("Select * from continent");
        $req-> setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Continent');
        $req->execute();
        $lesContinents = $req->fetchAll();
        return $lesContinents;
    }

    /** Trouve continent par son num
     * @param int $id nb conient
     * @return Continent continent trouvé
     */
    public static function findById (int $id) : Continent
    {
        $req=MonPdo::getInstance()-> prepare("Select * from continent where num = :id");
        $req-> setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Continent');
        $req-> bindParam(':id', $id);
        $req->execute();
        $leResultat = $req->fetch();
        return $leResultat;
    }

    /**Ajoute un continent
     * @param Continent $continent
     * @return int resultat (1 succes / 0 echec)
     */
    public static function add(Continent $continent) :int
    {
        $req=MonPdo::getInstance()-> prepare("insert into continent(libelle) values(:libelle)");
        $libelle = $continent->getLibelle();
        $req-> bindParam(':libelle',$libelle);
        $nb=$req->execute();
        return $nb;
    }

    /**Modif continent grâce à un num qui lui est propre
     * @param Continent $continent
     * @return int
     */
    public static function update(Continent $continent) : int
    {
        $req=MonPdo::getInstance()-> prepare("update continent set libelle =:libelle where num =:id");
        $num=$continent->getNum();
        $libelle=$continent->getLibelle();
        $req-> bindParam(':id', $num );
        $req-> bindParam(':libelle', $libelle);
        $nb=$req->execute();
        return $nb;
    }

    /**Supprime un continent
     * @param Continent $continent
     * @return int
     */
    public static function delete(Continent $continent) : int
    {
        $req=MonPdo::getInstance()-> prepare("delete from continent where num = :id");
        $num=$continent->getNum();
        $req-> bindParam(':id', $num);
        $nb=$req->execute();
        return $nb;
    }


}