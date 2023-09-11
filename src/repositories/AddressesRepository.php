<?php

namespace Src\repositories;

use Src\models\Addresses;
use Src\repositories\database\DBContext;

class AddressesRepository
{
    private DBContext $context;

    public function __construct()
    {
        $this->context = new DBContext();
    }

    public function __destruct()
    {
        $this->context->closeConnection();
    }


    /**
     * Get by address_id
     * @param string $addressId
     * @return Addresses|null
     */
    public function findById(string $addressId): ?Addresses
    {
        $res = null;
        try {
            $conn = $this->context->getConnection();

            $sql = 'SELECT * FROM addresses WHERE address_id = ?';
            $stmt = $conn->prepare($sql);

            $stmt->bindValue(1, $addressId, \PDO::PARAM_INT);
            $stmt->execute();

            $res = $stmt->fetch(\PDO::FETCH_ASSOC);

            if($res) {
                $res = new Addresses(
                    $res['address_id'],
                    $res['user_id'],
                    $res['address'],
                );
            }
        } catch (\PDOException $e) {
            echo 'findById failed: ' . $e->getMessage();
        }
        return $res;
    }

    /**
     * Get by all by user_id
     * @param int $userId
     * @return array|false
     */
    public function findAllByUserId(int $userId): array|null
    {
        $res = null;
        try {
            $conn = $this->context->getConnection();

            $sql = 'SELECT * FROM addresses WHERE user_id = ?';
            $stmt = $conn->prepare($sql);

            $stmt->bindValue(1, $userId, \PDO::PARAM_INT);
            $stmt->execute();

            $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            echo 'findAllByUserId failed: ' . $e->getMessage();
        }
        return $res;
    }

    /**
     * Insert new address
     * @param Addresses $obj
     * @return bool
     */
    public function insert(Addresses $obj): bool
    {
        try {
            $conn = $this->context->getConnection();

            //insert to addresses
            $sql = 'INSERT INTO addresses (user_id, address) VALUES (?, ?)';
            $stmt = $conn->prepare($sql);

            $stmt->bindValue(1, $obj->getUserId(), \PDO::PARAM_INT);
            $stmt->bindValue(2, $obj->getAddress());
            $stmt->execute();

            return true;
        } catch (\PDOException $e) {
            echo 'insert failed: ' . $e->getMessage();
        }
        return false;
    }

    /**
     * Delete address by address_id
     * @param int $addressId
     * @return bool
     */
    public function delete(int $addressId): bool
    {
        try {
            $conn = $this->context->getConnection();

            if(!$this->findById($addressId)) {
                return false;
            }

            $sql = 'DELETE FROM addresses WHERE address_id = ? ';

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(1, $addressId, \PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            echo 'delete failed: ' . $e->getMessage();
        }
        return false;
    }


}