<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use ProjetNormandie\DddProviderBundle\Layer\Domain\ValueObject\Generalisation\AbstractVO;

/**
 * Final Class ProfileVO
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage ValueObject
 * @final
 *
 * @ORM\Embeddable
 */
final class ProfileVO extends AbstractVO
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50)
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50)
     */
    protected $firstName;

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }
}
