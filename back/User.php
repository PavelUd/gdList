<?php
namespace gdlist\www\back;
class User
{
    private string $name;
    private int $id;
    private array $created_levels;
    private array $records;
    public function __construct($name, $id)
    {
        $this->name = $name;
        $this->id = $id;
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
class Admin extends User {

}
?>