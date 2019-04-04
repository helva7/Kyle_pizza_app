<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Products;

class ProductsController extends AbstractController
{
    /**
     * @Route("/products", name="products")
     */
    public function index()
    {
        
        // This blob puts a new record in the database
        $entityManager = $this->getDoctrine()->getManager();

        $product1 = new Products();
        $product1->setProductName('Hawaiian pizza small');
        $product1->setProductPrice('5');
		
			$product2 = new Products();
			$product2->setProductName('Hawaiian pizza medium');
			$product2->setProductPrice('10');
      
        $entityManager->persist($product1);
		$entityManager->persist($product2);
		
        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        
        // this bit just renders a template after it does the insert statement.		
		
				
		return $this->render('products/index.html.twig', [
            'controller_name' => 'ProductsController',
        ]);
    }
}
