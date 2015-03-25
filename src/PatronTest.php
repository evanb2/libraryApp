<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Patron.php";
    require_once "src/Book.php";

    $DB = new PDO('pgsql:host=localhost;dbname=library_test');

    class PatronTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Patron::deleteAll();
            Book::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Tiny Tim";
            $phone = "555-345-7895";
            $id = 2;
            $test_patron = new Patron($name, $phone, $id);

            //Act
            $result = $test_patron->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getPhone()
        {
            //Arrange
            $name = "Tiny Tim";
            $phone = "555-345-7895";
            $id = 2;
            $test_patron = new Patron($name, $phone, $id);

            //Act
            $result = $test_patron->getPhone();

            //Assert
            $this->assertEquals($phone, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Tiny Tim";
            $phone = "555-345-7895";
            $id = 2;
            $test_patron = new Patron($name, $phone, $id);

            //Act
            $result = $test_patron->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_setName()
        {
            //Arrange
            $name = "Tiny Tim";
            $phone = "555-345-7895";
            $id = 2;
            $test_patron = new Patron($name, $phone, $id);

            //Act
            $test_patron->setName("Yarbles");
            $result = $test_patron->getName();

            //Assert
            $this->assertEquals("Yarbles", $result);
        }

        function test_setPhone()
        {
            //Arrange
            $name = "Tiny Tim";
            $phone = "555-345-7895";
            $id = 2;
            $test_patron = new Patron($name, $phone, $id);

            //Act
            $test_patron->setPhone("123-921-2189");
            $result = $test_patron->getPhone();

            //Assert
            $this->assertEquals("123-921-2189", $result);
        }

        function test_setId()
        {
            //Arrange
            $name = "Tiny Tim";
            $phone = "555-345-7895";
            $id = 2;
            $test_patron = new Patron($name, $phone, $id);

            //Act
            $test_patron->setId(3);
            $result = $test_patron->getId();

            //Assert
            $this->assertEquals(3, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Tiny Tim";
            $phone = "555-345-7895";
            $id = 2;
            $test_patron = new Patron($name, $phone, $id);

            //Act
            $test_patron->save();

            //Assert
            $result = Patron::getAll();
            $this->assertEquals($test_patron, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Tiny Tim";
            $phone = "555-345-7895";
            $id = 2;
            $test_patron = new Patron($name, $phone, $id);
            $test_patron->save();

            $name2 = "Jimmy John";
            $phone2 = "892-382-1910";
            $id2 = 3;
            $test_patron2 = new Patron($name2, $phone2, $id2);
            $test_patron2->save();

            //Act
            $result = Patron::getAll();

            //Assert
            $this->assertEquals([$test_patron, $test_patron2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Tiny Tim";
            $phone = "555-345-7895";
            $id = 2;
            $test_patron = new Patron($name, $phone, $id);
            $test_patron->save();

            $name2 = "Jimmy John";
            $phone2 = "892-382-1910";
            $id2 = 3;
            $test_patron2 = new Patron($name2, $phone2, $id2);
            $test_patron2->save();

            //Act
            Patron::deleteAll();

            //Assert
            $result = Patron::getAll();
            $this->assertEquals([], $result);
        }
    }
?>
