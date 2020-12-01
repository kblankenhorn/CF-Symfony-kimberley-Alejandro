<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;

class DetailsController extends AbstractController
{

/**
    * @Route("/details/{productId}", name="detailsAction")
    */ 
    public function showdetailsAction($productId)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($productId);
         if (!$product) {
            throw  $this->createNotFoundException(
                 'No product found for id '.$productId
            );
        } else {
                 return $this->render("product/details.html.twig",array("product"=>$product));
                 /*new Response('Option: ' .$productId."<br><img src='" .$product->getImage()."'><br> Product name is: ".$product->getName(). "<br> costs: " .$product->getPrice()."€ <br>" .$product->getDescription());*/
        }
    }

}