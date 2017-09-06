<?php

namespace User;

interface UserLoader
{

    /**
     * @param UserId $userId
     *
     * @return User[]
     */
    public function fetchDataById(UserId $userId): array;
}