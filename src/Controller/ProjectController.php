<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @Route("/project", name="project")
     */
    public function index()
    {
        return $this->render('project/index.html.twig', [
            'controller_name' => 'ProjectController',
        ]);
    }

    /**
     * @route("/project/add", name="project_add")
     */
    public function add(Request $request) {
        // 1 - Création de l'objet à persister(mettre dans la mémoire,sauvegarder) dans la db
        $project = new Project();

        // 2 - Création de l'objet form qui va générer le html dans la vue et prendre en charge la validation du formulaire et l'hydratation de l'objet $project avec les datas saisies dans le form


        // Création de l'objet $form
        $form = $this->createForm(ProjectType::class, $project);

        // Hydratation de l'objet avec les datas du form
        $form->handleRequest($request);

            // Si validation du form et form valide (toutes les données sont saisies correctement > champs obligatoires etc...)
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupére l'entity manager de Doctrine (O.R.M)
            $em = $this->getDoctrine()->getManager();
            // Association du user loggé et du projet qu'il est en train de créer
            $project->setProposePar($this->getUser());
            // Enregistrement dans la db des datas du form(équivalent de ->save() dans laravel)
            $em->persist($project);
            $em->flush();
            // Ajouter un message flash dans la session
            $this->addFlash('success','Merci ! Votre projet au Maître Jedi a été proposé');
            // Return redirection vers la page de confirmation de création du projet
            return $this->redirect('home');
        }

        // Affichage de la vue
        return $this->render('project/add.html.twig',['form'=>$form->createView()]);
    }
}
