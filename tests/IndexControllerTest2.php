<?php
namespace App\Tests;

use PHPUnit\Framework\TestCase;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class IndexControllerTest2 extends TestCase
{
    	
	public function returnUserIdTest()
	{ //
		$id = 0;
		
		$login = new IndexController();
	
		$result = $login->getUserID();
	
		$this->assertEquals(18, $result);
	}
	
	public function testNumber()
    {
        $index = new IndexController();
        
        
        $result2 = $index->getANumber();
       
        
        $this->assertEquals(55, $result2);
    }
	
	
}
