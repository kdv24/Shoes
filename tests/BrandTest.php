<?php

    /**
        @backupGlobals disabled
        @backupStaticAttributes disabled
    */

    require_once 'src/Brand.php';
    require 'setup.config';

    # If connection is being refused and you are using Postgres.app without a specific
    # try removing the $DB_USER, $DB_PASS arguments.
    $DB = new PDO("pgsql:host=localhost;dbname=shoe_test;", $DB_USER, $DB_PASS);


    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Brand::deleteAll();
            Store::deleteAll();
        }

        function test_addStore()
        {
            //arrange
            $test_brand = new Brand("Adias");
            $test_brand->save();

            $test_store = new Store("Happy Hal Shoes");
            $test_store->save();
            $test_store2 = new Store("Sammy Shoes");
            $test_store2->save();

            //act
            $test_brand->addStore($test_store);
            $test_brand->addStore($test_store2);
            $result = $test_brand->getStores();

            //assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function test_delete_getStores()
        {
            //arrange
            $test_brand = new Brand("Good");
            $test_brand->save();

            $test_store = new Store("Goodwill");
            $test_store->save();
            $test_store2 = new Store("Granite Run Shoes");
            $test_store2->save();

            $test_brand->addStore($test_store);
            $test_brand->addStore($test_store2);

            //act
            $test_brand->delete();
            $result = $test_brand->getStores();

            //assert
            $this->assertEquals([], $result);
        }

        function test_delete_getBrands()
        {
            //arrange
            $test_brand = new Brand("Good");
            $test_brand->save();

            $test_store = new Store("Goodwill");
            $test_store->save();
            $test_store2 = new Store("Granite Run Shoes");
            $test_store2->save();

            $test_brand->addStore($test_store);
            $test_brand->addStore($test_store2);

            //act
            $test_brand->delete();
            $result = $test_store->getBrands();

            //assert
            $this->assertEquals([], $result);
        }

        function test_delete()
        {
            //arrange
            $test_brand = new Brand("Good");
            $test_brand->save();
            //act
            $test_brand->delete();
            $result = Brand::findById($test_brand->getId());

            //assert
            $this->assertEquals(null, $result);
        }

        function test_update_database()
        {
            //arrange
            $test_brand = new Brand("Smarties");
            $test_brand->save();

            //act
            $test_brand->update("Smarties Shoes");
            $result = Brand::findById($test_brand->getId());

            //assert
            $this->assertEquals("Smarties Shoes", $result->getName());
        }

        function test_update()
        {
            //arrange
            $test_brand = new Brand("Smarties");
            $test_brand->save();

            //act
            $test_brand->update("Smarties Shoes");
            $result = $test_brand->getName();

            //assert
            $this->assertEquals("Smarties Shoes", $result);
        }

        function test_findByName()
        {
            //arrange
            $test_brand = new Brand("Good Runs Shoeing Wares");
            $test_brand->save();
            //act
            $result = Brand::findByName("Good");

            //assert
            $this->assertEquals([$test_brand], $result);
        }

        function test_findById()
        {
            //arrange
            $test_brand = new Brand("Sketchers");
            $test_brand->save();
            //act
            $result = Brand::findById($test_brand->getId());

            //assert
            $this->assertEquals($test_brand, $result);
        }

        function test_deleteAll()
        {
            //arrange
            $test_brand = new Brand("Reebok");
            $test_brand2 = new Brand("Nike");

            //act
            $test_brand->save();
            $test_brand2->save();
            Brand::deleteAll();
            $result = Brand::getAll();

            //assert
            $this->assertEquals([], $result);
        }

        function test_save()
        {
            //arrange
            $test_brand = new Brand("Reebok");

            //act
            $test_brand->save();
            $result = Brand::getAll();

            //assert
            $this->assertEquals([$test_brand], $result);
        }

        //NON DATABASE TESTS
        function test_getName()
        {
            //arrange
            $test_brand = new Brand("Nike");

            //act
            $result = $test_brand->getName();

            //assert
            $this->assertEquals("Nike", $result);
        }

        function test_setName()
        {
            //arrange
            $test_brand = new Brand("Nke");

            //act
            $test_brand->setName("Nike");
            $result = $test_brand->getName();

            //assert
            $this->assertEquals("Nike", $result);
        }

        function test_getId()
        {
            //arrange
            $test_brand = new Brand("Nike", 1);

            //act
            $result = $test_brand->getId();

            //assert
            $this->assertEquals(1, $result);
        }

        function test_setId()
        {
            //arrange
            $test_brand = new Brand("Nike", 1);

            //act
            $test_brand->setId(15);
            $result = $test_brand->getId();

            //assert
            $this->assertEquals(15, $result);
        }
    }



 ?>
