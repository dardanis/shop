<?php

Route::controllers([
    'password' => 'Auth\PasswordController',
]);
Route::get('login', 'Auth\AuthController@getLogin');
Route::get('viewprofile', 'ProfileController@index');
// type name meny //
Route::get('shophome',['as'=>'shophome','uses'=>'HomeController@shophome']);
Route::get('travelhome',['as'=>'travelhome','uses'=>'HomeController@travelhome']);
Route::get('eventshome',['as'=>'eventshome','uses'=>'HomeController@eventshome']);
// end of type name meny //


Route::get('viewprofile',['as'=>'viewprofile','uses'=>'ProfileController@index']);
Route::get('followingprofile',['as'=>'followingprofile','uses'=>'ProfileController@followingprofile']);
Route::get('newsfeed', 'ProfileController@newsfeed');
Route::post('follow/{userid}',['as'=>'follow','uses'=>'ProfileController@follow']);
Route::patch('/makeadmin/{id}',['as'=>'isadmin','uses'=>'AdminController@makeadmin','roles'=>'admin']);
Route::patch('/removeadmin/{id}',['as'=>'removeadmin','uses'=>'AdminController@removeadmin','roles'=>'admin']);
Route::patch('/receiveemails/{id}',['as'=>'receiveemails','uses'=>'AdminController@receiveemails','roles'=>'admin']);
Route::patch('/rmvreceiveemails/{id}',['as'=>'rmvreceiveemails','uses'=>'AdminController@rmvreceiveemails','roles'=>'admin']);

Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');
//Slider
Route::get('createsliderproduct',['as'=>'createsliderproduct','uses'=>'SliderProductsController@create','roles'=>'admin']);
Route::get('sliderindex', ['as' => 'sliderindex', 'uses' => 'SliderProductsController@index','roles'=>'admin']);
Route::post('saveslider',['as' => 'saveslider', 'uses' => 'SliderProductsController@store','roles'=>'admin']);
Route::get('editslider/{id}', ['as'=>'editslider','uses'=>'SliderProductsController@edit','roles'=>'admin']);
Route::post('add_product_template/{id}', ['as'=>'add_product_template','uses'=>'ProductsController@add_product_template','roles'=>'admin','client','bussiness']);
/* adresses of user */
Route::get('alladresess', ['as'=>'alladresess','uses'=>'ProductAdressController@index','roles'=>'admin','client','business']);
Route::get('edit_adress/{id}', ['as'=>'edit_adress','uses'=>'ProductAdressController@edit_adress','roles'=>'admin','client','business']);
Route::delete('adressdelete/{id}', ['as'=>'adressdelete','uses'=>'ProductAdressController@destroy','roles'=>'admin','client','business']);
Route::post('defaultadress/{id}', ['as'=>'defaultadress','uses'=>'ProductAdressController@defaultadress','roles'=>'admin','client','business']);

Route::delete('deleteslider/{id}', ['as'=>'deleteslider','uses'=>'SliderProductsController@destroy', 'roles'=>'admin']);

// Registration routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');
get('register/confirm/{token}', 'Auth\AuthController@confirmEmail');

Route::get('signup', ['as' => 'signup', 'uses' => 'HomeController@signup']);
Route::get('', ['uses' => 'HomeController@index', 'as' => 'home']);
Route::post('language', array('before' => 'auth', 'as' => 'language-chooser', 'uses' => 'LanguageController@chooser'));
Route::get('category/{name}', ['as' => 'category_show', 'uses' => 'HomeController@category']);
Route::get('category/s/erotique', ['as' => 'category_satic', 'uses' => 'HomeController@category_static']);
Route::get('{cat_slug}/subcategory/{name}', ['as' => 'subcategory_show', 'uses' => 'HomeController@subcategory']);
Route::get('products/{slug}/{id}', ['as' => 'product_show', 'uses' => 'HomeController@showproduct']);
Route::get('{username}/products', ['as' => 'user_products', 'uses' => 'HomeController@user_products']);
Route::get('contact', ['as' => 'contact', 'uses' => 'HomeController@contact']);
Route::post('contact', ['as' => 'contact_post', 'uses' => 'HomeController@store_contact']);
Route::get('shop', ['as' => 'shop', 'uses' => 'HomeController@shop']);

    Route::get('searchblog/{slug}', ['as' => 'searchblog', 'uses' => 'ProductsController@searchblog']);
    Route::get('searchotherblog/{slug}', ['as' => 'searchotherblog', 'uses' => 'ProductsController@searchotherblog']);

