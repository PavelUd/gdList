<?php
namespace gdlist\www\back;
class User
{
    private string $name;
    private int $id;
    private static $_instance = null;
    private array $created_levels;
    private array $records;
    private function __construct($name, $id)
    {
        $this->name = $name;
        $this->id = $id;
    }
    private function __clone() {
    }
    static public function getInstance($name = null, $id = null) {
        //все происходит через этот метод
        if(is_null(self::$_instance))
        {
            self::$_instance = new self($name, $id);
        }
        return self::$_instance;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getCreatedLevels(): array
    {
        return $this->created_levels;
    }
    public function getRecords(): array
    {
        return $this->records;
    }
}
?>