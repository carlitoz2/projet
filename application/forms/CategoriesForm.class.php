<?php
class CategoriesForm extends Form{

    public function build()

    {
        $this->addFormfield('titreCategorie');
        $this->addFormfield('descriptionCategorie');
        $this->addFormfield('imageOriginale');
        $this->addFormfield('id');
        

    }
}