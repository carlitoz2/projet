<?php

class EditproductController
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
		$categories = $categoryModel->find($id);
        $productModel = new ProductModel();
        $product = $productModel->find($id);
		$form = new ProductForm();
		//On bind nos données $_POST ($formFields) avec notre objet formulaire
		$form->bind(
            ['nomProduit' => $product['product_name'],
        'descriptionProduit' => $product['product_description'], 
        'subtitle' => $product['product_subtitle'],
        'id'=>$product['idproducts'],
        'imageProduit'=>$product['product_picture'] ]);


		return [ 'categories' =>$categories,'_form' => $form, 'product' =>$product ];
		

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
				
			if($http->hasUploadedFile('imageProduit'))
			{
				$photo = $http->moveUploadedFile('imageProduit','/images/product');
			}
			else
			{
				$photo = $formFields['imageProduit'];
			}

			$id = $formFields['id'];

					// Enregistrer les données dans la base de données
			$categoryModel = new CategoryModel(); 
			$categoryModel->update($formFields['id'], $formFields['product_name'], $formFields['descriptionCategorie'], $photo);
			
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