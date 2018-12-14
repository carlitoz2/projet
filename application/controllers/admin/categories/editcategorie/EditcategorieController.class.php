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
		
		$form = new CategoriesForm();
		//On bind nos données $_POST ($formFields) avec notre objet formulaire
		$form->bind(['descriptionCategorie' => $categorie['categorie_description'],
		'nomCategorie' => $categorie['categorie_name'], 'id'=>$categorie['idcategories'],'imageOriginale'=>$categorie['categorie_picture'] ]);


		return [ 'categorie' =>$categorie,'_form' => $form ];
		

    }

    public function httpPostMethod(Http $http, array $formFields)
    {

    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */


		try
		{
				
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
		catch(DomainException $exception){
			// DomainException est un type d'exception prédéfinie par PHP (valeur en dehors des limites selon la doc, on l'utilise donc ici pour ça !)
			//Donc si on a un champ en erreur ou une erreur on aura quelques part dans notre code :
			
				
			// Réaffichage du formulaire avec un message d'erreur.
			$form = new CategoriesForm();
			//On bind nos données $_POST ($formFields) avec notre objet formulaire
			$form->bind($formFields);
			$form->setErrorMessage($exception->getMessage());
			return [ '_form' => $form ]; //On renvoie l'affichage de la vue avec toutes les variables du form
		}
	}

}