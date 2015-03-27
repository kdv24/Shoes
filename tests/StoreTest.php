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
