<?php

namespace Podorozhny\CoreBundle\Controller\Shop;

use Podorozhny\CoreBundle\Controller\AbstractController;
use Podorozhny\Manager\Shop\ProductCategoryManager;

class ProductCategoryController extends AbstractController {
    private $categoryManager;

    public function __construct(ProductCategoryManager $categoryManager) {
        $this->categoryManager = $categoryManager;
    }

    public function listAction() {
        $categories = $this->categoryManager->findAllParents();

        return $this->render('CoreBundle:Shop/ProductCategory:list.html.twig', [
            'categories' => $categories,
        ]);
    }

    public function showAction($category_slug) {
        $category = $this->categoryManager->findBySlug($category_slug);

        if (!$category) {
            throw $this->createNotFoundException(sprintf('No category "%s" found', $category_slug));
        }

        return $this->render('CoreBundle:Shop/ProductCategory:show.html.twig', [
            'category' => $category,
        ]);
    }
}