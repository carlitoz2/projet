<?php


class DelcategorieController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */
		$id = $queryFields['id']; // L'id de la catégorie recupérée avec queryfiels
        // Aller chercher dans la BDD les infos de la catégorie
		$categoryModel = new CategoryModel();
		
		//supprimer images 
		
		$photo = $categoryModel->find($id); // utilisation de la methode find des catégorymodels pour trouver la ligne des td correspondantes à l'id
		$image = $photo['categorie_picture']; // nom de l'image à supprimer
		if(file_exists(WWW_PATH.'/images/tea/'.$image)){ // si le fichier existe avec la const du chemin dispo dans httpClassController
			unlink(WWW_PATH.'/images/tea/'.$image);
		}
	
		$categorie = $categoryModel->delete($id);
		// suppression de la ligne correspondant à l'id
		
		$flashbag = new FlashBag(); // création du flashbag
		$flashbag->add('La catégorie '.$photo['categorie_name'].' a bien été supprimée'); // ajout du message avec la méthode dispo dans FlashbagController.class.php
		$http->redirectTo('admin/categories'); // redirection

    }

    public function httpPostMethod(Http $http, array $formFields)
    {

    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */
		
	}

}