Route::get('echange', ['as' => 'echange', 'uses' => 'HomeController@echange']);
Route::get('auction', ['as' => 'encheres', 'uses' => 'HomeController@encheres']);

Route::get('/resendEmail', 'Auth\AuthController@resendEmail');
Route::get('/activate/{code}', 'Auth\AuthController@activateAccount');
Route::get('/all',['as'=>'categoryproducts','uses'=>'ClientController@category_products']);
Route::group(['middleware' => ['auth', 'roles']], function () {

    //--- ROUTES FOR CART//
    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', ['as' => 'my_cart', 'uses' => 'CartController@index']);
        Route::get('/clearCart', ['as' => 'clear_cart', 'uses' => 'CartController@clear']);
        Route::post('add/{id}', ['as' => 'add_cart', 'uses' => 'CartController@add']);
        Route::post('add/wishlist/{id}', ['as' => 'add_cart_wishlist', 'uses' => 'CartController@add_from_wishlist']);
        Route::delete('product/{id}', ['as' => 'cart.delete', 'uses' => 'CartController@remove_product']);
        Route::post('update/{id}', ['as' => 'cart.update', 'uses' => 'CartController@update_cart']);
    });

    Route::group(['prefix' => 'contact'], function () {


        Route::get('/', ['as' => 'addcontact', 'uses' => 'ContactInfoController@add','roles' => ['client', 'business','admin']]);
        Route::post('/storecontact', ['as' => 'storecontact', 'uses' => 'ContactInfoController@store','roles' => ['client', 'business','admin']]);
        Route::get('editcontact/{id}', ['as' => 'editcontact', 'uses' => 'ContactInfoController@edit','roles' => ['client', 'business','admin']]);
        Route::patch('/updatecontact', ['as'=>'updatecontact', 'uses' => 'ClientController@update', 'roles' => ['client', 'business','admin']]);

    });

    //--- ROUTES FOR WISHLIST//
    Route::group(['prefix' => 'wishlist'], function () {
        Route::get('/', ['as' => 'my_wishlist', 'uses' => 'WishlistController@index']);
        Route::get('/clearWishlist', ['as' => 'clear_wishlist', 'uses' => 'WishlistController@clear']);
        Route::post('add/{id}', ['as' => 'add_wishlist', 'uses' => 'WishlistController@store']);
        Route::delete('product/{id}', ['as' => 'wishlist.delete', 'uses' => 'WishlistController@destroy']);
        Route::post('update/{id}', ['as' => 'wishlist.update', 'uses' => 'WishlistController@update']);
    });


    Route::post('reviews/{slug}/{id}', ['as' => 'review', 'uses' => 'ProductsController@reviews']);

