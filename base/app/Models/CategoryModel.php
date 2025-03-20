<?php

namespace App\Models;

// use App\Common\Database;

class CategoryModel extends Model
{

    public function getCategories()
    {
        $stmt = $this->queryBuilder->select('*')
            ->from('categories');

        return $stmt->fetchAllAssociative();
    }

    public function addCategories()
    {
        $stmt = $this->queryBuilder->insert('categories')
            ->values(['name' => ':name'])
            ->setParameters(['name' => $_POST['name']]);
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }

    public function deleteCategories($id)
    {
        // Xóa tất cả sản phẩm thuộc danh mục trước
        $stmt1 = $this->queryBuilder->delete('posts')
            ->where('category_id = :id')
            ->setParameters(['id' => $id]);
        $this->connection->executeStatement($stmt1->getSQL(), $stmt1->getParameters());

        // Sau đó mới xóa danh mục
        $stmt2 = $this->queryBuilder->delete('categories')
            ->where('id = :id')
            ->setParameters(['id' => $id]);
        $this->connection->executeStatement($stmt2->getSQL(), $stmt2->getParameters());
    }

    public function findCategories($id)
    {
        // var_dump($_POST); // Kiểm tra dữ liệu từ form
        // die();
        $stmt = $this->queryBuilder->select('*')
            ->from('categories')
            ->where('id = :id')
            ->setParameters(['id' => $id]);
        return $stmt->fetchAssociative();
    }

    public function updateCategories($id)
    {
        $stmt = $this->queryBuilder->update('categories')
            ->set('name', ":name")
            ->where('id = :id')
            ->setParameters([
                'name' => $_POST['name'],
                'id' => $id,
            ]);
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }

    public function searchCategories($keyword)
    {
        return $this->queryBuilder
            ->select('*')
            ->from('categories')
            ->where('name LIKE :keyword')
            ->setParameter('keyword', "%$keyword%")
            ->executeQuery()
            ->fetchAllAssociative();
    }
}
