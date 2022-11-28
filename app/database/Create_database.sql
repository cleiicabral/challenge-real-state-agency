
CREATE SCHEMA IF NOT EXISTS `state_agency_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `state_agency_db` ;

CREATE TABLE IF NOT EXISTS `state_agency_db`.`clients` (
  `id` VARCHAR(36) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `phoneNumber` VARCHAR(45) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  CONSTRAINT clients_pk PRIMARY KEY (id)
  )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE IF NOT EXISTS `state_agency_db`.`property_owners` (
  `id` VARCHAR(36) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `phone_number` VARCHAR(45) NOT NULL,
  `payday` TINYINT(3) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  CONSTRAINT property_owners_pk PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `state_agency_db`.`properties` (
  `id` VARCHAR(36) NOT NULL,
  `property_address` TEXT NOT NULL,
  `property_owners_id` VARCHAR(36) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
CONSTRAINT properties_pk PRIMARY KEY (id),
CONSTRAINT `fk_properties_property_owners`
FOREIGN KEY (`property_owners_id`)
REFERENCES `state_agency_db`.`property_owners` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE IF NOT EXISTS `state_agency_db`.`contracts` (
  `id` VARCHAR(36) NOT NULL,
  `start_date` DATETIME NOT NULL,
  `end_date` DATETIME NOT NULL,
  `administration_fee` DOUBLE NOT NULL,
  `rent_amount` DOUBLE NOT NULL,
  `condo_price` DOUBLE NOT NULL,
  `iptu_price` DOUBLE NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  `property_owners_id` VARCHAR(36) NOT NULL,
  `properties_id` VARCHAR(36) NOT NULL,
  `clients_id` VARCHAR(36) NOT NULL,
  CONSTRAINT contracts_pk PRIMARY KEY (id),
  CONSTRAINT `fk_contracts_property_owners1`
    FOREIGN KEY (`property_owners_id`)
    REFERENCES `state_agency_db`.`property_owners` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_contracts_properties1`
    FOREIGN KEY (`properties_id`)
    REFERENCES `state_agency_db`.`properties` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_contracts_clients1`
    FOREIGN KEY (`clients_id`)
    REFERENCES `state_agency_db`.`clients` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `state_agency_db`.`monthly_payments` (
  `id` VARCHAR(36) NOT NULL,
  `price` DOUBLE NOT NULL,
  `due_date` DATETIME NOT NULL,
  `type` VARCHAR(36) NOT NULL,
  `status` VARCHAR(36) NOT NULL DEFAULT 'PENDING',
  `person_in_charge` VARCHAR(36) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
CONSTRAINT monthly_payment_pk PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
