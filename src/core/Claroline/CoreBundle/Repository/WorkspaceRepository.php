<?php

namespace Claroline\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Claroline\CoreBundle\Entity\User;

class WorkspaceRepository extends EntityRepository
{
    public function getWorkspacesOfUser(User $user)
    {
        $dql = "
            SELECT w FROM Claroline\CoreBundle\Entity\Workspace\AbstractWorkspace w
            JOIN w.roles wr
            JOIN wr.users u
            WHERE u.id = '{$user->getId()}'
            AND w.type != 0
        ";
        $query = $this->_em->createQuery($dql);

        return $query->getResult();
    }

    public function getNonPersonnalWS()
    {
        $dql = "
            SELECT w FROM Claroline\CoreBundle\Entity\Workspace\AbstractWorkspace w
            WHERE w.type != 0
        ";

        $query = $this->_em->createQuery($dql);

        return $query->getResult();
    }

    public function getAllWsOfUser(User $user)
    {
        $dql = "
            SELECT w FROM Claroline\CoreBundle\Entity\Workspace\AbstractWorkspace w
            JOIN w.roles wr JOIN wr.users u WHERE u.id = '{$user->getId()}'
            ";

        $query = $this->_em->createQuery($dql);

        return $query->getResult();
    }
}