//---- Client Routes Here//
    Route::group(['prefix' => 'client'], function () {
        Route::get('dashboard', ['as' => 'myaccount', 'uses' => 'ClientController@index', 'roles' => ['client', 'business']]);
        Route::get('c_products', ['as' => 'client_products', 'uses' => 'ClientController@client_products', 'roles' => ['client', 'business']]);
        Route::get('add/product', ['as' => 'products_add', 'uses' => 'ProductsController@add', 'roles' => ['client', 'business','admin']]);
        Route::get('basic/profile', ['as' => 'basicdata', 'uses' => 'ClientController@basicdata', 'roles' => ['client', 'business','admin']]);

        Route::post('c_products', ['as' => 'add_product', 'uses' => 'ProductsController@store', 'roles' => ['client', 'business','admin']]);
        Route::get('add/product/{product}/step/{step}', ['as' => 'product_add_step2', 'uses' => 'ProductsController@step2', 'roles' => ['client', 'business']]);
        Route::post('c_products_step2', ['as' => 'add_product_step2', 'uses' => 'ProductsController@store_images', 'roles' => ['client', 'business']]);
        Route::delete('delete/product/{id}', ['as' => 'client_product_delete', 'uses' => 'ProductsController@delete_product', 'roles' => ['client', 'business']]);
        Route::get('account', ['as' => 'account_type', 'uses' => 'ClientController@accounttype', 'roles' => ['client', 'business']]);

        Route::group(['prefix' => 'ads'], function () {
            Route::get('/', ['uses' => 'AdsController@index', 'roles' => ['business']]);
            Route::get('/add', ['uses' => 'AdsController@create', 'roles' => ['business']]);
            Route::post('/', ['uses' => 'AdsController@store', 'roles' => ['business']]);
            Route::delete('delete/{id}', ['as' => 'delete_ad', 'uses' => 'AdsController@destroy', 'roles' => 'business']);

        });
    });

    Route::get('profile', ['as' => 'myprofile', 'uses' => 'ClientController@profile', 'roles' => ['client', 'business']]);
    Route::put('profile/edit', ['as' => 'edit_profile', 'uses' => 'ClientController@editprofile', 'roles' => ['client', 'business','admin']]);
    Route::patch('profile/edit', ['uses' => 'ClientController@editprofile', 'roles' => ['client', 'business','admin']]);
    Route::put('profile/password/change', ['as' => 'change_password', 'uses' => 'ClientController@change_password', 'roles' => ['client', 'business','admin']]);
    Route::patch('profile/password/change', ['uses' => 'ClientController@change_password', 'roles' => ['client', 'business','admin']]);
    Route::post('ajax', array('uses' => 'ProductsController@getSecond'));
    Route::post('ajax1', array('uses' => 'ProductsController@getsubsutcategory'));
    Route::post('deleteimage', array('uses' => 'ProductsController@removeimg', 'roles' => ['client', 'business', 'admin']));


    Route::get('products/edit/{slug}/{id}', ['as' => 'product_edit', 'uses' => 'ProductsController@edit', 'roles' => ['client', 'business','admin']]);
    Route::get('shopfields/{slug}/{id}', ['as' => 'shopfields_create', 'uses' => 'ProductsController@shopfields', 'roles' => ['client', 'business','admin']]);
    Route::post('storeshopfields/{slug}/{id}', ['as' => 'storeshopfields', 'uses' => 'ProductsController@storeshopfields', 'roles' => ['client', 'business','admin']]);

    Route::put('products/edit/{slug}/{id}', ['as' => 'product_put', 'uses' => 'ProductsController@update', 'roles' => ['client', 'business','admin']]);
    Route::patch('products/edit/{slug}/{id}', ['as' => 'product_put', 'uses' => 'ProductsController@update']);

    Route::group(['prefix' => 'myshop'], function () {
        Route::get('/', ['as' => 'myshop', 'uses' => 'ProfileController@myshop']);

    });
    Route::group(['prefix' => 'filterpricehome'], function () {
        Route::get('/', ['as' => 'filterpricehome', 'uses' => 'ProfileController@filterpricehome']);

    });

       Route::group(['prefix' => 'productscategory'], function () {
        Route::get('/', ['as' => 'productscategory', 'uses' => 'ProfileController@productscategory']);

    });
    Route::group(['prefix' => 'searchattributes'], function () {
        Route::get('/', ['as' => 'searchattributes', 'uses' => 'AttributesController@searchattributes']);

    });
    Route::group(['prefix' => 'searchbyprice'], function () {
        Route::get('/', ['as' => 'searchbyprice', 'uses' => 'ProfileController@searchbyprice']);

    });

    Route::group(['prefix' => 'offers'], function () {


        Route::get('/', ['as' => 'addoffer', 'uses' => 'OffersController@add','roles' => ['client', 'business','admin']]);
        Route::post('/storeoffer', ['as' => 'storeoffer', 'uses' => 'OffersController@store','roles' => ['client', 'business','admin']]);
        Route::get('editoffer/{id}', ['as' => 'editoffer', 'uses' => 'OffersController@edit','roles' => ['client', 'business','admin']]);
        Route::patch('/updateoffer', ['as'=>'updateoffer', 'uses' => 'OffersController@update', 'roles' => ['client', 'business','admin']]);

    });
    Route::group(['prefix' => 'comments'], function () {
        Route::get('/', ['as' => 'addcomments', 'uses' => 'CommentsController@add','roles' => ['client', 'business','admin']]);
        Route::post('/storecomments', ['as' => 'storecomments', 'uses' => 'CommentsController@store','roles' => ['client', 'business','admin']]);
    });

});


