<?php

class Nationalite
{
    /**Début déclaration variable******************************************************************************************/
    /*** @var int */
    private $num;

    /*** Libelle de Nationalite* @var string */
    private $libelle;

    /*** num du continent* @var int */
    private $numContinent;
    /**Fin déclaration variable******************************************************************************************/

    /**Début GET et SET******************************************************************************************/
    /*** @return int */
    public function getNum()
    {
        return $this->num;
    }

    public function setNum(int $num)
    {
        $this->num = $num;
        return $this;
    }

    /*** @return string */
    public function getLibelle(): string
    {
        return $this->libelle;
    }

    /*** @param string $libelle
     * @return $this
     */
    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;
        return $this;
    }


    /*** Renvoie l'objet continent associé
     * @return Continent
     */
    public function getNumContinent(): Continent
    {
        return Continent::findById($this->numContinent);
    }

    /*** Ecrit le num continent
     * @param Continent $continent
     * @return  self
     */
    public function setNumContinent(Continent $continent): self
    {
        $this->numContinent = $continent->getNum();
        return $this;
    }

    /**Fin GET et SET******************************************************************************************/

    /**
     * @param string $libelle
     * @param string $Continent
     * @return array
     */
    public static function findAll($libelle = "", $Continent = "Tous"): array
    {
        /*** Requète qui me donne le numero d'une nationalité, son numContinent et le libelle d'un nationalité*/
        $textRequete = "select n.num as numero, n.libelle as 'libNation', c.libelle as 'libContinent' 
                        from nationalite n, Continent c 
                        where n.numContinent=c.num ";

        if ($libelle != "") {
            $textRequete .= " and n.libelle LIKE '%" . $libelle . "%'";
        }
        if ($Continent != "Tous") {
            $textRequete .= " and c.num = " . $Continent;
        }

        $textRequete .= " order by n.libelle ";
        $req = MonPdo::getInstance()->prepare($textRequete);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        return $lesResultats = $req->fetchAll();
    }

    /**Trouve un nationalité grâce à un nuym qui lui est propre
     * @param int $id
     * @return Nationalite
     */
    public static function findById(int $id): Nationalite
    {
        $req = MonPdo::getInstance()->prepare("select * from nationalite where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Nationalite');
        $req->bindParam(':id', $id);
        $req->execute();
        return $leResultat = $req->fetch();
    }

    /**Ajoute une natianalité avec un nom
     * @param Nationalite $nationalite
     * @return int
     */
    public static function add(Nationalite $nationalite): int
    {
        $req = MonPdo::getInstance()->prepare("insert into nationalite (libelle, numContinent) values (:libelle, :numContinent)");
        $libelle = $nationalite->getLibelle();
        $numcontinent = $nationalite->numContinent;
        $req->bindParam(':libelle', $libelle);
        $req->bindParam(':numContinent', $numcontinent);
        $nb = $req->execute();
        return $nb;
    }

    /**Modifie le nom d'une nationalité
     * @param Nationalite $nationalite
     * @return int
     */
    public static function update(Nationalite $nationalite): int
    {
        $req = MonPdo::getInstance()->prepare("update nationalite set libelle = :libelle, numContinent= :numContinent where num= :id");
        $num = $nationalite->getNum();
        $numcontinent = $nationalite->numContinent;
        $libelle = $nationalite->getLibelle();
        $req->bindParam(':id', $num);
        $req->bindParam(':libelle', $libelle);
        $req->bindParam(':numContinent', $numcontinent);
        return $nb = $req->execute();
    }

    /**Supprime une nationalité avec un num qui lui est propre
     * @param Nationalite $nationalite
     * @return int
     */
    public static function delete(Nationalite $nationalite): int
    {
        $req = MonPdo::getInstance()->prepare("delete from nationalite where num= :id");
        $num = $nationalite->getNum();
        $req->bindParam(':id', $num);
        return $nb = $req->execute();
    }
}

?>



