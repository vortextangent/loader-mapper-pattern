<?php

namespace application;

use mysqli;
use User\UserArrayLoader;
use User\UserLoader;
use User\UserMapper;
use User\UserMysqliLoader;

class Factory
{

    //<editor-fold defaultstate="collapsed" desc="Properties">
    //</editor-fold>

    /**
     * @param array $config
     */
    public function __construct($config = [])
    {
        $this->config = $config;
    }

    /**
     * @return UserMapper
     */
    public function createUserMapper()
    {
        return new UserMapper($this->createUserLoader());
    }

    /**
     * Returns the UserLoader implementation
     *
     * @return UserLoader
     */
    private function createUserMysqliLoader()
    {
        return new UserMysqliLoader($this->createDatabase());
    }

    /**
     * Gets a database connection
     *
     * @return mysqli
     */
    private function createDatabase()
    {
        return new mysqli();
    }

    public function createUserLoader()
    {
        return new UserArrayLoader();
    }

}