<?php
    Class Patron
    {
        private $name;
        private $phone;
        private $id;

        function __construct($name, $phone, $id = null)
        {
            $this->name = $name;
            $this->phone = $phone;
            $this->id = $id;
        }

        //setters
        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function setPhone($new_phone)
        {
            $this->phone = (string) $new_phone;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        //getters
        function getName()
        {
            return $this->name;
        }

        function getPhone()
        {
            return $this->phone;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO patrons (name, phone) VALUES ('{$this->getName()}', '{$this->getPhone()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()
        {
            $returned_patrons = $GLOBALS['DB']->query("SELECT * FROM patrons;");
            $patrons = array();
            foreach($returned_patrons as $patron) {
                $name = $patron['name'];
                $phone = $patron['phone'];
                $id = $patron['id'];
                $new_patron = new Patron($name, $phone, $id);
                array_push($patrons, $new_patron);
            }
            return $patrons;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM patrons *;");
        }
    }
?>
