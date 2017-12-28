<?php

namespace OW\CommunicationBundle\Entity\Vocative;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Vocative
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(length=255)
     */
    protected $translation;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    protected $male;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    protected $checked;

    /**
     * Vocative constructor.
     */
    public function __construct()
    {
        $this->male = false;
        $this->checked = false;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getTranslation(): string
    {
        return $this->translation;
    }

    /**
     * @param string $translation
     */
    public function setTranslation(string $translation)
    {
        $this->translation = $translation;
    }

    /**
     * @return bool
     */
    public function isMale(): bool
    {
        return $this->male;
    }

    /**
     * @param bool $male
     */
    public function setMale(bool $male)
    {
        $this->male = $male;
    }

    /**
     * @return bool
     */
    public function isChecked(): bool
    {
        return $this->checked;
    }

    /**
     * @param bool $checked
     */
    public function setChecked(bool $checked)
    {
        $this->checked = $checked;
    }
}