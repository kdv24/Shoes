<?php

    class Store
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
            $this->name = (string) $new_name;
        }

        //DATABASE FUNCTIONS
        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO stores (name) VALUES ('{$this->getName()}') RETURNING id;");
            //only one column, so only use fetch
            $id_row = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($id_row['id']);
        }



        static function getAll()
        {
            $statement = $GLOBALS['DB']->query("SELECT * FROM stores;");
            //getting more than one column, use fetchAll
            $store_rows = $statement->fetchAll(PDO::FETCH_ASSOC);

            $stores = array();
            foreach($store_rows as $row)
            {
                $id = $row['id'];
                $name = $row['name'];
                array_push($stores, new Store($name, $id));
            }
            return $stores;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores *;");
        }

        static function findById($search_id)
        {
            $statement = $GLOBALS['DB']->query("SELECT * FROM stores WHERE id = {$search_id};");
            //still fetching all columns, even with just one row
            $id_row = $statement->fetchAll(PDO::FETCH_ASSOC);

            $found_store = null;
            foreach($id_row as $row)
            {
                $id = $row['id'];
                $name = $row['name'];
                $found_store = new Store($name, $id);
            }
            return $found_store;
        }
    }

 ?>
