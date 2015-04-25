<?php
/**
 * Created by Christoph Graupner <ch.graupner@workingdeveloper.net>.
 *
 * Copyright (c) 2015 WorkingDevelopers.NET
 */

namespace FamGenTree\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FamGenTree\AppBundle\Service\Auth;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(
 *          name="username",
 *          column=@ORM\Column(
 *              nullable = false,
 *              length   = 100
 *          )
 *      ),
 *      @ORM\AttributeOverride(
 *          name="usernameCanonical",
 *          column=@ORM\Column(
 *              name     = "username_canonical",
 *              nullable = false,
 *              unique   = true,
 *              length   = 100
 *          )
 *      ),
 *      @ORM\AttributeOverride(
 *          name="password",
 *          column=@ORM\Column(
 *              nullable = true,
 *              unique   = false,
 *              length   = 100
 *          )
 *      ),
 *      @ORM\AttributeOverride(
 *          name="salt",
 *          column=@ORM\Column(
 *              nullable = true,
 *              unique   = false,
 *              length   = 100
 *          )
 *      ),
 * })
 */
class User
    extends BaseUser
    implements AdvancedUserInterface
{
    const CLASSNAME = 'FamGenTree\AppBundle\Entity\User';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id_user")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="realname",nullable=true,length=100)
     */
    protected $realName;

    /**
     * @var String
     *
     * @ORM\Column(name="password_algorithm",type="string",length=15,options={"default" = "bcrypt_10"})
     */
    protected $passwordAlgorithm = null;

    protected $approved;

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->passwordAlgorithm = Auth::ALGORITHM_BCRYPT_NEW;
    }

    /**
     * @return string
     */
    public function getRealName()
    {
        return $this->realName;
    }

    /**
     * @param string $realName
     */
    public function setRealName($realName)
    {
        $this->realName = $realName;
    }
}
