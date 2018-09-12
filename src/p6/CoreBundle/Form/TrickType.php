<?php

namespace p6\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickType extends AbstractType
{

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('name', TextType::class)
      ->add('description', TextareaType::class)

      ->add('category', EntityType::class, array(
        'class' => 'p6CoreBundle:Category',
        'choice_label' => 'name',
        ))

      ->add('videos', CollectionType::class, array(
        'entry_type' => VideoType::class,
        'allow_add' => true,
        'allow_delete' => true,
        'by_reference' => false,
        'required' => false,
        ))

      ->add('images', CollectionType::class, array(
        'entry_type' => ImageType::class,
        'allow_add' => true,
        'allow_delete' => true,
        'by_reference' => false,
        'required' => false,
      ))

      ->add('enregistrer', SubmitType::class)
      ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'p6\CoreBundle\Entity\Trick'
    ));
  }
}
