<?php
    namespace Entity;

    use \OCFram\Entity;

    class News extends Entity
    {
        const INVALID_AUTHOR = 1;
        const INVALID_CONTENT = 2;
        const INVALID_TITLE = 3;

        protected   $title,
                    $author,
                    $content,
                    $dateAdd,
                    $dateModif;
        
        

        public function isValid()
        {
            return !(empty($this->author) || empty($this->title) || empty($this->content));
        }

        public function id(){ return $this->id; }
        public function title(){ return $this->title; }
        public function author(){ return $this->author; }
        public function content(){ return $this->content; }
        public function dateAdd(){ return $this->dateAdd; }
        public function dateModif(){ return $this->dateModif; }

        public function setId($id)
        {
            $id = (int) $id;
            if ($id > 0)
            {
                $this->id = $id;
            }
        }

        public function setAuthor($author)
        {
            if (!is_string($author) || empty($author))
            {
                $this->erros[] = self::INVALID_AUTHOR;
            }
            else
            {
                $this->author = $author;
            }
        }

        public function setTitle($title)
        {
            if (!is_string($title) || empty($title))
            {
                $this->erros[] = self::INVALID_TITLE;
            }
            else
            {
                $this->title = $title;
            }
        }

        public function setContent($content)
        {
            if (!is_string($content) || empty($content))
            {
                $this->erros[] = self::INVALID_CONTENT;
            }
            else
            {
                $this->content = $content;
            }
        }

        public function setDateAdd(DateTime $dateAdd)
        {
            $this->dateAdd = $dateAdd;
        }

        public function setDateModif(DateTime $dateModif)
        {
            $this->dateModif = $dateModif;
        }
        
    }