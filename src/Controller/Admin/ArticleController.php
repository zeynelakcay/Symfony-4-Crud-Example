<?php
namespace App\Controller\Admin ;


use App\Entity\Admin\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




class ArticleController extends AbstractController {

    private $articleService;
    private $categoryService;
    /**
     * @Route ("/admin/article", name="article_list")
     * @return Response
     */
    public function article(){
        $this->articleService = $this->container->get('article.service');
        $articles = $this->articleService->getAllArticles();
        return $this->render('articles/index.html.twig', array
        ('articles' => $articles));
    }

    /**
     * @Route ("/admin/article/new", name="new_article")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function new(Request $request){

        $article = new Article();
        $this->categoryService = $this->container->get('category.service');
        $categories = $this->categoryService->getCategories();

        var_dump($categories);
        

        $form = $this->createFormBuilder($article)
            ->add('category', ChoiceType::class, array(
                'choices' => $categories
            ))
            ->add('title', TextType::class, array('attr' =>array('class' => 'form-control')))
            ->add('body', TextareaType::class, array('required' =>false,
                'attr' =>array('class' =>'form-control')))
            ->add('save', SubmitType::class, array(
                'label' =>'Create',
                'attr' =>array('class'=>'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $article = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article_list');
        }

        return $this->render('articles/new.html.twig',array(
            'form'=>$form->createView()
        ));
    }

    /**
     * @Route ("/admin/article/{id}", name= "article_show")
     * @param $id
     * @return Response
     */

    public function show($id){
        $this->articleService = $this->container->get('article.service');
        $article = $this->articleService->getArticle($id);
        return $this->render('articles/show.html.twig', array('article' =>$article));
    }

    /**
     * @Route ("/admin/article/update/{id}", name="update_article")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */

    public function update(Request $request, $id){
        $this->articleService = $this->container->get('article.service');
        $article = $this->articleService->getArticle($id);

        $form = $this->createFormBuilder($article)
            ->add('title', TextType::class, array('attr' =>array('class' => 'form-control')))
            ->add('body', TextareaType::class, array('required' =>false,
                'attr' =>array('class' =>'form-control')))
            ->add('save', SubmitType::class, array(
                'label' =>'Update',
                'attr' =>array('class'=>'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $this->articleService->addArticle($form->getData());

            return $this->redirectToRoute('article_list');
        }

        return $this->render('articles/update.html.twig',array(
            'form'=>$form->createView()
        ));
    }

    /**
     * @Route ("/admin/article/delete/{id}")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */

    public function delete($id){
        $this->articleService = $this->container->get('article.service');
        $this->articleService->deleteArticle($id);
        return $this->redirectToRoute('article_list');
    }


    public static function getSubscribedServices()
    {
        return array_merge(parent::getSubscribedServices(), [
            // ...
            'article.service' => \App\Service\Admin\ArticleService::class,
            'category.service' => \App\Service\Admin\CategoryService::class,
        ]);
    }
}

