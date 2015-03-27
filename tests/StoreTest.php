<?php

    /**
        @backupGlobals disabled
        @backupStaticAttributes disabled
    */

    require_once 'src/Store.php';

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
        }

        function test_delete()
        {
            //arrange
            $test_store = new Store("Shurley Fine Shoes");
            $test_store->save();

            //act
            $test_store->delete();
            $result = Store::getAll();

            //assert
            $this->assertEquals([], $result);
        }

        function test_update_database()
        {
            //arrange
            $test_store = new Store("Secret Sneaker");
            $test_store->save();

            //act
            $test_store->update("Ninja Sneakers");
            $result = Store::findById($test_store->getId());

            //assert
            $this->assertEquals("Ninja Sneakers", $result->getName());
        }

        function test_update()
        {
            //arrange
            $test_store = new Store("Secret Sneaker");
            $test_store->save();

            //act
            $test_store->update("Ninja Sneakers");
            $result = $test_store->getName();

            //assert
            $this->assertEquals("Ninja Sneakers", $result);
        }

        function test_findByName()
        {
            //arrange
            $test_store = new Store("Raymond Discount Shoe Surplus");
            $test_store->save();
            $test_store2 = new Store("Shoe Bobs");
            $test_store2->save();
            $test_store3 = new Store("Thifty Sneakers");
            $test_store3->save();

            //act
            $result = Store::findByName("Shoe");

            //assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function test_findById()
        {
            //arrange
            $test_store = new Store("Raymond Discount Shoe Surplus");
            $test_store->save();

            //act
            $result = Store::findById($test_store->getId());

            //assert
            $this->assertEquals($test_store, $result);
        }

        function test_save()
        {
            //arrange
            $test_store = new Store("Ryan Shoe");

            //act
            $test_store->save();
            $result = Store::getAll();

            //assert
            $this->assertEquals([$test_store], $result);
        }

        function test_setName()
        {
            //arrange
            $test_store = new Store("Discount Shoe", 1);

            //act
            $test_store->setName("Shoe Plus");
            $result = $test_store->getName();

            //assert
            $this->assertEquals("Shoe Plus", $result);
        }

        function test_getName()
        {
            //arrange
            $test_store = new Store("Discount Shoe", 1);

            //act
            $result = $test_store->getName();

            //assert
            $this->assertEquals("Discount Shoe", $result);
        }

        function test_setId()
        {
            //arrange
            $test_store = new Store("Discount Shoe", 1);

            //act
            $test_store->setId(15);
            $result = $test_store->getId();

            //assert
            $this->assertEquals(15, $result);
        }

        function test_getId()
        {
            //arrange
            $test_store = new Store("Discount Shoe", 1);

            //act
            $result = $test_store->getId();

            //assert
            $this->assertEquals(1, $result);
        }
    }







 ?>
