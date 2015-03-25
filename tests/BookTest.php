<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Book.php";

    $DB = new PDO('pgsql:host=localhost;dbname=library_test');

    class BookTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Book::deleteAll();
            // Patron::deleteAll();
        }

        function test_getAuthor()
        {
            //Arrange
            $author = "Tom Clancy";
            $title = "Hunt For The Red October";
            // $duedate = "5/15/2015";
            $id = 1;
            $test_book = new Book($author, $title, $id);

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
            // $duedate = "5/15/2015";
            $id = 1;
            $test_book = new Book($author, $title, $id);

            //Act
            $result = $test_book->getTitle();

            //Assert
            $this->assertEquals($title, $result);
        }

        // function test_getDuedate()
        // {
        //     //Arrange
        //     $author = "Tom Clancy";
        //     $title = "Hunt For The Red October";
        //     $duedate = "5/15/2015";
        //     $id = 1;
        //     $test_book = new Book($author, $title, $id);
        //
        //     //Act
        //     $result = $test_book->getDuedate();
        //
        //     //Assert
        //     $this->assertEquals($duedate, $result);
        //
        // }

        function test_getId()
        {
            //Arrange
            $author = "Tom Clancy";
            $title = "Hunt For The Red October";
            // $duedate = "5/15/2015";
            $id = 1;
            $test_book = new Book($author, $title, $id);

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
            // $duedate = "5/15/2015";
            $id = null;
            $test_book = new Book($author, $title, $id);

            //Act
            $test_book->setId(1);

            //Assert
            $result = $test_book->getId();
            $this->assertEquals(1, $result);
        }

        function test_save()
        {
            //Arrange
            $author = "Tom Clancy";
            $title = "Hunt For The Red October";
            // $duedate = "5/15/2015";
            $id = 1;
            $test_book = new Book($author, $title, $id);
            $test_book->save();

            //Act
            $result= Book::getAll();

            //Assert
            $this->assertEquals($test_book, $result[0]);

        }

        function test_getAll()
        {
            //Arrange
            $author = "Tom Clancy";
            $title = "Hunt For The Red October";
            // $duedate = "5/15/2015";
            $id = 1;
            $test_book = new Book($author, $title, $id);
            $test_book->save();

            $author2 = "Charles Dickens";
            $title2 = "Tale of Two Cities";
            // $duedate2 = "4/23/2015";
            $id2 = 2;
            $test_book2 = new Book ($author2, $title2, $id2);
            $test_book2->save();

            //Act
            $result = Book::getAll();

            //Assert
            $this->assertEquals([$test_book, $test_book2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $author = "Tom Clancy";
            $title = "Hunt For The Red October";
            // $duedate = "5/15/2015";
            $id = 1;
            $test_book = new Book($author, $title, $id);
            $test_book->save();

            $author2 = "Charles Dickens";
            $title2 = "Tale of Two Cities";
            // $duedate2 = "4/23/2015";
            $id2 = 2;
            $test_book2 = new Book ($author2, $title2, $id2);
            $test_book2->save();

            //Act
            Book::deleteAll();
            $result = Book::getAll();

            //Assert
            $this->assertEquals([], $result);

        }

    }
?>
