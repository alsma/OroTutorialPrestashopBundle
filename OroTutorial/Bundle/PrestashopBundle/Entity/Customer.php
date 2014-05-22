<?php

namespace OroTutorial\Bundle\PrestashopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Oro\Bundle\BusinessEntitiesBundle\Entity\BasePerson;
use Oro\Bundle\IntegrationBundle\Model\IntegrationEntityTrait;

/**
 * @ORM\Entity
 * @ORM\Table(
 *      name="ot_prestashop_customer",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="unq_remote_id_channel_id", columns={"remote_id", "channel_id"})}
 * )
 */
class Customer extends BasePerson
{
    use IntegrationEntityTrait;

    /*
     * Do not use addresses in tutorial
     */
    protected $addresses;

    /**
     * @var integer
     *
     * @ORM\Column(name="remote_id", type="integer", options={"unsigned"=true}, nullable=false)
     */
    protected $remoteId;

    /**
     * @param int $remoteId
     *
     * @return $this
     */
    public function setRemoteId($remoteId)
    {
        $this->remoteId = $remoteId;
    }

    /**
     * @return int
     */
    public function getRemoteId()
    {
        return $this->remoteId;
    }
}
