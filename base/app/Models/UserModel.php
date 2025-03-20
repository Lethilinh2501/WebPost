<?php

namespace App\Models;

class UserModel extends Model
{
    public function getUsers()
    {
        $stmt = $this->queryBuilder->select('*')
            ->from('users');

        return $stmt->fetchAllAssociative();
    }

    public function deleteUsers($id)
    {
        $stmt = $this->queryBuilder->delete('users')
            ->where('id = :id')
            ->setParameters(['id' => $id]);
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }

    public function searchUsers($keyword)
    {
        return $this->queryBuilder
            ->select('*')
            ->from('users')
            ->where('name LIKE :keyword')
            ->setParameter('keyword', "%$keyword%")
            ->executeQuery()
            ->fetchAllAssociative();
    }
}
