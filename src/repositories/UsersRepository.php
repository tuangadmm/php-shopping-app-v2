<?php

namespace Src\repositories;

use Src\models\Roles;
use Src\models\Users;
use Src\repositories\database\DBContext;

class UsersRepository
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
     * Get users list paged
     * @param int $pageIndex
     * @param ?int $pageSize
     * @return array|null
     */
    public function findUsersPaged(int $pageIndex, ?int $pageSize = 10): array|null
    {
        $res = null;
        try {
            $conn = $this->context->getConnection();

            if($pageIndex < 1) {
                $pageIndex = 1;
            }

            $offset = ($pageIndex - 1) * $pageSize;

            $sql = 'SELECT * FROM users LIMIT ? OFFSET ?';
            $stmt = $conn->prepare($sql);

            $stmt->bindValue(1, $pageSize, \PDO::PARAM_INT);
            $stmt->bindValue(2, $offset, \PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            echo 'findAllUsersPaged failed: ' . $e->getMessage();
        }
        return null;

    }

    /**
     * Get by username
     * @param string $username
     * @return Users|null
     */
    public function findByUsername(string $username): ?Users
    {
        $res = null;
        try {
            $conn = $this->context->getConnection();

            $sql = 'SELECT * FROM users, roles WHERE users.role = roles.role_id AND username = ?';
            $stmt = $conn->prepare($sql);

            $stmt->bindValue(1, $username, \PDO::PARAM_STR);
            $stmt->execute();

            $res = $stmt->fetch(\PDO::FETCH_ASSOC);

            if($res) {
                $res = new Users(
                    $res['user_id'],
                    $res['username'],
                    null,
                    $res['full_name'],
                    $res['phone'],
                    new Roles(
                        $res['role_id'],
                        $res['role_name']
                    )
                );
            }
        } catch (\PDOException $e) {
            echo 'findByUsername failed: ' . $e->getMessage();
        }
        return $res;
    }

    /**
     * Get by user_id
     * @param int $userId
     * @return Users|null
     */
    public function findById(int $userId): ?Users
    {
        $res = null;
        try {

            $conn = $this->context->getConnection();

            $sql = 'SELECT * FROM users, roles WHERE users.role = roles.role_id AND user_id = ?';
            $stmt = $conn->prepare($sql);

            $stmt->bindValue(1, $userId, \PDO::PARAM_INT);
            $stmt->execute();

            $res = $stmt->fetch(\PDO::FETCH_ASSOC);

            if($res) {
                $res = new Users(
                    $res['user_id'],
                    $res['username'],
                    null,
                    $res['full_name'],
                    $res['phone'],
                    new Roles(
                        $res['role_id'],
                        $res['role_name']
                    )
                );
            }
        } catch (\PDOException $e) {
            echo 'findById failed: ' . $e->getMessage();
        }
        return $res;
    }

    /**
     * Check if requesting user has permission to perform the operation
     * @param string $username
     * @return bool
     */
    public function hasPermission(string $username): bool
    {
        try {

            $conn = $this->context->getConnection();

            $sql = 'SELECT * FROM users WHERE username = ? AND role = 1';
            $stmt = $conn->prepare($sql);

            $stmt->bindValue(1, $username);
            $stmt->execute();

            $res = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $res != null;
        } catch (\PDOException $e) {
            echo 'hasPermission failed: ' . $e->getMessage();
        }
        return false;
    }

    /**
     * Insert new user
     * @param Users $obj
     * @return bool
     */
    public function insert(Users $obj): bool
    {
        try {
            $conn = $this->context->getConnection();

            //insert to users
            $sql = 'INSERT INTO users (username, password, full_name, phone, role) VALUES (?, ?, ?, ?, ?)';
            $stmt = $conn->prepare($sql);

            $stmt->bindValue(1, $obj->getUsername() );
            $stmt->bindValue(2, $obj->getPassword() );
            $stmt->bindValue(3, $obj->getFullName() );
            $stmt->bindValue(4, $obj->getPhone() );
            $stmt->bindValue(5, $obj->getRole()->getRoleId(), \PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch (\PDOException $e) {
            echo 'insert failed: ' . $e->getMessage();
        }
        return false;
    }

    /**
     * Update user
     * @param Users $obj
     * @return bool
     */
    public function update(Users $obj): bool
    {
        try {
            $conn = $this->context->getConnection();

            if(!$this->findById($obj->getUserId())) {
                return false;
            }

            $sql = 'UPDATE users SET 
                        password = ?, 
                        phone = ?, 
                        full_name = ?, 
                        role = ? 
                        WHERE user_id = ?';

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(1, $obj->getPassword());
            $stmt->bindValue(2, $obj->getPhone());
            $stmt->bindValue(3, $obj->getFullName());
            $stmt->bindValue(4, $obj->getRole()->getRoleId(), \PDO::PARAM_INT);
            $stmt->bindValue(5, $obj->getUserId(), \PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            echo 'update failed: ' . $e->getMessage();
        }
        return false;
    }

    /**
     * Update existing user
     * @param int $userId
     * @return bool
     */
    public function delete(int $userId): bool
    {
        try {
            $conn = $this->context->getConnection();

            if(!$this->findById($userId)) {
                return false;
            }

            $sql = 'DELETE FROM users WHERE user_id = ? ';

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(1, $userId, \PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            echo 'delete failed: ' . $e->getMessage();
        }
        return false;
    }


}