// Admin Routes//
Route::group(['middleware' => ['auth', 'roles']], function () {
    Route::group(['prefix' => 'admin'], function () {


        Route::get('profile', ['as' => 'admin_profile', 'uses' => 'AdminController@profile', 'roles' => ['admin']]);
        Route::get('dashboard', ['as' => 'admin_dashboard', 'uses' => 'AdminController@index', 'roles' => ['admin']]);

        //Advertisments Routes ----Admin
        Route::group(['prefix' => 'ads'], function () {
            Route::get('/', ['as' => 'admin_ads', 'uses' => 'AdsController@admin_index', 'roles' => ['admin']]);
            Route::delete('delete/{id}', ['as' => 'delete_ad', 'uses' => 'AdsController@destroy', 'roles' => 'admin']);
            Route::post('/activate/{id}', ['as' => 'activate_ad', 'uses' => 'AdsController@activate', 'roles' => 'admin']);
            Route::post('/deactivate/{id}', ['as' => 'deactivate_ad', 'uses' => 'AdsController@deactivate', 'roles' => 'admin']);
        });

        //Categories Routes
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', ['as' => 'categoriesindex', 'uses' => 'CategoriesController@index', 'roles' => ['admin']]);
            Route::get('add', ['as' => 'addcategory', 'uses' => 'CategoriesController@add', 'roles' => ['admin']]);
            Route::post('/', ['as' => 'store_category','uses' => 'CategoriesController@store', 'roles' => ['admin']]);
            Route::delete('delete/{id}', ['as' => 'deleteCategory', 'uses' => 'CategoriesController@destroy', 'roles' => ['admin']]);
            Route::get('edit/{slug}/{id}', ['as' => 'edit_category', 'uses' => 'CategoriesController@edit', 'roles' => ['admin']]);
            Route::put('{id}', array('as' => 'category_update', 'uses' => 'CategoriesController@update', 'roles' => ['admin']));
            Route::patch('{id}', array('uses' => 'CategoriesController@update'));
            Route::get('{name}/sub', ['as' => 'subcat', 'uses' => 'CategoriesController@add_subcategory', 'roles' => ['admin']]);
        });
        Route::get('/{category}/subcategories', ['as' => 'cat_sub', 'uses' => 'CategoriesController@subs', 'roles' => ['admin']]);
        //Subcategories Routes
        Route::group(['prefix' => 'subcategories'], function () {

            Route::post('/', ['uses' => 'CategoriesController@store_sub', 'roles' => ['admin']]);
            Route::get('{name}/{id}/edit', ['as' => 'edit_sub', 'uses' => 'CategoriesController@edit_sub', 'roles' => ['admin']]);
            Route::delete('{id}', ['as' => 'deleteSubcategory', 'uses' => 'CategoriesController@destroy_sub', 'roles' => ['admin']]);
            Route::put('{id}/update', ['as' => 'update_sub', 'uses' => 'CategoriesController@update_sub', 'roles' => ['admin']]);
            Route::patch('{id}/update', ['uses' => 'CategoriesController@update_sub']);
        });


        Route::group(['prefix' => 'subsubcategories'], function () {
            Route::get('/{category_id}/{sub_category_id}', ['as' => 'cat_subsub', 'uses' => 'CategoriesController@subsubs', 'roles' => ['admin']]);
            Route::get('{category}/{name}/subsub', ['as' => 'subsubcat', 'uses' => 'CategoriesController@add_subsubcategory', 'roles' => ['admin']]);
            Route::post('/', ['uses' => 'CategoriesController@store_subsub', 'roles' => ['admin']]);
            Route::get('{name}/{id}/edit', ['as' => 'edit_subsub', 'uses' => 'CategoriesController@edit_subsub', 'roles' => ['admin']]);
            Route::delete('{id}', ['as' => 'deleteSubSubcategory', 'uses' => 'CategoriesController@destroy_subsub', 'roles' => ['admin']]);
            Route::put('{id}/update', ['as' => 'update_subsub', 'uses' => 'CategoriesController@update_subsub', 'roles' => ['admin']]);
            Route::patch('{id}/update', ['uses' => 'CategoriesController@update_subsub']);
        });
        //Users Routes
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', ['uses' => 'AdminController@users', 'as' => 'users', 'roles' => ['admin']]);
            Route::get('add', ['uses' => 'AdminController@create_users', 'as' => 'create_users', 'roles' => ['admin']]);
            Route::post('/', ['uses' => 'AdminController@post_users', 'as' => 'post_users', 'roles' => ['admin']]);
            Route::delete('{id}', array('as' => 'admin.users.delete', 'uses' => 'AdminController@delete_users'));
            Route::get('edit/{name}', ['as' => 'edit_users', 'uses' => 'AdminController@edit_users', 'roles' => ['admin']]);
            Route::patch('{id}', ['as' => 'user_update', 'uses' => 'AdminController@update_user', 'roles' => ['admin']]);
            Route::get('clients', ['as' => 'client_users', 'uses' => 'AdminController@clients_users', 'roles' => ['Admin']]);
            Route::get('business', ['as' => 'business_users', 'uses' => 'AdminController@business_users', 'roles' => ['Admin']]);
        });

        Route::group(['prefix' => 'stats'], function () {
            Route::get('users', ['as' => 'users_stats', 'uses' => 'StatsController@users', 'roles' => ['admin']]);
            Route::get('products', ['as' => 'products_stats', 'uses' => 'StatsController@products', 'roles' => ['admin']]);

        });
        //Products Routes
        Route::group(['prefix' => 'a_products'], function () {
            Route::get('add', ['as' => 'addproduct', 'uses' => 'AdminController@add_product', 'roles' => ['admin','business','client']]);
            Route::get('/', ['as' => 'admin_products', 'uses' => 'AdminController@products', 'roles' => ['admin']]);
            Route::get('edit/{slug}/{id}/', ['as' => 'admin_product_edit', 'uses' => 'ProductsController@product_edit', 'roles' => ['admin']]);
            Route::put('{slug}/edit', ['as' => 'admin_product_put', 'uses' => 'ProductsController@update_product', 'roles' => ['admin']]);
            Route::patch('{slug}/edit', ['as' => 'admin_product_put', 'uses' => 'ProductsController@update_product']);
        });
        Route::delete('delete/product/{id}', ['as' => 'admin_product_delete', 'uses' => 'AdminController@delete_product', 'roles' => ['admin']]);
        Route::put('{id}/spam', ['as' => 'admin_product_spam', 'uses' => 'AdminController@spam', 'roles' => ['admin']]);
        Route::patch('{id}/spam', ['as' => 'admin_product_spam', 'uses' => 'AdminController@spam']);
        Route::put('{id}/approve', ['as' => 'admin_product_approve', 'uses' => 'AdminController@approve', 'roles' => ['admin']]);
        Route::put('approvedetails/{slug}/{id}', ['as' => 'approvedetails', 'uses' => 'AdminController@approvedetails']);
        Route::patch('{id}/approve', ['as' => 'admin_product_approve', 'uses' => 'AdminController@approve']);

        //Suscription Plans Routes
        Route::group(['prefix' => 'plans'], function () {
            Route::get('', ['as' => 'subscription_plans', 'uses' => 'StripeController@plans', 'roles' => 'admin']);
            Route::get('add', ['as' => 'plan_add', 'uses' => 'StripeController@add', 'roles' => 'admin']);
            Route::post('add', ['uses' => 'StripeController@store', 'roles' => 'admin']);
            Route::get('{id}/edit', ['as' => 'edit_plans', 'uses' => 'StripeController@edit', 'roles' => 'admin']);
            Route::post('update/{id}', ['as' => 'plan_update', 'uses' => 'StripeController@update', 'roles' => 'admin']);
            Route::delete('delete/{id}', ['as' => 'plan_delete', 'uses' => 'StripeController@destroy', 'roles' => 'admin']);
        });
        //Picture products routes


        //invoices
        Route::get('invoices', ['uses' => 'StripeController@invoices', 'roles' => 'admin']);

        //group name Routes
        Route::group(['prefix' => 'formname'], function () {
            Route::get('/', ['as' => 'formnameindex', 'uses' => 'GroupFormNameController@index', 'roles' => ['admin']]);
            Route::get('add', ['as' => 'formnameadd', 'uses' => 'GroupFormNameController@add', 'roles' => ['admin']]);
            Route::post('/', ['as' => 'formnamestore','uses' => 'GroupFormNameController@store', 'roles' => ['admin']]);
            Route::delete('delete/{id}', ['as' => 'formnamedelete', 'uses' => 'GroupFormNameController@destroy', 'roles' => ['admin']]);
            Route::get('edit/{id}', ['as' => 'formnameedit', 'uses' => 'GroupFormNameController@edit', 'roles' => ['admin']]);
            Route::put('{id}', array('as' => 'formnameupdate', 'uses' => 'GroupFormNameController@update', 'roles' => ['admin']));

        });
    });
});
//pictures product
Route::get('product/images/{slug}/{id}', ['as'=>'getimages','uses' => 'PicturesController@getUpload', 'roles' => 'admin','client','business']);
Route::post('product/images/{id}', ['as'=>'postUpload','uses' => 'PicturesController@postUpload', 'roles' => 'admin','client','business']);
Route::get('product/images/edit/{slug}/{id}', ['as'=>'editimages','uses' => 'PicturesController@edit', 'roles' => 'admin','client','business']);

