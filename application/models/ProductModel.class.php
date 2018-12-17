<?php
class ProductModel{

private $dbh; // bdd handler

public function __construct(){
    $this->dbh = new Database(); // l'instance de l'objet dbh crée une database()
}
/* Méthode qui va renvoyer toutes les catégories */
public function listAll() { 
    //$database = new Database(); // Connexion à la base de données

    return $this->dbh->query("SELECT * FROM products");
}

public function findCategory(){
    return $this->dbh->query("SELECT * FROM categories");
}


public function addProduct($nom, $description,$subtitle,$categorie,$image) {
    if (empty($nom) || empty($description) || empty($subtitle))
    {
        throw new DomainException
        ("Erreur de saisie du champ !");
    
    } 
    else
    {    
    $this->dbh->executeSQL("INSERT INTO products (product_name, product_description,product_subtitle,idproducts,product_picture) VALUES (?,?,?,?,?)",[$nom,$description,$subtitle,$categorie,$image]);
    }
}

public function find($id){
    //$database = new Database();

    return $this->dbh->queryOne("SELECT * FROM products WHERE idproducts= ?",[$id]);
}

public function update($id,$nom,$description,$image){
    //$database = new Database();
    if (empty($nom) || empty($description))
    {
        throw new DomainException("Reremplir les champs svp!");
    
    } 
    else{
        $this->dbh->executeSql("UPDATE products SET product_name = ?, product_description = ?, product_picture = ? WHERE idproducts = ?", [$nom, $description, $image, $id]);
    }
}

public function delete($id){
    //$database =new Database();

    return $this->dbh->executeSql("DELETE FROM products WHERE idproduct=?",[$id]);
}
}