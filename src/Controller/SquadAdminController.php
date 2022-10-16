<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\League;
use App\Entity\Page;
use App\Entity\Squad;
use App\Entity\Team;
use App\Entity\TransferHistory;
use App\Repository\LeagueRepository;
use App\Repository\PageRepository;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Client\Response;
use Sonata\AdminBundle\Controller\CRUDController;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Tests\App\Model\ModelManager;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class SquadAdminController extends CRUDController{

    protected EntityManagerInterface $entityManager;
    protected PageRepository $pageReposetory;
    protected TeamRepository $teamReposetory;
    protected LeagueRepository $ligaReposetory;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->pageReposetory = $entityManager->getRepository(Page::class);
        $this->teamReposetory = $entityManager->getRepository(Team::class);
        $this->ligaReposetory = $entityManager->getRepository(League::class);
    }

    public function transferAction(Request $request): \Symfony\Component\HttpFoundation\Response
    {

        $leagues =  $this->ligaReposetory->findAll();
        $teams =  $this->teamReposetory->findAll();

        /** @var Squad $object */
        $object = $this->admin->getSubject();
        $transferHistory = new TransferHistory();
        $transferHistory->setSquad($object);
        $transferHistory->setOldTeam($object->getTeam());

        $form = $this->createFormBuilder($transferHistory)
            ->add('newTeam',ChoiceType::class,
                [
                    'choices' => $teams,
                    'choice_label'=>"name",
                    "label" => "Neues Team"
                ])
            ->add('season',ChoiceType::class,
                [
                    'choices' => $leagues,
                    'choice_label'=>"seasonName",
                    "label" => "Season Name"
                ]
            )->add('save', SubmitType::class, [
                'attr' => ['class' => 'btn btn-success'],
            ])
            ->getForm();
        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id: %s', $id));
        }

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $transferHistory = $form->getData();
            $this->entityManager->persist($transferHistory);
            $object->setTeam($transferHistory->getNewTeam());
            $this->entityManager->persist($object);
            $this->entityManager->flush();
            $this->addFlash('sonata_flash_success', 'Transfer von '.$transferHistory->getSquad()->getName().'  nach '.$transferHistory->getNewTeam()->getName().' Erfolgreich');
            return new RedirectResponse($this->admin->generateUrl('list'));
        }
        $this->addFlash('sonata_flash_success', 'transfer successfully');
        return $this->renderForm('transfer.html.twig', [
            'form' => $form,
        ]);

        //return new RedirectResponse($this->admin->generateUrl('list'));
    }
}
