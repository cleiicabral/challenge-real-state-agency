<?php

namespace App\database;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class CreatorDoctrine
{
    public static function createEntityManager()
    {
		$paths = array("App\Model");
		$isDevMode = false;

        // database configuration parameters
        $conn = array(
            'driver'   => 'pdo_mysql',
			'port' => '3306',
            'user'     => 'root',
            'password' => 'mysql',
            'dbname'   => 'state_agency_db',
        );

        // obtaining the entity manager
		$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
        return $entityManager = EntityManager::create($conn, $config);
    }
}