Route::get('add/attributes/{slug}/{id}', ['as'=>'addattributes','uses' => 'AttributesController@create', 'roles' => 'admin']);
Route::get('add/attributessubcat/{slug}/{id}', ['as'=>'addattributessubccat','uses' => 'AttributesController@createsubcat', 'roles' => 'admin']);
Route::post('subcat/attributes/{slug}/{id}', ['as'=>'subcatattributes','uses' => 'AttributesController@storesubcat', 'roles' => 'admin']);

Route::get('attributes/edit/attributes/{id}', ['as'=>'editcatattributes','uses' => 'AttributesController@edit', 'roles' => 'admin']);
Route::get('attributes/editsub/attributes/{id}', ['as'=>'editsubattributes','uses' => 'AttributesController@editsub', 'roles' => 'admin']);
Route::get('all/attributes/{slug}/{id}', ['as'=>'indexattributes','uses' => 'AttributesController@index', 'roles' => 'admin']);
Route::get('all/subcatattributes/{slug}/{id}', ['as'=>'indexsubattributes','uses' => 'AttributesController@indexsub', 'roles' => 'admin']);
Route::get('add/relatedattributes/{slug}/{id}', ['as'=>'addrelatedattributes','uses' => 'AttributesController@createrelated', 'roles' => 'admin']);

