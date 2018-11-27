<?php

namespace App\Services\Imports;

use Exception;

/**
 * Class MsSqlManager
 * @package App\Services
 */
class MsSqlManager implements ImportManager
{
    /**
     * @var string
     */
    private $server;

    /**
     * @var string
     */
    private $database;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $sql;

    /**
     * MsSqlManager constructor.
     */
    public function __construct()
    {
        $this->server = $this->getServer(config('mssql.host'), config('mssql.port'));
        $this->database = config('mssql.database');
        $this->username = config('mssql.username');
        $this->password = config('mssql.password');
        $this->sql = trim(preg_replace('/\s\s+/', ' ', config('mssql.sql')));
    }

    /**
     * @param $host
     * @param $port
     * @return string
     */
    private function getServer($host, $port)
    {
        $port = $port ? ',' . $port : '';

        return $host . $port;
    }

    /**
     * @return array
     */
    public function getDishes()
    {
        return $this->query();
    }

    /**
     * @return array
     */
    public function query()
    {
        try {
            return collect($this->readData());
        } catch (Exception $e) {
            return null;
        }

    }

    /**
     * @return false|resource
     * @throws Exception
     */
    private function openConnection()
    {
        $connectionOptions = [
            'Database' => $this->database,
            'Uid' => $this->username,
            'PWD' => $this->password,
        ];

        $connection = sqlsrv_connect($this->server, $connectionOptions);
        if($connection == false) {
            throw new Exception(sqlsrv_errors());
        }

        return $connection;
    }

    /**
     * @return array
     * @throws Exception
     */
    function readData()
    {
        $connection = $this->openConnection();

        $result = sqlsrv_query($connection, $this->sql);
        if ($result == FALSE) {
            throw new Exception(sqlsrv_errors());
        }

        for ($index = 0, $data = []; $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC); $index++) {
            $data[] = $row;
        }

        sqlsrv_free_stmt($result);
        sqlsrv_close($connection);

        return $data;
    }
}

