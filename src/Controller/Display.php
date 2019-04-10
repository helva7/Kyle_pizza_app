<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Orders;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;   

class Display extends AbstractController
{
    /**
     * @Route("/display", name="display") methods={"GET","POST"}
     */
    public function displayAllOrders()
    {
        
		$entityManager = $this->getDoctrine()->getManager();   

		$type = $request->request->get('type', 'none'); // to send ourself in different directions
		
		
		
		if($type == 'getallorders'){

			$orders = $this->getDoctrine()->getRepository(Orders::class)->findAll();
	  
			$output = '<table>'; // html the user will see
		   
			foreach($orders as $pro){
			   
			   $output .= '<tr>'; // one row
			   $output .= '<td>' . $pro->getPlacedby() . '</td>'; // one column
			   
			   
			   // making the column
			   $output .= '<td>'; //next column
			   $data = explode('=', $pro->getDetails()); // get the raw serialized order, breaking when we see the equals
			   
				foreach($data as $record) {    // e.g., pizza-4 one record! 
			   

					$item = explode('-',$record); // break it apart based on the dash.
					
					$output .= 'Item: ' . $item[0]. ' ';
					$output .='Qty: ' . $item[1] . ' <br>';
				
				
				
				}
			   
			   
			   
			   $output .= '</td>'; // raw serialized data
			   
			   // add here another column.
			   
			   $output .= '</tr>';        
			   
			   
			   
			
			}
		  
		  
			$output .= '</table>';

			return new Response(
				'all ok' . $output
			);
        }
    }
}
