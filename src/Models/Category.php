<?php
    namespace Lenovo\Shop\Models;

    use Lenovo\Shop\Commons\Model;

    class Category extends Model
    {
        protected string $tableName = 'categories';

        // public function all() {
        //     return $this->queryBuilder
        //     ->select(
        //         'p.id', 'p.category_id', 'p.name', 'p.img_thumbnail', 'p.created_at', 'p.updated_at',
        //         'c.name as c_name'
        //     )
        //     ->from($this->tableName, 'p')
        //     ->innerJoin('p', 'categories', 'c', 'c.id = p.category_id')
        //     ->orderBy('p.id', 'desc')
        //     ->fetchAllAssociative();
        // }

        public function all() {
            return $this->queryBuilder
                ->select('id', 'name')
                ->from('categories')
                ->orderBy('id', 'desc')
                ->fetchAllAssociative();
        }

        // public function all() {
        //     return $this->queryBuilder
        //         ->select(
        //             'p.id', 
        //             'p.category_id', 
        //             'p.name', 
        //             'p.img_thumbnail', 
        //             'p.created_at', 
        //             'p.updated_at', 
        //             'c.name as c_name'
        //         )
        //         ->from('products', 'p')
        //         ->innerJoin('p', 'categories', 'c', 'c.id = p.category_id')
        //         ->orderBy('p.id', 'desc')
        //         ->fetchAllAssociative();
        // }
    }