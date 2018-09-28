<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\Finder\Finder;

/**
 * Import the PDF Parser class
 */
use Smalot\PdfParser\Parser;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repo)
    {
        //$repo = $this->getDoctrine()->getRepository(Article::class);

        $articles = $repo->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(){
        return $this->render('blog/home.html.twig',[
            "title"=>"Bienvenue ici les amis",
            "age"=>31
        ]);
    }
    
    /**
     * @Route("/blog/new",name="blog_create")
     */
    public function create(Request $request){
        $article = new Article();

        $form = $this->createFormBuilder($article)
                     ->add('title')
                     ->add('content')
                     ->add('image')
                     ->getForm();

        return $this->render('blog/create.html.twig',[
            'formArticle'=>$form->createView()
        ]);
    }

    /**
     * @Route("/blog/{id}",name="blog_show")
     */
    public function show(Article $article){
        //$repo = $this->getDoctrine()->getRepository(Article::class);
        //$article = $repo->find($id);
        // Utilisation ici du paraConcerter de symfony
        return $this->render('blog/show.html.twig',[
            'article'=>$article
        ]);
    }

    /**
     * @Route("/explode",name="blog_explode")
     */
    public function explode(){
          // The relative or absolute path to the PDF file


          $finder = new Finder();
        $finder->files()->in(__DIR__);

        foreach ($finder as $file) {
            // dumps the absolute path
            var_dump($file->getRealPath());

            // dumps the relative path to the file, omitting the filename
            var_dump($file->getRelativePath());

            // dumps the relative path to the file
            var_dump($file->getRelativePathname());
        }
          
          //$pdfFilePath = $this->get('kernel')->getRootDir() . 'exemple.pdf';

          // Create an instance of the PDFParser
          //$PDFParser = new Parser();
  
          // Create an instance of the PDF with the parseFile method of the parser
          // this method expects as first argument the path to the PDF file
          //$pdf = $PDFParser->parseFile($pdfFilePath);
          
          // Extract ALL text with the getText method
          //$text = $pdf->getText();
  
          // Send the text as response in the controller
          return $this->render('blog/explode.html.twig',[
            'text'=>"qsdqsd"
        ]);
    }

}
