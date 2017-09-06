<?php

namespace RiskalyzeDomainObjects\Library\DataAccess\Adapters;

use Library\Exceptions\ApplicationException;
use Library\Exceptions\DuplicateEntityException;
use Library\Exceptions\ForeignKeyConstraintViolationException;
use mysqli;
use mysqli_result;
use mysqli_stmt;
use RuntimeException;

/**
 * Class MysqliAdapter
 * Wraps mysqli class.
 *
 * @package RiskalyzeDomainObjects\Library\DataAccess\Adapters
 */
abstract class MysqliAdapter implements Adapter
{




}