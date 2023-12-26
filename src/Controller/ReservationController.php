<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\Reservationform;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/listReservation', name: 'app_reservation')]
    public function listReservation(ReservationRepository $rv): Response
    {
        $reservations = $rv->findAll();
        return $this->render('listReservation.html.twig', [
            'listReservation' => $reservations,
        ]);
    }

    #[Route('/addReservation', name: 'addReservation')]
    public function addReservation(Request $request, EntityManagerInterface $em)
    {
        $reservation = new Reservation();
        $form = $this->createForm(Reservationform::class, $reservation);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em->persist($reservation);
            $em->flush();
            return $this->redirectToRoute("app_reservation");
        }
        return $this->render("addReservation.html.twig", ["formV" => $form->createView()]);
    }

    #[Route('/Deletereservation/{id}', name: 'reservationDelete')]
    public function delete(EntityManagerInterface $em, ReservationRepository $rv, $id): Response
    {
        $reservation = $rv->find($id);
        $em->remove($reservation);
        $em->flush();
        return $this->redirectToRoute('app_reservation');
    }

    #[Route('/updateReservation/{id}', name: 'reservationUpdate')]
    public function updateReservation(Request $request, EntityManagerInterface $em, ReservationRepository $rv, $id): Response
    {
        $reservation = $rv->find($id);
        $editform = $this->createForm(Reservationform::class, $reservation);
        $editform->handleRequest($request);
        if ($editform->isSubmitted() and $editform->isValid()) {
            $em->persist($reservation);
            $em->flush();

            return $this->redirectToRoute('app_reservation');
        }
        return $this->render('update.html.twig', ['editformReservation' => $editform->createView()]);

    }
    #[Route('/searchReservation', name: 'ReservationSearch')]
    public function searchReservation(Request $request, EntityManagerInterface $em): Response
    {
        $reservations = null ;
        if ($request->isMethod('POST')) {
            $query =$em->createQuery(
                "select r from App\Entity\Reservation r  "
            );
            $reservations =$query ->getResult();

        }
        return $this->render('recherche.html.twig', ["reservations"=>$reservations]);

    }
    #[Route('/confirmationReservation', name: 'Reservationconfirme')]
    public function confirmationReservation(Request $request, EntityManagerInterface $em): Response
    {
        $reservations = null ;
        if ($request->isMethod('POST')) {
            $query =$em->createQuery(
                "select r from App\Entity\Reservation r  "
            );
            $reservations =$query ->getResult();

        }
        return $this->render('confirmation.html.twig', ["reservations"=>$reservations]);

    }

}