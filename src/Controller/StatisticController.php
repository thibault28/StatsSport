<?php

namespace App\Controller;

use App\Entity\Machines;
use App\Entity\Statistic;
use App\Form\StatisticType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StatisticController extends AbstractController
{
    /**
     * @Route("/statistic/view/{id}", name="statistic_index")
     */
    public function index(Machines $machine)
    {

        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute("homepage");
        }

        $statistics = $this->getDoctrine()->getRepository(Statistic::class)->getStatistic($user->getId(), $machine->getId());




        $arrayWeight = [];
        $arrayTime = [];
        $arrayDate = [];

        foreach ($statistics as $statistic) {

            $arrayDate[] = date_format($statistic->getDate(), 'd/m/Y');
            if ($statistic->getWeight() != null) {

                $arrayWeight[] = $statistic->getWeight();
            }
            if ($statistic->getTime() != null) {

                $arrayTime[] = $statistic->getTime();
            }
        }

        return $this->render('statistic/index.html.twig', [
            'statistics' => $statistics,
            'arrayWeight' => $arrayWeight,
            'arrayTime' => $arrayTime,
            'arrayDate' => $arrayDate,
            'arrayDate' => $arrayDate,
            'machine' => $machine,
        ]);
    }
    /**
     * @Route("/statistic/add", name="statistic_add")
     */
    public function add(Request $request)
    {

        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute("homepage");
        }


        $statistic = new Statistic();

        $form = $this->createForm(StatisticType::class, $statistic);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $statistic->setUser($user);

            $statistic->setDate(new \DateTime());

            $minutes = $form->get("minutes")->getData();
            $seconds = $form->get("seconds")->getData();

            if ($minutes === 0 && $seconds === 0) {
                $statistic->setTime(null);
            } else {
                $seconds = explode(".", $seconds / 60 * 100);

                if ($seconds[0] < 10) {
                    $seconds = sprintf("%02d", $seconds[0]);
                } else {
                    $seconds = $seconds[0];
                }

                $statistic->setTime($minutes . '.' . $seconds);
            }

            if (($minutes === 0 && $seconds === 0 && $statistic->getWeight() === null) 
            || ($minutes !== 0 && $seconds !== 0 && $statistic->getWeight() !== null)
            || ($minutes !== 0 && $seconds === 0 && $statistic->getWeight() !== null)
            || ($minutes === 0 && $seconds !== 0 && $statistic->getWeight() !== null)) {
                $this->addFlash(
                    'danger',
                    'Vous devez choisir soit un poids soit un temps'
                );
            } else {

                $em = $this->getDoctrine()->getManager();
                $em->persist($statistic);
                $em->flush();
                return $this->redirectToRoute("homepage");
            }
        }

        return $this->render('statistic/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
