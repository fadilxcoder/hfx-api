<?php

namespace App\Repository;

use App\Core\Repository;

class UsersRepository extends Repository
{
    public function getUsers()
    {
        $query = '
            SELECT 
                u.*
            FROM 
                `hfx_users` u
            ORDER BY
                u.id_user ASC
        ';

        return $this->db->findAll($query);
    }

    public function getUser($id)
    {
        $query = '
            SELECT 
                u.*
            FROM 
                `hfx_users` u
            WHERE
                u.id_user = :id
        ';

        return $this->db->findOne($query, [
            'id' => $id,
        ]);
    }

    public function insertUser(array $user)
    {
        $query = '
            INSERT INTO 
                `hfx_users` (
                    uuid,
                    username,
                    name,
                    address,
                    job,
                    card
                )
            VALUES 
                (
                    :uuid,
                    :username,
                    :name,
                    :address,
                    :job,
                    :card
                )
        ';

        $this->db->update($query, [
            'uuid' => $user['uuid'],
            'username' => $user['username'],
            'name' => $user['name'],
            'address' => $user['address'],
            'job' => $user['job'],
            'card' => $user['card'],
        ]);
    }

    public function createTable()
    {
        $query = '
            DROP TABLE IF EXISTS `hfx_users`;
            CREATE TABLE `hfx_users` (
            `id_user` int(11) NOT NULL AUTO_INCREMENT,
            `uuid` varchar(255) NOT NULL,
            `username` varchar(45) DEFAULT NULL,
            `name` varchar(255) DEFAULT NULL,
            `address` varchar(255) DEFAULT NULL,
            `job` varchar(255) DEFAULT NULL,
            `card` varchar(255) DEFAULT NULL,
            PRIMARY KEY (`id_user`)
            ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
        ';

        $this->db->exec($query);
    }

    public function dropTable()
    {
        $query = '
            DROP TABLE IF EXISTS `hfx_users`;
        ';

        $this->db->exec($query);
    }
}