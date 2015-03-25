<?php
    Class Book
    {
        private $author;
        private $title;
        // private $duedate;
        private $id;

        function __construct($author, $title, $id = null)
        {
            $this->author = $author;
            $this->title = $title;
            // $this->duedate = $duedate;
            $this->id = $id;
        }
        //setters
        function setAuthor($new_author)
        {
            $this->author = (string) $new_author;
        }

        function setTitle($new_title)
        {
            $this->title = (string) $new_title;
        }

        // function setDuedate($new_duedate)
        // {
        //     $this->duedate = (string) $new_duedate;
        // }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }
        //getters
        function getAuthor()
        {
            return $this->author;
        }

        function getTitle()
        {
            return $this->title;
        }

        // function getDuedate()
        // {
        //     return $this->duedate;
        // }

        function getId()
        {
            return $this->id;
        }

        static function getAll()
        {
            $returned_books = $GLOBALS['DB']->query("SELECT * FROM books;");
            $books = array();
            foreach($returned_books as $book) {
                $author = $book['author'];
                $title = $book['title'];
                // $duedate = $book['duedate'];
                $id = $book['id'];
                $new_book = new Book($author, $title, $id);
                array_push($books, $new_book);
            }
            return $books;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO books (author, title) VALUES ('{$this->getAuthor()}', '{$this->getTitle()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM books*;");
        }
    }
?>