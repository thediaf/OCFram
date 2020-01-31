<?php
    namespace Model;

    use \Entity\Comment;

    class CommentsManagerPDO extends CommentsManager
    {
        protected function add(Comment $comment)
        {
            $q = $this->dao->prepare('INSERT INTO comments SET news = :news, author = :author, content = :content, date = NOW()');

            $q->bindValue(':news', $comment->news(), \PDO::PARAM_INT);
            $q->bindValue(':author', $comment->author());
            $q->bindValue(':content', $comment->content());
            $q->execute();

            $comment->setId($this->dao->lastInsertId());
        }

        public function getListOf($news)
        {
            if (!ctype_digit($news))
            {
                throw new \InvalidArgumentException('L\'identifiant de la news passe doit etre un nombre entier valide');
            }

            $q = $this->dao->prepare('SELECT id, news, author, content,date FROM comments WHERE news = :news');

            $q->bindValue(':news', $news, \PDO::PARAM_INT);
            $q->execute();
            
            $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

            $comments = $q->fetchAll();

            foreach ($comments as $comment)
            {
                $comment->setDate(new \DateTime($comment->date()));
            }
        }
    }