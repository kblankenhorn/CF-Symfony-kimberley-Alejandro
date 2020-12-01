<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;

class ProductController extends AbstractController
{
    /**
    * @Route("/", name="indexAction")
    */ 
    public  function indexAction()
    {
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll(); // this variable $products will store the result of running a query to find all the products
         return $this->render('product/index.html.twig', array("products"=>$products)); // i send the variable that have all the products as an array of objects to the index.html.twig page
    }



    /**
    * @Route("/create", name="createAction")
    */
    public function createAction()
   {  
       
        // you can fetch the EntityManager via $this->getDoctrine()
       // or you can add an argument to your action: createAction(EntityManagerInterface $em)
       $em = $this->getDoctrine()->getManager();
       $product = new  Product(); // here we will create an object from our class Product.
       $product->setImage('https://cdn.pixabay.com/photo/2017/09/12/15/36/moscow-2742642_1280.jpg');
       $product->setName( 'Russia'); // in our Product class we have a set function for each column in our db
       $product->setPrice( 1800);
       $product->setDescription('Take a trip to Russia');

       // tells Doctrine you want to (eventually) save the Product (no queries yet)
       $em->persist($product);
        // actually executes the queries (i.e. the INSERT query)
       $em->flush();
       return  new Response('Saved new product with id '.$product->getId());
   }
   
    
}
