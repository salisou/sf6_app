<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Spiegazione del codice:
 * 
 * Definizione della classe PostType:
 *      La classe PostType estende AbstractType e viene utilizzata 
 *      per definire un form associato all'entità Post.
 * 
 * Metodo buildForm:
 *      Viene utilizzato per costruire il form aggiungendo i campi necessari.
 *      title: Aggiunge un campo di tipo TextType per inserire il titolo del post, con un'etichetta "Enter Title" e un placeholder "title".
 *      content: Aggiunge un campo di tipo TextareaType per inserire il contenuto del post.
 *      save: Aggiunge un pulsante di tipo SubmitType per inviare il form.
 * 
 * Metodo configureOptions:
 *      Configura le opzioni del form, specificando che questo form è associato alla classe Post tramite l'opzione data_class.
 */

class PostType extends AbstractType
{
    /**
     * Costruisce il form con i campi specificati.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Aggiunge un campo di tipo testo per il titolo del post
            ->add(
                'title',
                TextType::class,
                [
                    'label' =>  'Enter Title', // Etichetta del campo
                    'attr' => [
                        'placeholder' => 'title' // Placeholder del campo
                    ]
                ]
            )

            // Aggiunge un campo di tipo textarea per il contenuto del post
            ->add('content', TextareaType::class)

            // Aggiunge un pulsante di submit per salvare il form
            ->add(
                'save',
                SubmitType::class
                // 'attr' => [
                //     'class' => 'btn btn-primary mb-3 mt-2'
                // ]
            );
    }

    /**
     * Configura le opzioni del form, associandolo alla classe Post.
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class, // Associa il form alla classe Post
        ]);
    }
}
