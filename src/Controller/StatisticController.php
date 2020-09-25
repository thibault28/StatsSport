<?php

namespace App\Controller;

use App\Entity\Machines;
use App\Entity\Statistic;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StatisticController extends AbstractController
{
    /**
     * @Route("/statistic/{machine}", name="statistic_index")
     */
    public function index($machine)
    {

        $user = $this->getUser();

        if($user === null){
            return $this->redirectToRoute("homepage");
        }

        $statistics = $this->getDoctrine()->getRepository(Statistic::class)->getStatistic($user->getId(),$machine);
        $machine = $this->getDoctrine()->getRepository(Machines::class)->find($machine);




        $arrayWeight = [];
        $arrayTime = [];
        $arrayDate = [];

        foreach($statistics as $statistic){
            
            $arrayDate[] = date_format($statistic->getDate(),'d/m/Y');
            $arrayWeight[] = $statistic->getWeight();
            
            if($statistic->getTime() != null){

                $arrayTime[] = date_format($statistic->getTime(),'i:s');
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
}
