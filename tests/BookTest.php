<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Book.php";

    $DB = new PDO('pgsql:host=localhost;dbname=library_test');

    class BookTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Book::deleteAll();
        //     Patron::deleteAll();
        // }

        function test_getAuthor()
        {
            //Arrange
            $author = "Tom Clancy";
            $title = "Hunt For The Red October";
            $duedate = "5/15/2015";
            $id = 1;
            $test_book = new Book($author, $title, $duedate, $id);

            //Act
            $result = $test_book->getAuthor();

            //Assert
            $this->assertEquals($author, $result);
        }

        function test_getTitle()
        {
            //Arrange
            $author = "Tom Clancy";
            $title = "Hunt For The Red October";
            $duedate = "5/15/2015";
            $id = 1;
            $test_book = new Book($author, $title, $duedate, $id);

            //Act
            $result = $test_book->getTitle();

            //Assert
            $this->assertEquals($title, $result);
        }

        function test_getDuedate()
        {
            //Arrange
            $author = "Tom Clancy";
            $title = "Hunt For The Red October";
            $duedate = "5/15/2015";
            $id = 1;
            $test_book = new Book($author, $title, $duedate, $id);

            //Act
            $result = $test_book->getDuedate();

            //Assert
            $this->assertEquals($duedate, $result);

        }

        function test_getId()
        {
            //Arrange
            $author = "Tom Clancy";
            $title = "Hunt For The Red October";
            $duedate = "5/15/2015";
            $id = 1;
            $test_book = new Book($author, $title, $duedate, $id);

            //Act
            $result = $test_book->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_setId()
        {
            //Arrange
            $author = "Tom Clancy";
            $title = "Hunt For The Red October";
            $duedate = "5/15/2015";
            $id = null;
            $test_book = new Book($author, $title, $duedate, $id);

            //Act
            $test_book->setId(1);

            //Assert
            $result = $test_book->getId();
            $this->assertEquals(1, $result);


        }

    }
?>
