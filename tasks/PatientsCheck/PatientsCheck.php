<?php

require 'config\DB.php';

use config\DB;

try {
    createTables();
} catch (Exception $e) {
    echo $e->getMessage();
}

/**
 * Creating data storage
 * @throws Exception
 */
function createTables(): void
{
    $sql = '
    CREATE TABLE IF NOT EXISTS `patients` (
        `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `full_name` varchar(128)
    ) ENGINE=INNODB; 

    CREATE TABLE IF NOT EXISTS `patient_indicators` (
        `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `patient_id` int NOT NULL,
        `pressure` varchar(7),
        `pulse` tinyint,
        `measure_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        INDEX `pulse_pressure_measure_date_index` (`pulse`,`pressure`,`measure_date`),
        CONSTRAINT `fk_patient` 
            FOREIGN KEY (`patient_id`) 
            REFERENCES `patients`(`id`)
            ON UPDATE CASCADE ON DELETE CASCADE 
    ) ENGINE=INNODB;
    ';
    
    DB::getInstance()->query($sql);
}