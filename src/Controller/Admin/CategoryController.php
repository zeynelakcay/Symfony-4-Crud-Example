<?php

namespace App\Controller\Admin;


use App\Entity\Admin\Category;
use App\Form\Admin\Category\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    private $categoryService;

    /**
     * @Route("/admin/category", name="admin_category")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $this->categoryService = $this->container->get('category.service');
        $categories = $this->categoryService->getCategories();
        return $this->render('admin/category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/admin/category/add", name="admin_add_category")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addCategory(Request $request)
    {
        $categoryTask = new Category();
        $form = $this->createForm(CategoryType::class,$categoryTask);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $categoryFormData = $form->getData();
            $categoryService = $this->container->get('category.service');
            try{
                $categoryService->addCategory($categoryFormData);
                $this->addFlash('success', 'İşlem Başarı İle Gerçekleşti.');
            }
            catch(\Exception $e){
                $this->addFlash('error', 'İşlem Gerçekleşmedi.');
            }

            return $this->redirectToRoute('admin_category');

        }


        return $this->render('admin/category/add_category.html.twig', [
            'category_form' => $form->createView(),
        ]);
    }

    public static function getSubscribedServices()
    {
        return array_merge(parent::getSubscribedServices(), [
            // ...
            'category.service' => \App\Service\Admin\CategoryService::class,
        ]);
    }
}
