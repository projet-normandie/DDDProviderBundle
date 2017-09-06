<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint;

/**
 * Class PastDate
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\Constraint
 */
class PastDate extends AbstractDateConstraint
{
    /**
     * @var string
     */
    public $message = 'This date "%value%" is not before "%date%"';

    /**
     * Compare two date time each other and returns true if the date to validate is in the past compared to the date
     * time limit. It also takes into account the possibility of the equality between dates.
     *
     * @param \DateTime $dateToValidate
     * @param \DateTime $dateLimit
     * @return bool
     */
    public function compareDate(\DateTime $dateToValidate, \DateTime $dateLimit): bool
    {
        if (true === $this->equal) {
            return $dateToValidate <= $dateLimit;
        }
        return $dateToValidate < $dateLimit;
    }
}
