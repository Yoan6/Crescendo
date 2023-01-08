<?php

class Article
{
    protected int $numArticle;
    protected string $titre;
    protected string $description;


    private string $urlImage;
    private string $artiste;
    private string $etat;
    private string $catégorie;
    private string $taille;
    //private time $date;
    private string $lieu;
    private string $style;
    private int $prix;




    protected int $nbLike;

    protected function __construct(string $titre,string $description, string $urlImage, int $prix, string $artiste)
    {
        $this->setTitre($titre);
        $this->setDescription($description);

    }


    /******************** 
     * Getter and Setter
     *********************/


    public function getNumArticle()
    {
        return $this->numArticle;
    }

    public function setNumArticle($numArticle)
    {
        $this->numArticle = $numArticle;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    /******************** 
     * CRUD
     *********************/




    /////////////////////////// CREATE /////////////////////////////////////
    public function create()
    {
       //TODO
    }

    /////////////////////////// READ /////////////////////////////////////
    public function read(string $titre): array
    {
        //TODO
        return array();
    }

    /////////////////////////// UPDATE /////////////////////////////////////
    public function update()
    {
        //TODO
    }

    /////////////////////////// DELETE /////////////////////////////////////
    public function delete()
    {
        //TODO
    }

}
?>