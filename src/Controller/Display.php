<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Orders;
use App\Entity\Login;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;   
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use DateTimeInterface;


class Display extends AbstractController
{
	private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
	
	
    /**
     * @Route("/displayDriver", name="display_driver") methods={"GET", "POST"}
     */
	 
    public function displayDriverOrders(SessionInterface $session)
    {	
		$repo = $this->getDoctrine()->getRepository(Orders::class);
			
		$orders = $repo->findBy(['status' => 'pending']);
		
		if (!$orders) {
			throw $this->createNotFoundException(
				'No orders found '
			);
		}
		
		else 
		{
			return $this->render('orders/driverOrders.html.twig', ['orders'=>$orders]);
		}
		
		
	}	
	
		/*
		
		$output = '<table>'; // html the user will see
       
		foreach($orders as $po){
           
			$output .= '<tr>'; // one row
			$output .= '<td>' . $po->getId() . '</td>'; // one column   

//			$output .= '<td>' . $po->getDate()->format('d.m.Y'); . '</td>'; // one column 


			$output .= '<td>' . $po->getPlacedby() . '</td>'; // one column  
			$output .= '<td>' . $po->getOrdered() . '</td>'; // one column 
			$output .= '<td>' . $po->getTotal() . '</td>'; // one column 
			$output .= '<td>' . $po->getStatus() . '</td>'; // one column 
				
			$output .= '</tr>'; 
		}
		
		
			
		$output .= '</table>';

        return new Response(
            $output
        );
		
		
        
    }
	
	
}
	
*/	
	/**
     * @Route("/displayCustomer", name="display_customer") methods={"GET", "POST"}
     */

	public function displayCustomerOrders(SessionInterface $session)
    {	
		$request = Request::createFromGlobals(); // the envelope, and were looking inside it.
		
		$placedby = $session->get('username');
				
		$repo = $this->getDoctrine()->getRepository(Orders::class);
			
		$orders = $repo->findBy(['placedby' => $placedby]);
		
		if (!$orders) {
			throw $this->createNotFoundException(
				'No orders found for '.$placedby
			);
		}
		
		else 
		{
			return $this->render('orders/customerOrders.html.twig', ['orders'=>$orders]);
		}
		
		
	}
	
	
	/**
     * @Route("/delivered", name="delivered") methods={"GET", "POST"}
     */

	public function markDelivered(SessionInterface $session)
    {	
		$request = Request::createFromGlobals(); // the envelope, and were looking inside it.
		
		$entityManager = $this->getDoctrine()->getManager();
		
		// get the variable
		$orderID = $request->request->get('id', 'none');

		$repo = $this->getDoctrine()->getRepository(Orders::class);
			
		$order = $repo->findOneBy(['id' => $orderID]);
		
		if (!$order) {
			throw $this->createNotFoundException(
				'No orders found for '.$orderID
			);
		}
		
		$order->setStatus('Delivered');
		
		$entityManager->persist($order);
		
		$entityManager->flush();
		
		
		$orders = $repo->findBy(['status' => 'pending']);
		
		if (!$orders) {
			throw $this->createNotFoundException(
				'No orders found '
			);
		}
		
		else 
		{
			return $this->render('orders/driverOrders.html.twig', ['orders'=>$orders]);
		}

	}
		
	
	/**
     * @Route("/deleteOrder", name="deleteOrder"") methods={"GET", "POST"}
     */

	public function markDelivered(SessionInterface $session)
    {	
		$request = Request::createFromGlobals(); // the envelope, and were looking inside it.
		
		$entityManager = $this->getDoctrine()->getManager();
		
		// get the variable
		$orderID = $request->request->get('id', 'none');

		$repo = $this->getDoctrine()->getRepository(Orders::class);
			
		$order = $repo->findOneBy(['id' => $orderID]);
		
		if (!$order) {
			throw $this->createNotFoundException(
				'No orders found for '.$orderID
			);
		}
		
		$entityManager->remove($order);
		
		$entityManager->flush();
		
		
		$orders = $repo->findBy(['status' => 'pending']);
		
		if (!$orders) {
			throw $this->createNotFoundException(
				'No orders found '
			);
		}
		
		else 
		{
			return $this->render('orders/driverOrders.html.twig', ['orders'=>$orders]);
		}

	}
	
	
	
}	

