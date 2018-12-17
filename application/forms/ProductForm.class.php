<?php
class ProductForm extends Form{

    public function build()

    {
        $this->addFormfield('nomProduit');
        $this->addFormfield('descriptionProduit');
        $this->addFormfield('subtitleProduit');
        $this->addFormfield('idCategories');
        $this->addFormfield('imageProduit');
        $this->addFormfield('id');
        
        

    }
}