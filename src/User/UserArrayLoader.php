<?php

namespace User;

class UserArrayLoader implements UserLoader
{

    //<editor-fold defaultstate="collapsed" desc="Properties">

    /**
     * @var array
     */
    private $users = [
        [
            'id'   => 'bce1ee52-cd2e-4eb7-a453-87fce154f899',
            'name' => 'Tony',
        ],
        [
            'id'   => '7c1f1bfd-21ee-4bc6-bc18-2fd3391fba77',
            'name' => 'Ben',
        ],
        [
            'id'   => '24fd088d-29a8-4b10-8745-c907e1ba194f',
            'name' => 'Matt',
        ],
    ];

    /**
     * @var UserId
     */
    private $userToFind;

    //</editor-fold>

    /**
     * @param UserId $userId
     *
     * @return User[]
     */
    public function fetchDataById(UserId $userId): array
    {
        $this->userToFind = $userId;
        $user = array_filter($this->users, [$this,'findUser']);
        unset($this->userToFind);
        return $user;
    }

    /**
     * @param $user
     *
     * @return bool
     */
    private function findUser($user)
    {
        return $user['id'] === $this->userToFind->asString();
    }
}