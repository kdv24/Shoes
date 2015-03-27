<?php

    class Brand
    {
        private $id;
        private $name;

        function __construct($new_name, $new_id = null)
        {
            $this->name = $new_name;
            $this->id = $new_id;
        }

        //GETTERS
        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }

        //SETTERS
        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        //DATABASE FUNCTIONS
        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO brands (name) VALUES ('{$this->getName()}') RETURNING id;");
            $id_row = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($id_row['id']);
        }


        //STATIC FUNCTIONS
        static function getAll()
        {
            $statement = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $brand_rows = $statement->fetchAll(PDO::FETCH_ASSOC);

            $brands = array();
            foreach($brand_rows as $row)
            {
                $id = $row['id'];
                $name = $row['name'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands *;");
        }
    }

 ?>
