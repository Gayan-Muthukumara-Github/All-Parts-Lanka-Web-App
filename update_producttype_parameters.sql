-- SQL script to add 15 more parameters to producttype table
-- This will extend the current 5 parameters to 20 parameters

-- Add the new parameter columns to the producttype table
ALTER TABLE `producttype` 
ADD COLUMN `parameter6` varchar(50) DEFAULT NULL AFTER `parameter5`,
ADD COLUMN `parameter7` varchar(50) DEFAULT NULL AFTER `parameter6`,
ADD COLUMN `parameter8` varchar(50) DEFAULT NULL AFTER `parameter7`,
ADD COLUMN `parameter9` varchar(50) DEFAULT NULL AFTER `parameter8`,
ADD COLUMN `parameter10` varchar(50) DEFAULT NULL AFTER `parameter9`,
ADD COLUMN `parameter11` varchar(50) DEFAULT NULL AFTER `parameter10`,
ADD COLUMN `parameter12` varchar(50) DEFAULT NULL AFTER `parameter11`,
ADD COLUMN `parameter13` varchar(50) DEFAULT NULL AFTER `parameter12`,
ADD COLUMN `parameter14` varchar(50) DEFAULT NULL AFTER `parameter13`,
ADD COLUMN `parameter15` varchar(50) DEFAULT NULL AFTER `parameter14`,
ADD COLUMN `parameter16` varchar(50) DEFAULT NULL AFTER `parameter15`,
ADD COLUMN `parameter17` varchar(50) DEFAULT NULL AFTER `parameter16`,
ADD COLUMN `parameter18` varchar(50) DEFAULT NULL AFTER `parameter17`,
ADD COLUMN `parameter19` varchar(50) DEFAULT NULL AFTER `parameter18`,
ADD COLUMN `parameter20` varchar(50) DEFAULT NULL AFTER `parameter19`;

-- Verify the table structure
DESCRIBE `producttype`;
