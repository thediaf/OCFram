<?php
    namespace Entity;

    use \OCFram\Entity;

    class News extends Entity
    {
        const INVALID_AUTHOR = 1;
        const INVALID_CONTENT = 2;
       
        protected   $news,
                    $author,
                    $content,
                    $date;
        
        

        public function isValid()
        {
            return !(empty($this->author) || empty($this->news) || empty($this->content));
        }

        public function id(){ return $this->id; }
        public function news(){ return $this->news; }
        public function author(){ return $this->author; }
        public function content(){ return $this->content; }
        public function date(){ return $this->date; }
       
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

        public function setNews($news)
        {
                $this->news = (int) $news;
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

        public function setDate(DateTime $date)
        {
            $this->date = $date;
        }

        
    }