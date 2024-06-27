<?php

namespace App\Controller;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Repository\SkillCategoryRepository;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(SkillRepository $skillRepository, SkillCategoryRepository $skillCategoryRepository): Response
    {
        return $this->render('home/index.html.twig', [
            "skills" => $skillRepository->findAll(),
            "skillCategories" => $skillCategoryRepository->findAll()
        ]);
    }


}
