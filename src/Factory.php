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
    public function createUserMapper(): UserMapper
    {
        return new UserMapper($this->createUserLoader());
    }

    /**
     * Returns the UserLoader implementation
     *
     * @return UserLoader
     */
    private function createUserLoader(): UserLoader
    {
        if (isset($this->config['useDb'])) {
            return new UserMysqliLoader($this->createDatabase());
        }

        return new UserArrayLoader();

    }

    /**
     * Gets a database connection
     *
     * @return mysqli
     */
    private function createDatabase(): mysqli
    {
        return new mysqli();
    }

}