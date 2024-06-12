<?php

namespace App\Controller;

use App\Form\PostType;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Definiamo una classe MainController che estende AbstractController
 */
class MainController extends AbstractController
{
    // Dichiarazione di una variabile privata per EntityManagerInterface
    private $em;

    /**
     * Il costruttore della classe che riceve un EntityManagerInterface come dipendenza e lo assegna alla variabile privata $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    // Definizione della route per l'homepage ('/')
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        // Recuperiamo tutti i post dal repository
        $posts = $this->em->getRepository(Post::class)->findAll();

        // Ritorniamo la vista 'main/index.html.twig' passando i post recuperati come variabile 'posts'
        return $this->render('main/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    # Definizione della route per creare un nuovo post ('/create-post')
    #[Route("/create-post", name: "create-post")]
    public function createPost(Request $request)
    {
        // Creiamo un nuovo oggetto Post
        $post = new Post();
        // Creiamo un form associato al tipo PostType e al nuovo post
        $form = $this->createForm(PostType::class, $post);

        // Gestiamo la richiesta del form
        $form->handleRequest($request);

        // Se il form è stato inviato e i dati sono validi
        if ($form->isSubmitted() && $form->isValid()) {
            // Persistiamo il nuovo post nel database
            $this->em->persist($post);
            // Salviamo le modifiche nel database
            $this->em->flush();

            // Aggiungiamo un messaggio flash di successo
            $this->addFlash('message', 'Insertd Succesfully!');
            // Reindirizziamo alla route principale
            return $this->redirectToRoute('app_main');
        }

        // Ritorniamo la vista 'main/post.html.twig' passando il form come variabile 'form'
        return $this->render('main/post.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // Definizione della route per modificare un post esistente ('/edit-post/{id}')
    #[Route("/edit-post/{id}", name: "edit-post")]
    public function editpost(Request $request, $id)
    {
        // Recuperiamo il post con l'id specificato dal repository
        $post = $this->em->getRepository(Post::class)->find($id);

        // Creiamo un form associato al tipo PostType e al post esistente
        $form = $this->createForm(PostType::class, $post);
        // Gestiamo la richiesta del form
        $form->handleRequest($request);

        // Se il form è stato inviato e i dati sono validi
        if ($form->isSubmitted() && $form->isValid()) {
            // Persistiamo le modifiche del post nel database
            $this->em->persist($post);
            // Salviamo le modifiche nel database
            $this->em->flush();

            // Aggiungiamo un messaggio flash di successo
            $this->addFlash('message', 'Updated Succesfully!');
            // Reindirizziamo alla route principale
            return $this->redirectToRoute('app_main');
        }

        // Ritorniamo la vista 'main/post.html.twig' passando il form come variabile 'form'
        return $this->render('main/post.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // Definizione della route per eliminare un post esistente ('/delete-post/{id}')
    #[Route("/delete-post/{id}", name: "delete-post")]
    public function deletePost($id)
    {
        // Recuperiamo il post con l'id specificato dal repository
        $post = $this->em->getRepository(Post::class)->find($id);

        // Rimuoviamo il post dal database
        $this->em->remove($post);
        // Salviamo le modifiche nel database
        $this->em->flush();

        // Aggiungiamo un messaggio flash di successo
        $this->addFlash('message', 'Deleted Successfully.');

        // Reindirizziamo alla route principale
        return $this->redirectToRoute('app_main');
    }
}
