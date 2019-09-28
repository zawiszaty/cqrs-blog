<?php

declare(strict_types=1);

namespace App\Symfony\Form;

use App\Blog\Infrastructure\Post\Repository\PostRepositoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class PostType extends AbstractType
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'constraints' => [
                    new NotNull(),
                    new Callback([
                        'callback' => [$this, 'checkTitle'],
                    ]),
                ],
                'required' => true,
            ])
            ->add('content', TextareaType::class, [
                'constraints' => [
                    new NotNull(),
                ],
                'required' => true,
            ])
            ->add('tags', TextType::class, [
                'constraints' => [
                    new NotNull(),
                ],
                'required' => true,
            ]);
    }

    public function checkTitle(string $title, ExecutionContextInterface $context): void
    {
        if ($this->postRepository->findOneBy(['title' => $title])) {
            $context->addViolation('Title Exist.');
        }
    }
}
