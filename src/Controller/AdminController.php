<?php

namespace App\Controller;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(SkillRepository $skillRepository): Response
    {

        return $this->render('admin/index.html.twig', [
            "skills" => $skillRepository->findAll()
        ]);
    }

    #[Route('/admin/create/skill', name: 'app_create_skill')]
    public function createSkill(Request $request, EntityManagerInterface $manager): Response
    {
        $skill = new Skill();
        $form = $this->createForm(SkillType::class,$skill);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $manager->persist($skill);
            $manager->flush();
            return $this->redirectToRoute('app_admin');
        }
        return $this->render('admin/createSkill.html.twig', [
            "form" => $form->createView()
        ]);
    }

    #[Route('/admin/edit/skill', name: 'app_edit_skill')]
    public function editSkill(): Response
    {
        return $this->redirectToRoute("app_admin");
    }

    #[Route('/admin/delete/skill', name: 'app_delete_skill')]
    public function deleteSkill(Skill $skill, Request $request, EntityManagerInterface $manager): Response
    {
        $manager->remove($skill);
        $manager->flush();

        return $this->redirectToRoute("app_admin");
    }
}
