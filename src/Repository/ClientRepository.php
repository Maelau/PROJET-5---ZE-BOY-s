<?php
// src/Repository/ClientRepository.php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    /**
     * Exemple d'une méthode personnalisée pour rechercher par nom.
     *
     * @param string $name Le nom du client à rechercher.
     * @return Client[] Retourne un tableau de clients.
     */
    public function findByName(string $name)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.name = :name')  // Assurez-vous que 'name' est le bon champ dans l'entité
            ->setParameter('name', $name)
            ->getQuery()
            ->getResult();
    }

    // Optionnel : méthode pour récupérer tous les clients
    public function findAllClients()
    {
        return $this->findAll();
    }
}
