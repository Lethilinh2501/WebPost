<?php

namespace App\Models;

class BannerModel extends Model
{
    // Lấy danh sách banner
    public function getBanners()
    {
        return $this->queryBuilder->select('*')
            ->from('banners')
            ->fetchAllAssociative();
    }

    // Lấy thông tin banner theo ID
    public function findBanner($id)
    {
        return $this->queryBuilder->select('*')
            ->from('banners')
            ->where('banners.id = :id')
            ->setParameter('id', $id)
            ->fetchAssociative();
    }

    // Thêm mới banner
    public function addBanner($title, $image_url)
    {
        $now = date('Y-m-d H:i:s');

        $stmt = $this->queryBuilder->insert('banners')
            ->values([
                'title' => ':title',
                'image' => ':image',
                'created_at' => ':created_at',
                'updated_at' => ':updated_at'
            ])
            ->setParameters([
                'title' => $title,
                'image' => $image_url,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }

    // Cập nhật banner
    public function updateBanner($id, $title, $image_url)
    {
        $now = date('Y-m-d H:i:s');
        $stmt = $this->queryBuilder->update('banners')
            ->set('title', ':title')
            ->set('updated_at', ':updated_at')
            ->where('banners.id = :id');

        $params = [
            'title' => $title,
            'updated_at' => $now,
            'id' => $id,
        ];

        if ($image_url !== null) {
            $stmt->set('image', ':image');
            $params['image'] = $image_url;
        }

        $stmt->setParameters($params);
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }

    // Xóa banner
    public function deleteBanner($id)
    {
        $stmt = $this->queryBuilder->delete('banners')
            ->where('banners.id = :id')
            ->setParameter('id', $id);
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }
}
