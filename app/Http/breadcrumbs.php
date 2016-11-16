<?php


Breadcrumbs::register('home', function($breadcrumbs) {

    $breadcrumbs->push('Home', route('home'));
});
Breadcrumbs::register('myshop', function($breadcrumbs) {

    $breadcrumbs->parent('viewprofile');
    $breadcrumbs->push('Shop', route('myshop'));
});
Breadcrumbs::register('myprofile', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('My Account', route('myprofile'));
});

Breadcrumbs::register('viewprofile', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Profile', route('viewprofile'));
});
Breadcrumbs::register('basicdata', function($breadcrumbs) {
    $breadcrumbs->parent('myprofile');
    $breadcrumbs->push('Settings Account', route('basicdata'));
});

Breadcrumbs::register('addcontact', function($breadcrumbs) {
    $breadcrumbs->parent('myprofile');
    $breadcrumbs->push('My Contact Information', route('addcontact'));
});

Breadcrumbs::register('products_add', function($breadcrumbs) {
    $breadcrumbs->parent('myprofile');
    $breadcrumbs->push('Add product', route('products_add'));
});

Breadcrumbs::register('editproduct', function($breadcrumbs) {
    $breadcrumbs->parent('myprofile');
    $breadcrumbs->push('Edit product', route('editproduct'));

});
Breadcrumbs::register('product_attributes', function($breadcrumbs) {
    $breadcrumbs->parent('editproduct');
    $breadcrumbs->push('Specific attributes', route('product_attributes'));
});
Breadcrumbs::register('getimages', function($breadcrumbs) {
    $breadcrumbs->parent('editproduct');
    $breadcrumbs->push('Product images', route('getimages'));
});
Breadcrumbs::register('productscategory', function($breadcrumbs) {
    $breadcrumbs->parent('myshop');
    $breadcrumbs->push('Filter by category', route('productscategory'));
});
Breadcrumbs::register('add_adress', function($breadcrumbs) {
    $breadcrumbs->parent('myshop');
    $breadcrumbs->push('Product Adress', route('add_adress'));
});


Breadcrumbs::register('categoryproducts', function($breadcrumbs) {
    $breadcrumbs->parent('myprofile');
    $breadcrumbs->push('Category', route('categoryproducts'));
});

Breadcrumbs::register('travelhome', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Travel', route('travelhome'));
});

Breadcrumbs::register('shophome', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Shop', route('shophome'));
});
Breadcrumbs::register('eventshome', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Events', route('eventshome'));
});

Breadcrumbs::register('my_wishlist', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Wishlist', route('my_wishlist'));
});
Breadcrumbs::register('product_show', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Product', route('product_show'));
});



