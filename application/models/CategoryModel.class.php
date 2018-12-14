<?php
// ce qui va agir sur la BDD
class CategoryModel{

    private $dbh; // bdd handler

    public function __construct(){
        $this->dbh = new Database(); // l'instance de l'objet dbh crée une database()
    }
    /* Méthode qui va renvoyer toutes les catégories */
    public function listAll() { 
        //$database = new Database(); // Connexion à la base de données

        return $this->dbh->query("SELECT * FROM categories");
    }

    public function addCategorie($nom, $description, $image) {
        if (empty($nom) || empty($description))
		{
            throw new DomainException
		    ("Erreur de saisie du champ !");
        
        } 
        else
        {    
        $this->dbh->executeSQL("INSERT INTO categories (categorie_name, categorie_description, categorie_picture) VALUES (?,?,?)",[$nom,$description, $image]);
        }
    }

    public function find($id){
        //$database = new Database();

        return $this->dbh->queryOne("SELECT * FROM categories WHERE idcategories= ?",[$id]);
    }

    public function update($id,$nom,$description,$image){
		//$database = new Database();
        if (empty($nom) || empty($description))
		{
            throw new DomainException("Reremplir les champs svp!");
        
        } 
        else{
            $this->dbh->executeSql("UPDATE categories SET categorie_name = ?, categorie_description = ?, categorie_picture = ? WHERE idcategories = ?", [$nom, $description, $image, $id]);
        }
    }
    
    public function delete($id){
        //$database =new Database();

        return $this->dbh->executeSql("DELETE FROM categories WHERE idcategories=?",[$id]);
    }
}