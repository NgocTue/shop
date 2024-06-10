<?php
    namespace Lenovo\Shop\Models;

    use Lenovo\Shop\Commons\Model;

    class Cart extends Model{
        // protected string $tableName = 'carts';

        // public function findByUserID($userID){
        //     return $this->queryBuilder
        //     ->select('*')
        //     ->from($this->tableName)
        //     ->where('user_id = ?')
        //     ->setParameter(0, $userID)
        //     ->fetchAssociative();
        // }

        protected string $tableName = 'carts';

        public function findByUserID($userID) {
            return $this->queryBuilder
                ->select('*')
                ->from($this->tableName)
                ->where('user_id = ?')
                ->setParameter(0, $userID)
                ->fetchAssociative();
        }

    }