<?php

namespace App\Models;

class PostModel extends Model
{
    // Lấy danh sách bài viết kèm tên danh mục
    public function getPosts()
    {
        return $this->queryBuilder->select('p.*', 'c.name as categoryName')
            ->from('posts', 'p')
            ->join('p', 'categories', 'c', 'p.category_id = c.id')
            ->fetchAllAssociative();
    }

    // Lấy danh sách danh mục
    public function getCategories()
    {
        return $this->queryBuilder->select('*')
            ->from('categories')
            ->fetchAllAssociative();
    }

    // Thêm bài viết mới
    public function addPost($user_id, $title, $content, $category_id, $image_url = null)
    {
        $now = date('Y-m-d H:i:s');

        $stmt = $this->queryBuilder->insert('posts')
            ->values([
                'user_id' => ':user_id',
                'category_id' => ':category_id',
                'title' => ':title',
                'img_thumbnail' => ':img_thumbnail',
                'content' => ':content',
                'created_at' => ':created_at',
                'updated_at' => ':updated_at'
            ])
            ->setParameters([
                'user_id' => $user_id,
                'category_id' => $category_id,
                'title' => $title,
                'img_thumbnail' => $image_url,
                'content' => $content,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }

    // Xóa bài viết
    public function deletePost($id)
    {
        $stmt = $this->queryBuilder->delete('posts')
            ->where('posts.id = :id')
            ->setParameter('id', $id);
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }

    // Lấy thông tin bài viết theo ID
    public function findPost($id)
    {
        return $this->queryBuilder->select('*')
            ->from('posts')
            ->where('posts.id = :id')
            ->setParameter('id', $id)
            ->fetchAssociative();
    }

    // Cập nhật bài viết
    public function updatePost($id, $category_id, $title, $content, $image_url = null)
    {
        $now = date('Y-m-d H:i:s');
        $stmt = $this->queryBuilder->update('posts')
            ->set('category_id', ':category_id')
            ->set('title', ':title')
            ->set('content', ':content')
            ->set('updated_at', ':updated_at')
            ->where('posts.id = :id'); // Sửa lỗi ID không rõ ràng

        $params = [
            'category_id' => $category_id,
            'title' => $title,
            'content' => $content,
            'updated_at' => $now,
            'id' => $id,
        ];

        if ($image_url !== null) {
            $stmt->set('img_thumbnail', ':img_thumbnail');
            $params['img_thumbnail'] = $image_url;
        }

        $stmt->setParameters($params);
        $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    }

    // Tìm kiếm bài viết theo tiêu đề
    public function searchPosts($keyword)
    {
        return $this->queryBuilder->select('*')
            ->from('posts', 'p') // Đặt alias cho bảng
            ->where('p.title LIKE :keyword') // Tránh lỗi mơ hồ
            ->setParameter('keyword', "%$keyword%")
            ->fetchAllAssociative();
    }
}
