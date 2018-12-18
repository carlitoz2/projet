'use strict';

let Panier = function () {
    
    this.items = new Array();

    this.totalPriceDisplay= $('#cartTotal'); // selectionne l'element à l'id cartTotal

    this.load();


    //this.totalPrice = 0;
    // on change l'inner html avec le total price de l'instance

}

Panier.prototype.add = function (nom,quantity,variant,variantId,id,price)
 {
    let product = new Object();
    product.name = nom;
    product.quantity = quantity;
    product.id = id;
    product.variantId = variantId;
    product.variant = variant;
    product.price = price;

    this.items.push(product); // on push dans l'objet les ptés de celui-ci

    saveDataToDomStorage('cart', this.items); 
    saveDataToDomStorage('total', this.totalPrice);

    
    this.displayResume();
}


Panier.prototype.load = function () {
    this.items = loadDataFromDomStorage('cart');
        if (this.items == null)
            this.items = new Array();
    this.totalPrice = loadDataFromDomStorage('total');
        if (this.totalPrice == null)
            this.totalPrice = 0;

    this.displayResume();
    
}

Panier.prototype.displayResume = function(){
    this.totalPriceDisplay.html(formatMoneyAmount(this.totalPrice));
}

/****DEMO */


let cart = new Panier();

document.getElementById('addCart').addEventListener('click', function() {

    let quantity = parseInt(document.getElementById('quantity').value);
    let nom = document.getElementById('addCart').dataset.name;
    let id = parseInt(document.getElementById('addCart').dataset.id);
    let variantId = parseInt($('#variation').find(':selected').val());
    let variant = $('#variation').find(':selected').data('name');
    let price = parseFloat($('#variation').find(':selected').data('price'));

    cart.totalPrice += quantity * price;

    cart.add(nom, quantity,variant,variantId,id,price);

    
    

});



