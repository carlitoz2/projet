<?php

class CategoryModel{

    /* Méthode qui va renvoyer toutes les catégories */
    public function listAll() {
        $database = new Database(); // Connexion à la base de données

        return $database->query("SELECT * FROM categories");
    }

    public function addCategorie($nom, $description, $image) {
        $database = new Database(); // Connexion à la BDD

        $database->executeSQL("INSERT INTO categories (categorie_name, categorie_description, categorie_picture) VALUES (?,?,?)",[$nom,$description, $image]);
    }

    public function find($id){
        $database = new Database();

        return $database->queryOne("SELECT * FROM categories WHERE idcategories= ?",[$id]);
    }

    public function update($id,$nom,$description,$image){
		$database = new Database();
        
        $database->executeSql("UPDATE categories SET categorie_name = ?, categorie_description = ?, categorie_picture = ? WHERE idcategories = ?", [$nom, $description, $image, $id]);
	}
}