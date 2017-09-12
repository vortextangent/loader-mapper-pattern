<?php

namespace User;

class User
{

    //<editor-fold defaultstate="collapsed" desc="Properties">

    /**
     * @var UserId
     */
    private $id;
    /**
     * @var UserName
     */
    private $name;
    //</editor-fold>

    /**
     * @param UserId $id
     * @param UserName $name
     */
    public function __construct(UserId $id, UserName $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }

    /**
     * @param UserId $id
     * @param UserName $name
     *
     * @return User
     */
    public static function fromState(UserId $id, UserName $name): User
    {
        return new User($id, $name);
    }

}