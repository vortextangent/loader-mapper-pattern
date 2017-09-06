<?php

namespace User;

use Library\Exceptions\ApplicationException;
use Library\Exceptions\DuplicateEntityException;
use Library\Exceptions\ForeignKeyConstraintViolationException;
use mysqli;
use mysqli_result;
use mysqli_stmt;

class UserMysqliLoader implements UserLoader
{

    //<editor-fold defaultstate="collapsed" desc="Potential MysqliAdapter Abstract Class stuff">

    /** @var mysqli */
    private $mysqli;

    /**
     * @param mysqli $mysqli
     */
    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    /**
     * @param $sql
     *
     * @return mysqli_result
     * @throws ApplicationException
     */
    public function query($sql)
    {
        d($sql, 5);

        $result = $this->mysqli->query($sql, MYSQLI_USE_RESULT);
        if ($result === false) {
            throw new ApplicationException("Unable to query Database: {$this->mysqli->error}.");
        }

        return $result;
    }

    /**
     * @param $sql
     *
     * @return mysqli_stmt
     * @throws ApplicationException
     */
    protected function prepareStatement($sql)
    {
        //Log Sql here
        //d($sql, 5);
        $mysqliStmt = $this->mysqli->prepare($sql);
        if ( ! $mysqliStmt instanceof mysqli_stmt) {
            throw new ApplicationException("Error on preparing statement: {$this->mysqli->error}");
        }

        return $mysqliStmt;
    }

    /**
     * @param mysqli_stmt $statement
     * @param UserId $id
     *
     * @throws ApplicationException
     */
    protected function bindParamsToFetchByIdStatement(mysqli_stmt $statement, UserId $id): void
    {
        if ($statement->bind_param('i', $id->asInt()) === false) {
            throw new ApplicationException("Unable to bind Parameters to Query: {$this->mysqli->error}");
        }
    }

    /**
     * @param mysqli_stmt $statement
     *
     * @return bool
     * @throws ApplicationException
     * @throws DuplicateEntityException
     * @throws ForeignKeyConstraintViolationException
     */
    public function executeStatement(mysqli_stmt $statement): bool
    {
        $result = $statement->execute();
        if ($result === false) {
            $errno = $this->mysqli->errno;
            $error = $this->mysqli->error;

            switch ($errno) {
                case 1062:
                    throw new DuplicateEntityException();
                    break;
                case 1452:
                    throw new ForeignKeyConstraintViolationException($error);
                    break;
                default:
                    throw new ApplicationException("Unable to execute Statement: ({$errno}) {$error}");
            }
        };

        return $result;
    }

    /**
     * @param mysqli_stmt $statement
     *
     * @return array
     * @throws ApplicationException
     */
    public function fetchResults(mysqli_stmt $statement): array
    {
        /**
         * @var array $rows
         */
        $result = $statement->get_result();
        if ($result === false) {
            $errno = $this->mysqli->errno;
            $error = $this->mysqli->error;

            throw new ApplicationException("Unable to get result set: ({$errno}) {$error}");
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    //</editor-fold>

    /**
     * @param UserId $userId
     *
     * @return array
     */
    public function fetchDataById(UserId $userId): array
    {
        $statement = $this->prepareStatement("SELECT  * 
            FROM users
            WHERE id = ?");

        $this->bindParamsToFetchByIdStatement($statement, $userId);

        $this->executeStatement($statement);

        return $this->fetchResults($statement);
    }

}