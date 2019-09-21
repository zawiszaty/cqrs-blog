<?php

declare(strict_types=1);

namespace App\Symfony\Form;

use App\Blog\Infrastructure\Category\Repository\CategoryRepositoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class CategoryType extends AbstractType
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotNull(),
                    new Callback([
                        'callback' => [$this, 'checkName'],
                    ]),
                ],
                'required' => true,
            ]);
    }

    public function checkName(string $name, ExecutionContextInterface $context): void
    {
        if ($this->categoryRepository->findOneBy(['name' => $name])) {
            $context->addViolation('Name Exist.');
        }
    }
}
