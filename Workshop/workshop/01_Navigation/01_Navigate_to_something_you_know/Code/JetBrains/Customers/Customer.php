<?php
namespace Navigation1\JetBrains\Customers;


class Customer {
    /** @var string */
    protected $_name;

    /** @var int */
    protected $_age;

    /**
     * @param string $name
     * @param int $age
     */
    function __construct(string $name, int $age)
    {
        $this->_age = $age;
        $this->_name = $name;
    }

    /**
     * @param int $age
     */
    public function setAge(int $age)
    {
        $this->_age = $age;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->_age;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->_name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->_name;
    }

    /**
     * Celebrate birthday.
     */
    public function celebrateBirthday() {
        echo 'Yay!';
    }
}
