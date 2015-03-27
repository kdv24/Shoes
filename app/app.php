<?php

    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Store.php';
    require_once __DIR__.'/../src/Brand.php';
    require_once __DIR__.'/../setup.config';

    // If you are using postgres.app and getting PDOExceptions, remove the last
    // two arguments, otherwise follow the instructions in setup.config.example
    $DB = new PDO("pgsql:host=localhost;dbname=shoe_db", $DB_USER, $DB_PASS);

    $app = new Silex\Application();

    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    //HOMEPAGE ROUTES
    $app->get('/', function() use ($app) {
        return $app['twig']->render('homepage.twig', array('store_array' => Store::getAll(), 'brand_array' => Brand::getAll()));
    });

    $app->delete('/', function() use ($app) {

        if(!empty($_POST['stores'])) {
            Store::deleteAll();
        }
        else {
            Brand::deleteAll();
        }

        return $app['twig']->render('homepage.twig', array('store_array' => Store::getAll(), 'brand_array' => Brand::getAll()));
    });

        //stores
        $app->get('/stores', function() use ($app) {

            return $app['twig']->render('homepage.twig', array('store_array' => Store::getAll(), 'brand_array' => Brand::getAll()));
        });

        $app->post('/stores', function() use ($app) {

            $name = $_POST['add_store'];
            $new_store = new Store($name);
            $new_store->save();

            return $app['twig']->render('homepage.twig', array('store_array' => Store::getAll(), 'brand_array' => Brand::getAll()));
        });

        //single store deletion
        $app->delete('/stores', function() use ($app) {
            $store = Store::findById($_POST['delete_store']);
            $store->delete();

            return $app['twig']->render('homepage.twig', array('store_array' => Store::getAll(), 'brand_array' => Brand::getAll()));
        });

        //brands
        $app->get('/brands', function() use ($app) {

            return $app['twig']->render('homepage.twig', array('store_array' => Store::getAll(), 'brand_array' => Brand::getAll()));
        });

        $app->post('/brands', function() use($app) {

            $name = $_POST['add_brand'];
            $new_brand = new Brand($name);
            $new_brand->save();

            return $app['twig']->render('homepage.twig', array('store_array' => Store::getAll(), 'brand_array' => Brand::getAll()));
        });

    //SINGLE STORE ROUTES
    $app->get('/stores/{id}', function($id) use ($app) {
        $store = Store::findById($id);

        return $app['twig']->render('store.twig', array('store' => $store, 'brand_array' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    $app->post('/stores/{id}', function($id) use ($app) {
        $store = Store::findById($id);
        $brand = Brand::findById($_POST['store_brand']);
        $store->addBrand($brand);

        return $app['twig']->render('store.twig', array('store' => $store, 'brand_array' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    $app->patch('/stores/{id}', function($id) use ($app) {
        $store = Store::findById($id);
        $store->update($_POST['edit_store']);

        return $app['twig']->render('store.twig', array('store' => $store, 'brand_array' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    return $app;
 ?>
