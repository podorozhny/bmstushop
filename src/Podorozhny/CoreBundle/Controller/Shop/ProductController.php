<?php

namespace Podorozhny\CoreBundle\Controller\Shop;

use Podorozhny\CoreBundle\Controller\AbstractController;
use Podorozhny\Manager\Shop\ProductManager;

class ProductController extends AbstractController {
    private $productManager;

    public function __construct(ProductManager $productManager) {
        $this->productManager = $productManager;
    }

    public function showAction($product_slug) {
        $product = $this->productManager->findBySlug($product_slug);

        if (!$product) {
            throw $this->createNotFoundException(sprintf('No product "%s" found', $product_slug));
        }

        return $this->render('CoreBundle:Shop/Product:show.html.twig', [
            'product' => $product,
        ]);
    }
}