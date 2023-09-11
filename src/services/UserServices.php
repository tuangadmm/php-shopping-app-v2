<?php

namespace Src\services;

use Src\models\DTO\UserCreateDTO;
use Src\models\response\UserDetailDTO;
use Src\models\Roles;
use Src\models\Users;
use Src\repositories\AddressesRepository;
use Src\repositories\database\DBContext;
use Src\repositories\UsersRepository;
use Src\utils\PasswordHash;
use Src\utils\Validator;

class UserServices
{
    private UsersRepository $usersRepo;
    private AddressesRepository $addressRepo;

    public function __construct(
        UsersRepository $usersRepo,
        AddressesRepository $addressRepo
    )
    {
        $this->usersRepo = $usersRepo;
        $this->addressRepo = $addressRepo;
    }

    /**
     * Create new user
     * @param UserCreateDTO $obj
     * @return array|null
     */
    public function register(UserCreateDTO $obj): array
    {
        $isOk = 1;
        $res = [];

        //validate full name
        if(!Validator::isNameValid($obj->getFullName())){
            $isOk = 0;
            $res[] = ['nameError' => 'Invalid name format'];
        }

        //validate phone
        if(!Validator::isPhoneValid($obj->getPhone())){
            $isOk = 0;
            $res[] = ['phoneError' => 'Invalid phone format'];
        }

        //validate password
        if(!Validator::isPasswordsMatch($obj->getPassword(), $obj->getConfirmPassword())){
            $isOk = 0;
            $res[] = ['passwordError' => 'Passwords do not matched'];
        }

        //validate username
        if(!Validator::isUsernameValid($obj->getUsername())){
            $isOk = 0;
            $res[] = ['usernameError' => 'Invalid username format'];
        }

        //validate username existence
        if($this->usersRepo->findByUsername($obj->getUsername()) != null){
            $isOk = 0;
            $res[] = ['usernameError' => 'Username is already taken'];
        }

        if ($isOk == 1){
            $u = new Users(
                null,
                $obj->getUsername(),
                PasswordHash::hashPassword($obj->getPassword()),
                $obj->getFullName(),
                $obj->getPhone(),
                new Roles(2, null)
            );

            $this->usersRepo->insert($u);
            $res[] = ['success' => 'Register successful'];
        }
        return $res;
    }

    /**
     * Validate login
     * @param $username
     * @param $password
     * @return string[]
     */
    public function login($username, $password): array
    {
        $res = [];
        $user = $this->usersRepo->findByUsername($username);
        if($user == null){
            $res = ['usernameError' => 'Username not found'];
        }else{
            if(!PasswordHash::verifyPassword($password, $user->getPassword())){
                $res = ['passwordError' => 'Password is incorrect'];
            }else{
                $res = ['success' => 'Login successful'];
            }
        }
        return $res;
    }

    /**
     * Update current user
     * @param Users $obj
     * @return array|string[]
     */
    public function update(Users $obj): array
    {
        $isOk = 1;
        $res = [];
        //get current user details by username
        $user = $this->usersRepo->findByUsername($obj->getUsername());
        if($user == null){
            $isOk = 0;
            $res = ['userError' => 'User not found'];
        }

        //validate new information
        if(!Validator::isPhoneValid($obj->getPhone())){
            $isOk = 0;
            $res = ['phoneError' => 'Invalid phone format'];
        }
        if(!Validator::isNameValid($obj->getFullName())){
            $isOk = 0;
            $res = ['nameError' => 'Invalid name format'];
        }

        if($isOk == 1){
            $u = new Users(
              $user->getUserId(),
              $user->getUsername(),
              $obj->getPassword(),
              $obj->getFullName(),
              $obj->getPhone(),
              new Roles(2, null)
            );
            $this->usersRepo->update($u);
            $res = ['success' => 'Update successful'];
        }
        return $res;
    }

    /**
     * Delete user and related information
     * @param int $userId
     * @return bool
     */
    public function delete(int $userId): bool
    {
        return $this->usersRepo->delete($userId);
    }

    /**
     * Get user details
     * @param string $username
     * @return UserDetailDTO|null
     */
    public function getUserDetails(string $username): ?UserDetailDTO
    {
        $user = $this->usersRepo->findByUsername($username);
        if($user == null) return null;

        $addr = $this->addressRepo->findAllByUserId($user->getUserId());

        return new UserDetailDTO(
            $user->getUserId(),
            $user->getUsername(),
            $user->getFullName(),
            $user->getPhone(),
            $user->getRole()->getRoleId() == 1 ? 'Seller' : 'Customer',
            $addr
        );
    }

//    public function getCartDetails(int $userId):
}