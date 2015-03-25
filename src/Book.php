<?php
    Class Book
    {
        private $author;
        private $title;
        private $duedate;
        private $id;

        function __construct($author, $title, $duedate, $id = null)
        {
            $this->author = $author;
            $this->title = $title;
            $this->duedate = $duedate;
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

        function setDuedate($new_duedate)
        {
            $this->duedate = (string) $new_duedate;
        }

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

        function getDuedate()
        {
            return $this->duedate;
        }

        function getId()
        {
            return $this->id;
        }
    }
?>
