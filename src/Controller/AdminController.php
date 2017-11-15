<?php

namespace App\Controller;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route(path="/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route(
     *     path="/",
     *     name="admin_dashboard"
     * )
     */
    public function dashboardAction()
    {
        // FIXME: Récupérer les utilisateurs non admin
        $repository = $this->getDoctrine()->getRepository(User::class);

        $users = $repository->findBy(array("isAdmin"=>false));

        return $this->render('Admin/dashboard.html.twig', ['users' => $users]);
    }

    /**
     * @Route(
     *     path="/delete/{id}",
     *     name="delete"
     * )
     */
    public function deleteUserAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($user);

        $em->flush();
        return $this->redirectToRoute("admin_dashboard");
    }
}