Route::post('add/relate/{slug}/{id}', ['as'=>'relate','uses' => 'AttributesController@relate', 'roles' => 'admin']);
Route::post('product/createrelated/attributes/{slug}/{id}', ['as'=>'attributes','uses' => 'AttributesController@store', 'roles' => 'admin']);
Route::post('product/editsubattributes/attributes/{slug}/{id}', ['as'=>'attributessub','uses' => 'AttributesController@storesubcat', 'roles' => 'admin']);

Route::post('product/edit/attributes/{slug}/{id}', ['as'=>'editattributes','uses' => 'AttributesController@editattributes', 'roles' => 'admin']);
Route::post('product/addproductatt/{slug}/{id}', ['as'=>'add_p','uses' => 'AttributesController@add_p', 'roles' => 'admin','client','business']);
Route::get('product/product_attributes/{slug}/{id}', ['as'=>'product_attributes','uses' => 'AttributesController@product_attributes', 'roles' => 'admin','client','business']);
Route::delete('delete/attributes/{id}', ['as'=>'delete_attributes','uses' => 'AttributesController@delete_attributes', 'roles' => 'admin']);
Route::get('delete/subattributes/{slug}/{id}', ['as'=>'delete_subattributes','uses' => 'AttributesController@delete_subattributes', 'roles' => 'admin']);
Route::get('delete/relatedattribute/{slug}/{id}', ['as'=>'delete_relatedattribute','uses' => 'AttributesController@delete_relatedattribute', 'roles' => 'admin']);
Route::get('product/create/adress/{slug}/{id}', ['as'=>'add_adress','uses' => 'ProductAdressController@create', 'roles' => 'business','client','admin']);
Route::get('product/create/useradress', ['as'=>'add_useradress','uses' => 'ProductAdressController@createuseradress', 'roles' => 'business','client','admin']);

