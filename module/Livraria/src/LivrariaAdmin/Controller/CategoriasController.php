<?php

namespace LivrariaAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;

class CategoriasController extends AbstractActionController
{
    protected $entityManager;

    public function indexAction()
    {
        $list = $this->getEntityManager()
                     ->getRepository('Livraria\Entity\Categoria')
                     ->findAll();

        $page = $this->params()->fromRoute('page');
        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage(5);

        return new ViewModel(array('data' => $paginator, 'page' => $page));
    }

    public function newAction()
    {
        
    }

    protected function getEntityManager()
    {
        if(null === $this->entityManager){
            $this->entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            return $this->entityManager;
        }
    }
}