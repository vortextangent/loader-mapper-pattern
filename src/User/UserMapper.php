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
     * @return array
     */
    public function user(UserId $id)
    {
        $data = $this->loader->fetchDataById($id);

        return $this->map($data);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    private function map(array $data)
    {
        $usersArray = [];
        foreach ($data as $dataRow) {
            $usersArray[] = User::fromState(
                UserId::fromString($dataRow['id']),
                new UserName($dataRow['name'])
            );
        }

        return $usersArray;
    }
}