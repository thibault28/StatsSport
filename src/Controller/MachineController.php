<?php

namespace App\Controller;

use App\Entity\Machines;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MachineController extends AbstractController
{
    /**
     * @Route("/machine", name="machine_index")
     */
    public function index()
    {
        $machines = $this->getDoctrine()->getRepository(Machines::class)->findAllOrderByMachineCategory();

        return $this->render('machine/index.html.twig', [
            'machines' => $machines,
        ]);
    }
}