Route::post('product/store/adress/{slug}/{id}', ['as'=>'storeadress','uses' => 'ProductAdressController@store', 'roles' => 'business','client','admin']);
Route::post('product/store/useradress', ['as'=>'storeuseradress','uses' => 'ProductAdressController@storeuseradress', 'roles' => 'business','client','admin']);
//Edit Product
Route::post('types/save', ['as'=>'type_form', 'uses' => 'ProductTypesController@store', 'roles' => ['admin']]);
Route::get('types/add', ['as'=>'types_create','uses' => 'ProductTypesController@create', 'roles' => ['admin']]);
Route::get('types/admin', ['as' => 'typeindex', 'uses' => 'ProductTypesController@index', 'roles' => ['admin']]);
Route::get('edittype/{alias}/{id}', ['as' => 'edit_type', 'uses' => 'ProductTypesController@edit', 'roles' => ['admin']]);
Route::post('updatetype/{alias}/{id}', ['as' => 'update_type', 'uses' => 'ProductTypesController@update', 'roles' => ['admin']]);
Route::delete('deletetype/{id}', ['as' => 'delete_type', 'uses' => 'ProductTypesController@delete_type','roles'=>['admin']]);


Route::get('translation/add', ['as' => 'translation_add', 'uses' => 'TranslationController@create', 'roles' => ['admin']]);
Route::post('translation/save', ['as' => 'translation_save', 'uses' => 'TranslationController@store', 'roles' => ['admin']]);
Route::get('translation/edit/{id}', ['as' => 'translation_edit', 'uses' => 'TranslationController@edit', 'roles' => ['admin']]);
Route::post('translation/update/{id}', ['as' => 'translation_update', 'uses' => 'TranslationController@update', 'roles' => ['admin']]);
Route::get('translation/admin', ['as' => 'translationindex', 'uses' => 'TranslationController@index', 'roles' => ['admin']]);
Route::delete('deletetranslation/{id}', ['as' => 'translation_delete', 'uses' => 'TranslationController@delete_translation','roles'=>['admin']]);
Route::get('userdashboard', ['as' => 'mydashboard', 'uses' => 'HomeController@userdashboard','roles'=>['admin','user','businnes']]);
Route::get('ajaxfindproduct', ['as' => 'addandfind', 'uses' => 'ProductsController@addandfind','roles'=>['admin','user','businnes']]);
Route::get('ajaxfindattributeitem', ['as' => 'findattributeitem', 'uses' => 'AttributesController@findattributeitem','roles'=>['admin','user','businnes']]);
Route::get('getproductajax', ['as' => 'returnprod', 'uses' => 'ProductsController@getproductajax','roles'=>['admin','user','businnes']]);
Route::get('edit/{slug}/{id}/', ['as' => 'editproduct','uses' => 'ProductsController@edit', 'roles' => ['admin','user','business']]);
Route::get('charge/{plan}', 'PaymentsController@index');
Route::get('/{alias}', ['as' => 'pagetype', 'uses' => 'HomeController@pagetype', 'roles' => ['admin','user','businnes']]);
Route::get('{category}/{alias}', ['as' => 'subcategory', 'uses' => 'HomeController@pageSubcategories', 'roles' => ['admin','user','businnes']]);
Route::get('{no}/{category}/{slug}', ['as' => 'pagenocategories', 'uses' => 'HomeController@pagenocategories', 'roles' => ['admin','user','businnes']]);

