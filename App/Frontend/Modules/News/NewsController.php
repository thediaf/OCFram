<?php
    namespace App\Frontend\Modules\News;

    use \OCFram\BackController;
    use \OCFram\HTTPRequest;
    use \OCFram\Comment;

    class NewsController extends BackController
    {
        public function executeIndex(HTTPRequest $request)
        {
            $nombreNews = $this->app->config()->get('nombre_news');
            $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
            
            $this->page->addVar('title', 'Liste des '.$nombreNews.' dernières news');
            
            $manager = $this->managers->getManagerOf('News');
            
            $listeNews = $manager->getList(0, $nombreNews);
            
            foreach ($listeNews as $news)
            {
                if (strlen($news->contenu()) > $nombreCaracteres)
                {
                    $debut = substr($news->contenu(), 0, $nombreCaracteres);
                    $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
                    
                    $news->setContenu($debut);
                }
            }
            
            $this->page->addVar('listeNews', $listeNews);
        }

        public function executeShow(HTTPRequest $request)
        {
            $new = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));

            if (empty($news))
            {
                $this->app->httpReponse()->redirect404();
            }

            $this->page->addVar('title', $new->title());
            $this->page->addVar('news', $news);
        }

        public function executeInsertComment(HTTPRequest $request)
        {
            $this->page->addVar('title', 'Ajout d\'un commentaire');

            if ($request->postExists('pseudo'))
            {
                $comment = new Comment([
                                'news' => $request->getData('news'),
                                'author' => $request->postData('pseudo'),
                                'content' => $request->postData('contenu')
                            ]);
                
                if ($comment->isValid())
                {
                    $this->managers->getManagerOf('Comments')->save($comment);

                    $this->app->user()->setFlash('Le commentaire a biem été ajouté, merci!');

                    $this->app->httpResponse()->redirect('news-' . $request->getData('news') . '.html');
                }
                else
                {
                    $this->page->addVar('erreurs', $comment->erreurs());
                }

                $this->page->addVar('comment', $comment);
            }
        }
    }