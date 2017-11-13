<?php
namespace BOUTIQUE\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder
        ->add('reference', TextType::class,array(
            'constraints'=>array(
                new Assert\NotBlank(),
                new Assert\Length(array(
                    'min'=> 3,
                    'max'=> 20
                ))
            )
            ->add('categorie', TextType::class, array())
            ->add('titre', TextType::class, array())
            ->add('description', TextareaType::class, array())
            ->add('couleur', TextType::class, array())
            ->add('taille', TextType::class, array())
            ->add('photo', FileType::class, array())
            ->add('prix', TextType::class, array())
            ->add('stock', TextType::class, array())
            ->add('public', ChoiceType::class, array(
                'choices'=>array(
                    'homme'=>'h',
                    'femme'=>'f',
                    'Mixte'=>'mixte',
                )

            )
        ))
    }




}
