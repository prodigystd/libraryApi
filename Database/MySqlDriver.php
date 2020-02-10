<?php


namespace LibraryApi\Database;


class MySqlDriver implements DataBaseDriver
{
    private $connection;

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

    private function connect()
    {
        $this->connection = mysqli_connect(Config::get('host'), Config::get('userName'), Config::get('password'),
            Config::get('dataBaseName'), Config::get('port'));

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
