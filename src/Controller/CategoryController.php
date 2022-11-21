<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/{categoryName}', name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findOneByName($categoryName);

        if (!$category) {
            throw $this->createNotFoundException(
                'No program with id : ' . $categoryName . ' found in program\'s table.'
            );
        }
        return $this->render('category/show.html.twig', [
            'category' => $category
        ]);
    }
}
