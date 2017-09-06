<?php

namespace User;

interface UserLoader
{
    public function fetchDataById(UserId $userId): array;
}