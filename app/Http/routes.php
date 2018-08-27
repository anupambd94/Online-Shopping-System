<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {

    Route::get('/',                         'View\ViewController@index');

    Route::get('/search',                         'Search\SearchController@search');

    Route::get('/category/{id}/products',    [
        'as' => 'categoryproducts', 
        'uses' => 'View\ViewController@categoryProducts'
    ]);
    Route::get('/category/{category}/subcategory/{id}/products', [
        'as' => 'subcategoryproducts', 
        'uses' => 'View\ViewController@subcategoryProducts'
    ]);


    Route::post('/add/order',           'Cart\CartController@storeProductorder');



    Route::get('/add/cart/{id}',        'Cart\CartController@addProductcart');
    Route::get('/delete/cart/{id}',     'Cart\CartController@destroyProductcart');

    

    Route::get('/order',                'Cart\CartController@viewOrder');

    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::get('/view/orders', 		'Admin\AdminController@viewOrders');
    Route::get('/view/products', 	'Admin\AdminController@viewProducts');
    Route::get('/add/product', 		'Admin\AdminController@addProduct');
    Route::get('/view/categories', 	'Admin\AdminController@viewCategories');
    Route::get('/add/category', 	'Admin\AdminController@addCategory');
    Route::get('/add/subcategory', 	'Admin\AdminController@addSubcategory');

    Route::post('/add/product', 		'Admin\AdminController@storeaddProduct');
    Route::post('/add/category', 		'Admin\AdminController@storeaddCategory');
    Route::post('/add/subcategory', 	'Admin\AdminController@storeaddSubcategory');

    Route::get('/delete/product/{id}', 		'Admin\AdminController@destroyProduct');
    Route::get('/delete/category/{id}', 	'Admin\AdminController@destroyCategory');
    Route::get('/delete/subcategory/{id}', 	'Admin\AdminController@destroySubcategory');

    Route::get('/edit/product/{id}', 		'Admin\AdminController@editProduct');
    Route::get('/edit/category/{id}', 		'Admin\AdminController@editCategory');
    Route::get('/edit/subcategory/{id}', 	'Admin\AdminController@editSubcategory');

    Route::post('/edit/product/{id}', 		'Admin\AdminController@updateProduct');
    Route::post('/edit/category/{id}', 		'Admin\AdminController@updateCategory');
    Route::post('/edit/subcategory/{id}', 	'Admin\AdminController@updateSubcategory');

    Route::get('/cart',                 'Cart\CartController@index');
    Route::post('/cart', function(Request $request) {

        $token = Request::get('stripeToken');

        // Auth::user()->newSubscription('main', 'monthly')->create($token);

        \Stripe\Stripe::setApiKey("sk_test_3QkLrQk7UjgIhQaNdJqwKah2");


        // Create the charge on Stripe's servers - this will charge the user's card
        try {
          $charge = \Stripe\Charge::create(array(
            "amount" => Request::get('total'), // amount in cents, again
            "currency" => "usd",
            "source" => $token,
            "description" => "Example charge",
            "metadata" => array("order_id" => "6735")
            ));
        } catch(\Stripe\Error\Card $e) {
          // The card has been declined
        }

        return  redirect('/order');
    });

    Route::get('payment', function() {
       return  view('cart.payment'); 
    });

    Route::post('/add/order',           'Cart\CartController@storeProductorder');



    Route::get('/add/cart/{id}',        'Cart\CartController@addProductcart');
    Route::get('/delete/cart/{id}',     'Cart\CartController@destroyProductcart');

    

    Route::get('/order',                'Cart\CartController@viewOrder');

    Route::get('active/order/{id}',  [
        'as' => 'order-active', 
        'uses' => 'Cart\CartController@activeOrder'
    ] );

    Route::post('/comment',  [
        'as' => 'comment', 
        'uses' => 'Comment\CommentController@comment'
    ] );

    Route::get('/view/comment',  [
        'as' => 'view-comment', 
        'uses' => 'Admin\AdminController@viewcomment'
    ] );

    Route::get('/delete/comment/{id}',  [
        'as' => 'delete-comment', 
        'uses' => 'Admin\AdminController@deletecomment'
    ] );

    Route::get('/view/sell',  [
        'as' => 'view-sell', 
        'uses' => 'Admin\AdminController@viewsell'
    ] );
    
    Route::get('/view/notification',  [
        'as' => 'view-notification', 
        'uses' => 'Admin\AdminController@viewNotification'
    ] );

    Route::get('/delete/notification/{id}',  [
        'as' => 'delete-notification', 
        'uses' => 'Admin\AdminController@deleteNotification'
    ] );
});
