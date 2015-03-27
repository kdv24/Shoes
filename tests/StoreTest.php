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
