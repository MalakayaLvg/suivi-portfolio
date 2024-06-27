<?php

namespace App\Controller;

use App\Entity\Skill;
use App\Entity\SkillCategory;
use App\Form\SkillCategoryType;
use App\Form\SkillType;
use App\Repository\SkillCategoryRepository;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(SkillRepository $skillRepository,SkillCategoryRepository $skillCategoryRepository): Response
    {

        return $this->render('admin/index.html.twig', [
            "skills" => $skillRepository->findAll(),
            "skillCategories" => $skillCategoryRepository->findAll()
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


    #[Route('/admin/edit/skill/{id}', name: 'app_edit_skill')]
    public function editSkill(Skill $skill,Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($skill);
            $manager->flush();

            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/editSkill.html.twig',[
            "skill" => $skill,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/delete/skill/{id}', name: 'app_delete_skill')]
    public function deleteSkill(Skill $skill, Request $request, EntityManagerInterface $manager): Response
    {
        $manager->remove($skill);
        $manager->flush();

        return $this->redirectToRoute("app_admin");
    }

    #[Route('/admin/create/skillCategory', name: 'app_create_skill_category')]
    public function createSkillCategory(Request $request, EntityManagerInterface $manager): Response
    {
        $skillCategory = new SkillCategory();
        $form = $this->createForm(SkillCategoryType::class,$skillCategory);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $manager->persist($skillCategory);
            $manager->flush();
            return $this->redirectToRoute('app_admin');
        }
        return $this->render('admin/createSkillCategory.html.twig', [
            "form" => $form->createView()
        ]);
    }

    #[Route('/admin/delete/skillCategory/{id}', name: 'app_delete_skill_category')]
    public function deleteSkillCategory(SkillCategory $skillCategory, Request $request, EntityManagerInterface $manager): Response
    {
        $manager->remove($skillCategory);
        $manager->flush();

        return $this->redirectToRoute("app_admin");
    }

    #[Route('/admin/edit/skillCategory/{id}', name: 'app_edit_skill_category')]
    public function editSkillCategory(SkillCategory $skillCategory, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(SkillCategoryType::class, $skillCategory);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($skillCategory);
            $manager->flush();

            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/editSkillCategory.html.twig',[
            "category" => $skillCategory,
            'form' => $form->createView(),
        ]);
    }
}
