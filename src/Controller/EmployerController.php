<?php

namespace App\Controller;

use App\Entity\Employer;
use App\Form\EmployerType;
use App\Repository\EmployerRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class EmployerController extends AbstractController
{
    #[Route('/employer', name: 'app_employer_index', methods: ['GET'])]
    public function index(EmployerRepository $employerRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $employers = $paginator->paginate(
            $employerRepository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            2 /*limit per page*/
        );
        return $this->render('employer/index.html.twig', [
            'employers' => $employers,
        ]);
    }

    #[Route('/employer/new', name: 'app_employer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EmployerRepository $employerRepository): Response
    {
        $employer = new Employer();
        $form = $this->createForm(EmployerType::class, $employer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employerRepository->add($employer, true);

            return $this->redirectToRoute('app_employer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('employer/new.html.twig', [
            'employer' => $employer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_employer_show', methods: ['GET'])]
    public function show(Employer $employer): Response
    {
        return $this->render('employer/show.html.twig', [
            'employer' => $employer,
        ]);
    }

    #[Route('/employer/{id}/edit', name: 'app_employer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Employer $employer, EmployerRepository $employerRepository): Response
    {
        $form = $this->createForm(EmployerType::class, $employer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employerRepository->add($employer, true);

            return $this->redirectToRoute('app_employer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('employer/edit.html.twig', [
            'employer' => $employer,
            'form' => $form,
        ]);
    }

    #[Route('/employer/{id}', name: 'app_employer_delete', methods: ['POST'])]
    public function delete(Request $request, Employer $employer, EmployerRepository $employerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employer->getId(), $request->request->get('_token'))) {
            $employerRepository->remove($employer, true);
        }

        return $this->redirectToRoute('app_employer_index', [], Response::HTTP_SEE_OTHER);
    }
}
