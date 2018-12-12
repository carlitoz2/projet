<?php

class EditcategorieController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */
		$id = $queryFields['id'];
        // Aller chercher dans la BDD les infos de la catégorie
        $categoryModel = new CategoryModel();
		$categorie = $categoryModel->find($id);

		return [
			'categorie' => $categorie  //Dans ma vue j'aurais une variable nommée category qui aura de la valeur  $category du contrôleur  
		];

    }

    public function httpPostMethod(Http $http, array $formFields)
    {

    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */
		if($http->hasUploadedFile('imageCategorie'))
		{
			$photo = $http->moveUploadedFile('imageCategorie','/images/tea');
		}
		else
		{
			$photo = $formFields['imageOriginale'];
		}

		$id = $formFields['id'];

		        // Enregistrer les données dans la base de données
		$categoryModel = new CategoryModel(); 
		$categoryModel->update($formFields['id'], $formFields['titreCategorie'], $formFields['descriptionCategorie'], $photo);
		
		$http->redirectTo('admin/categories');
	}

}