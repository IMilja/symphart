<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article", name="article.")
 */
class ArticleController extends AbstractController {

	/**
	 * @Route("/", name="index");
	 */
	public function index() {

		$articles = $this->getDoctrine()->getRepository( Article::class )->findAll();

		return $this->render( 'articles/index.html.twig', [
			'articles' => $articles
		] );
	}


	/**
	 * @Route("/create", name="create")
	 */
	public function create( Request $request ) {
		$article = new Article();

		$form = $this->createFormBuilder( $article )
		             ->add( 'title', TextType::class )
		             ->add( 'body', TextareaType::class )
		             ->add( 'save', SubmitType::class, [ 'label' => 'Create' ] )
		             ->getForm();

		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$article = $form->getData();

			$em = $this->getDoctrine()->getManager();

			$em->persist( $article );
			$em->flush();


			return $this->redirectToRoute( "article.index" );
		}

		return $this->render( 'articles/create.html.twig', [
			'form' => $form->createView(),
		] );

	}

	/**
	 * @Route("/view/{id}", name="view")
	 * @param $id
	 *
	 * @return Response
	 */
	public function view( $id ) {
		$article = $this->getDoctrine()->getRepository( Article::class )->find( $id );

		return $this->render( 'articles/view.html.twig', [
			'article' => $article
		] );
	}
}