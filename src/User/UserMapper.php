<?php

namespace User;

class UserMapper
{

    //<editor-fold defaultstate="collapsed" desc="Properties">

    /**
     * @var UserLoader
     */
    private $loader;
    //</editor-fold>

    /**
     * @param UserLoader $loader
     */
    public function __construct(UserLoader $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @param UserId $id
     *
     * @return User
     */
    public function user(UserId $id): User
    {
        $data = $this->loader->fetchDataById($id);
        $user = $this->map($data);

        return $user;
    }

    /**
     * @param array $data
     *
     * @return User
     */
    private function map(array $data): User
    {
        $user = User::fromState(
            UserId::fromString($data['id']),
            new UserName($data['name'])
        );

        return $user;
    }
}