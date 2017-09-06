<?php

namespace RiskalyzeDomainObjects\Library\DataAccess\Adapters;

use Library\Exceptions\ApplicationException;
use Library\Exceptions\DuplicateEntityException;
use Library\Exceptions\ForeignKeyConstraintViolationException;
use mysqli_result;
use mysqli_stmt;
use RuntimeException;

/**
 * Class Adapter
 * Describes required Adapter functions.
 * Whenever you change data sources you'll need a new <Technology>Adapter to support that technology.
 *
 * @package RiskalyzeDomainObjects\Library\DataAccess\Adapters
 */
interface Adapter
{

    /**
     * @param $sql
     *
     * @throws RuntimeException
     */
    public function query($sql);

}