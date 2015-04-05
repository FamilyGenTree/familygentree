<?php
/**
 * Created by Christoph Graupner <ch.graupner@workingdeveloper.net>.
 *
 * Copyright (c) 2015 FamilyGenTree
 */

namespace FamGenTree\SetupBundle\Context\Setup\Step;

use FamGenTree\SetupBundle\Context\Setup\Config\ConfigAbstract;
use FamGenTree\SetupBundle\Context\Setup\Config\ConfigFirstSettings;
use FOS\UserBundle\Util\Canonicalizer;

class FirstSettingsStep extends StepBase
{
    protected $pdo;

    /**
     * @var string table prefix
     */
    protected $prefix;

    /**
     * @param \FamGenTree\SetupBundle\Context\Setup\Config\ConfigAbstract $config
     *
     * @return StepResultAggregate
     */
    public function checkConfig(ConfigAbstract $config)
    {
        $ret = new StepResultAggregate(
            __METHOD__
        );
        /** @var ConfigFirstSettings $config */
        if ($config->getPassword() !== $config->getPasswordRepeat()) {
            $ret->addResult(
                new StepResult(
                    'Passwords',
                    StepResult::STATE_FAILED,
                    'Passwords do not match'
                )
            );
        }

        return $ret;
    }

    public function run()
    {
        try {
            $userId = 1;
            /** @var ConfigFirstSettings $config */
            $config   = $this->getConfig();
            $salt     = sha1(time());
            $password = password_hash(
                $config->getPassword(),
                PASSWORD_BCRYPT,
                array(
                    'salt' => $salt,
                    'cost' => 10
                )
            );
            $pdo      = $this->getPDO();

            $canonicalizer = new Canonicalizer();

            $statement = $pdo->prepare(
                $this->applyPrefix("INSERT IGNORE INTO `###PREFIX###config` (`section`, `config_key`, `config_value`) VALUES (:section, :config_key, :value);")
            );
            $rootDir   = $this->container->get('kernel')->getRootDir();
            $dataDir   = $rootDir . DIRECTORY_SEPARATOR . '../data';
            foreach (array(
                         'site:locale'   => $this->getLocale(),
                         'site:name'     => 'Site Name',
                         'site:url'      => $_SERVER['SERVER_NAME'],
                         'site:path.imports' => $dataDir . DIRECTORY_SEPARATOR . 'imports',
                         'site:path.uploads' => $dataDir . DIRECTORY_SEPARATOR . 'uploads',
                         'site:path.gedcoms' => $dataDir . DIRECTORY_SEPARATOR . 'gedcoms'
                     ) as $key => $value) {
                list($section, $config_key) = explode(':', $key);
                $statement->execute(
                    array(
                        ':section'    => $section,
                        ':config_key' => $config_key,
                        ':value'      => $value
                    )
                );
            }
            $statement = $pdo->prepare(
                $this->applyPrefix(
                    'INSERT INTO `###PREFIX###user`
(`id_user`,
`username`,
`username_canonical`,
`realname`,
`email`,
`email_canonical`,
`password`,
`password_algorithm`,
`salt`,
`enabled`,
`locked`,
`expired`,
`roles`,
`credentials_expired`)
VALUES
(:user_id,
:username,
:username_canonical,
:real_name,
:email,
:email_canonical,
:password,
:password_algorithm,
:salt,
:enabled,
:locked,
:expired,
:roles,
:credentials_expired
);
'
                )
            );

            $statement->execute(
                array(
                    ':user_id'             => $userId,
                    ':username'            => $config->getUserName(),
                    ':username_canonical'  => $canonicalizer->canonicalize($config->getUserName()),
                    ':real_name'           => $config->getName(),
                    ':email'               => $config->getEmail(),
                    ':email_canonical'     => $canonicalizer->canonicalize($config->getEmail()),
                    ':password'            => $password,
                    ':password_algorithm'  => 'bcrypt_10',
                    ':salt'                => $salt,
                    ':enabled'             => 1,
                    ':locked'              => 0,
                    ':expired'             => 0,
                    ':roles'               => serialize(array('ROLE_ADMIN')),
                    ':credentials_expired' => 0,
                )
            );
        } catch (\Exception $ex) {
            $this->addResult(
                new StepResult(
                    $ex->getMessage(),
                    StepResult::STATE_FAILED,
                    $ex
                )
            );
            throw $ex;
        }
    }

    protected function applyPrefix($sql)
    {
        return str_replace(array(
                               '###PREFIX###',
                               '###COLATION###'
                           ), array(
                               $this->prefix,
                               'utf8_unicode_ci'
                           ), $sql);
    }

    protected function getPDO()
    {
        if (null === $this->pdo) {
            $config       = $this->getSetupManager()->getConfigDatabase();
            $this->prefix = $config->getPrefix();

            $dsn       = "{$config->getDbSystem()}:host={$config->getHost()};dbname={$config->getDbname()}";
            $this->pdo = new \PDO(
                $dsn,
                $config->getUser(),
                $config->getPassword(),
                array(
                    \PDO::ATTR_EMULATE_PREPARES => false,
                    \PDO::ATTR_ERRMODE          => \PDO::ERRMODE_EXCEPTION
                )
            );
        }

        return $this->pdo;
    }

    protected function getLocale()
    {
        $manager = $this->container->get('fgt.setup.manager');

        return $manager->getSetupConfig()->getSetupLocale();
    }
}