<?php

namespace Cnes\PhileaBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ProjetRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjetRepository extends EntityRepository
{

    public function getAllUsers($idProjet) {

        $em = $this->getEntityManager();
        $query = $em->createQuery(
            "SELECT u FROM PhileaBundle:User u "
            .  " JOIN u.projets p"
            .  " WHERE p.id = :idp");
        $query->setParameter("idp", $idProjet);

        return $query->getResult();

    }

    public function getAllGestionnaires($idProjet) {

        $em = $this->getEntityManager();
        $query = $em->createQuery(
            "SELECT u FROM PhileaBundle:User u "
            .  " JOIN u.projets p"
            .  " WHERE p.id = :idp"
            .  " AND u.roles LIKE '%ROLE_GESTIONNAIRE%' "
        );
        $query->setParameter("idp", $idProjet);

        return $query->getResult();

    }
    
    public function getAllProjets() {

        $em = $this->getEntityManager();
        $query = $em->createQuery(
            "SELECT proj, dom, eta, cla FROM PhileaBundle:Projet proj "
            .  " LEFT JOIN proj.domaine dom"
            .  " LEFT JOIN proj.etablissement eta"
            .  " LEFT JOIN proj.classe cla"
        );

        return $query->getResult();

    }
    
}