Route::post('charge', ['uses' => 'PaymentsController@store']);

// Area Details controller

Route::get('areas/add', ['as'=>'areas_create','uses' => 'AreaDetailsController@create', 'roles' => ['admin']]);
Route::post('areadetails/save', ['as' => 'areadetails_save', 'uses' => 'AreaDetailsController@store', 'roles' => ['admin']]);
Route::get('area/admin', ['as' => 'areaindex', 'uses' => 'AreaDetailsController@index', 'roles' => ['admin']]);
Route::get('editarea/{alias}/{id}', ['as' => 'edit_area', 'uses' => 'AreaDetailsController@edit', 'roles' => ['admin']]);
Route::post('updatearea/{alias}/{id}', ['as' => 'update_area', 'uses' => 'AreaDetailsController@update', 'roles' => ['admin']]);
Route::delete('deletearea/{id}', ['as' => 'delete_area', 'uses' => 'AreaDetailsController@delete_area','roles'=>['admin']]);

// areas on type

Route::get('areatype/add/{alias}/{id}', ['as'=>'areastype_create','uses' => 'ProductTypesController@areas', 'roles' => ['admin']]);
Route::get('areatype/edit/{alias}/{id}', ['as'=>'areastype_edit','uses' => 'ProductTypesController@areasedit', 'roles' => ['admin']]);
Route::post('areatypessave/{alias}/{id}', ['as' => 'areastype_save', 'uses' => 'ProductTypesController@savetypearea', 'roles' => ['admin']]);
Route::post('areatypesupdate/{alias}/{id}', ['as' => 'areastype_update', 'uses' => 'ProductTypesController@updatetypearea', 'roles' => ['admin']]);
Route::post('getscroll', ['as' => 'getscroll', 'uses' => 'ProductTypesController@getscroll', 'roles' => ['admin','user','businnes']]);

Route::post('checkout', ['as' => 'checkout', 'uses' => 'OrderController@checkout', 'roles' => ['client', 'business','admin']]);
Route::get('/order/myorder/order/{orderId}', ['as' => 'orders', 'uses' => 'OrderController@viewOrder', 'roles' => ['client', 'business','admin']]);
Route::get('/user/orders/myoders/test', ['as' => 'myoders', 'uses' => 'OrderController@index', 'roles' => ['client', 'business','admin']]);

Route::get('download/{orderId}/{filename}', 'OrderController@download');
Route::delete('product/image/{slug}/{productid}/{id}', ['as' => 'image_delete', 'uses' => 'ProductsController@deletepicture','roles' => ['client', 'business','admin']]);




