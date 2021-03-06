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
    private function query($sql): mysqli_result
    {
        //d($sql, 5);

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
    private function prepareStatement($sql): mysqli_stmt
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
    private function bindParamsToFetchByIdStatement(mysqli_stmt $statement, UserId $id): void
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
    private function executeStatement(mysqli_stmt $statement): bool
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

        return $this->fetchRow($statement);
    }

    /**
     * @param mysqli_stmt $statement
     *
     * @return array
     * @throws ApplicationException
     */
    private function fetchAll(mysqli_stmt $statement): array
    {
        $result = $this->checkResult($statement);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    private function fetchRow(mysqli_stmt $statement): array
    {
        $result = $this->checkResult($statement);

        return $result->fetch_assoc();

    }

    /**
     * @param mysqli_stmt $statement
     *
     * @return mysqli_result
     * @throws ApplicationException
     */
    private function checkResult(mysqli_stmt $statement): mysqli_result
    {
        $result = $statement->get_result();
        if ($result === false) {
            $errno = $this->mysqli->errno;
            $error = $this->mysqli->error;

            throw new ApplicationException("Unable to get result set: ({$errno}) {$error}");
        }

        return $result;
    }

}