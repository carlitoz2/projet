<?php
class AddCategoriesController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */

		$categoryModel = new CategoryModel();
		$categories = $categoryModel->listAll();
		return [
			'categories' =>$categories
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

		        // Enregistrer les données dans la base de données

		$categoryModel = new CategoryModel();
		$categoryModel->addCategorie($formFields['titreCategorie'],$formFields['descriptionCategorie'], $photo );
		
		$http->redirectTo('admin/categories');
    }
}