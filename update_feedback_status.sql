-- Add status column to feedback to allow active/inactive
ALTER TABLE `feedback`
  ADD COLUMN `status` TINYINT(1) NOT NULL DEFAULT 1 AFTER `f_description`;

-- Optional: initialize all existing rows as active (1)
UPDATE `feedback` SET `status` = 1 WHERE `status` IS NULL;

