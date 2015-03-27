<?php


    require_once 'src/Brand.php';


    class BrandTest extends PHPUnit_Framework_TestCase
    {
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
