<?php


namespace LibraryApi\Modules\Database;


use mysqli;

class MySqlDriver implements DatabaseDriverInterface
{
    /**
     * @var mysqli|bool
     */
    private bool|mysqli $connection;

    /**
     * @var Config
     */
    private Config $config;


    public function setConfig(Config $config)
    {
        $this->config = $config;
    }

    public function getConfig(): Config
    {
        return $this->config;
    }

    public function select(string $sqlQuery, array $params = []): array
    {
        $this->connect();
        $preparedStatement = $this->connection->prepare($sqlQuery);
        foreach ($params as $paramType => $paramValue) {
            $preparedStatement->bind_param($paramType, $paramValue);
        }
        $preparedStatement->execute();
        $result = $preparedStatement->get_result();
        $allRows = [];
        while ($row = $result->fetch_assoc()) {
            $allRows[] = $row;
        }

        $this->close();
        return $allRows;
    }

    public function execute(string $sqlQuery, array $params = []): bool
    {
        $this->connect();
        $preparedStatement = $this->connection->prepare($sqlQuery);
        foreach ($params as $paramType => $paramValue) {
            $preparedStatement->bind_param($paramType, $paramValue);
        }
        $result = $preparedStatement->execute();

        $this->close();
        return $result;
    }

    private function connect()
    {
        $this->connection = mysqli_connect(
            $this->config->get('host'),
            $this->config->get('userName'),
            $this->config->get('password'),
            $this->config->get('dataBaseName'),
            $this->config->get('port')
        );

        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        mysqli_set_charset($this->connection, "utf8");
    }

    private function close()
    {
        mysqli_close($this->connection);
    }


}
