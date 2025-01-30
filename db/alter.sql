CREATE TABLE IF NOT EXISTS `ci_sessions` (
    `id` varchar(128) NOT null,
    `ip_address` varchar(45) NOT null,
    `timestamp` timestamp DEFAULT CURRENT_TIMESTAMP NOT null,
    `data` blob NOT null,
    KEY `ci_sessions_timestamp` (`timestamp`)
    );



    ALTER TABLE `extended_profiles` ADD `PharmaName` VARCHAR(250) NULL AFTER `SubDomainUrl`; 

    