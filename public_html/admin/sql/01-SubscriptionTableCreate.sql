CREATE TABLE `tblalbumsubscription` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `period` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `pamount` decimal(10,2) NOT NULL,
  `signature` tinyint(4) NOT NULL DEFAULT 0,
  `photo_count` int(11) NOT NULL DEFAULT 0,
  `online` tinyint(4) NOT NULL DEFAULT 0,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `is_primary` tinyint(4) NOT NULL DEFAULT 0,
  `featurs` varchar(1000) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NULL DEFAULT NULL,
  `deleted_on` timestamp NULL DEFAULT NULL,
  `delete` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tblsignaturealbumsubscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL,
  `signature_album_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `delete` int(11) NOT NULL DEFAULT 0,
  `deleted_on` datetime DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `period` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `pamount` decimal(10,2) NOT NULL,
  `signature` int(11) NOT NULL,
  `photo_count` int(11) NOT NULL,
  `online` int(11) NOT NULL,
  `featurs` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `tblsignaturealbumsubscription` ADD `online_album_id` INT NULL DEFAULT NULL AFTER `featurs`;



ALTER TABLE `tbesignaturealbum_projects` ADD `token` VARCHAR(225) NOT NULL AFTER `crated_in`;





-- ======================================================
CREATE TABLE `blogs` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `tittle` varchar(500) NOT NULL,
 `sub_tittle` varchar(500) NOT NULL,
 `posted_date` date NOT NULL,
 `author` varchar(200) NOT NULL,
 `small_description` text NOT NULL,
 `image` text NOT NULL,
 `video` text NOT NULL,
 `long_description` text NOT NULL,
 `active` int(1) NOT NULL,
 `created_by` int(11) NOT NULL,
 `created_date` datetime NOT NULL,
 `updated_by` int(11) NOT NULL,
 `updated_date` datetime NOT NULL,
 `deleted` int(1) NOT NULL,
 `deleted_by` int(11) NOT NULL,
 `deleted_date` datetime NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4


CREATE TABLE `stories` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `event_date` date NOT NULL,
 `event_place` text NOT NULL,
 `main_tittle` text NOT NULL,
 `image_story` text NOT NULL,
 `video` text NOT NULL,
 `small_description` text NOT NULL,
 `description` text NOT NULL,
 `active` int(1) NOT NULL,
 `created_by` int(11) NOT NULL,
 `created_date` datetime NOT NULL,
 `updated_by` int(11) NOT NULL,
 `updated_date` datetime NOT NULL,
 `deleted` int(1) NOT NULL,
 `deleted_by` int(11) NOT NULL,
 `deleted_date` datetime NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4

ALTER TABLE `tbecomment_reply` ADD `email` VARCHAR(100) NOT NULL AFTER `deleted`, ADD `phone_no` VARCHAR(50) NOT NULL AFTER `email`;


ALTER TABLE `tbesignaturealbum_data` CHANGE `file_folder` `file_folder` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

ALTER TABLE `tbevents_data` ADD `expiry_date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `deleted`;
ALTER TABLE `tbesignaturealbum_projects` ADD `expiry_date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `token`;


CREATE TABLE `mail_type` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `mail_type` varchar(225) NOT NULL,
 `active` int(11) NOT NULL DEFAULT 0,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `mail_type` (`id`, `mail_type`, `active`) VALUES (1, 'Online album', '1');
INSERT INTO `mail_type` (`id`, `mail_type`, `active`) VALUES (2, 'Signature album', '1');
INSERT INTO `mail_type` (`id`, `mail_type`, `active`) VALUES (3, 'Enquiries', '1');
INSERT INTO `mail_type` (`id`, `mail_type`, `active`) VALUES (4, 'Subscription', '1');



CREATE TABLE `mail_template_names` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `mail_type` varchar(225) NOT NULL,
 `mail_template` varchar(225) NOT NULL,
 `active` int(11) NOT NULL DEFAULT 0,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO `mail_template_names` (`id`, `mail_type`, `mail_template`, `active`) VALUES ('1', '1', 'Create', '1');
INSERT INTO `mail_template_names` (`id`, `mail_type`, `mail_template`, `active`) VALUES ('2', '1', 'Expired', '1');
INSERT INTO `mail_template_names` (`id`, `mail_type`, `mail_template`, `active`) VALUES ('3', '1', 'Expiring', '1');
INSERT INTO `mail_template_names` (`id`, `mail_type`, `mail_template`, `active`) VALUES ('4', '1', 'Delete', '1');
INSERT INTO `mail_template_names` (`id`, `mail_type`, `mail_template`, `active`) VALUES ('13', '1', 'Extend', '1');

INSERT INTO `mail_template_names` (`id`, `mail_type`, `mail_template`, `active`) VALUES ('5', '2', 'Create', '1');
INSERT INTO `mail_template_names` (`id`, `mail_type`, `mail_template`, `active`) VALUES ('6', '2', 'Expired', '1');
INSERT INTO `mail_template_names` (`id`, `mail_type`, `mail_template`, `active`) VALUES ('7', '2', 'Expiring', '1');
INSERT INTO `mail_template_names` (`id`, `mail_type`, `mail_template`, `active`) VALUES ('8', '2', 'Delete', '1');
INSERT INTO `mail_template_names` (`id`, `mail_type`, `mail_template`, `active`) VALUES ('9', '2', 'Hide', '1');
INSERT INTO `mail_template_names` (`id`, `mail_type`, `mail_template`, `active`) VALUES ('10', '2', 'Show', '1');
INSERT INTO `mail_template_names` (`id`, `mail_type`, `mail_template`, `active`) VALUES ('12', '2', 'Extend', '1');


INSERT INTO `mail_template_names` (`id`, `mail_type`, `mail_template`, `active`) VALUES ('11', '3', 'Enquiries', '1');

-- //13 is latest ^^^^^

CREATE TABLE `mail_field` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `mail_type` varchar(225) NOT NULL,
  `mail_template` varchar(225) NOT NULL,
 `mail_field` varchar(225) NOT NULL,
 `active` int(11) NOT NULL DEFAULT 0,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `mail_field` ADD `created_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `active`;


CREATE TABLE `mail_templates` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `mail_type` varchar(100) NOT NULL,
 `subject` varchar(225) NOT NULL,
 `mail_body` text NOT NULL,
 `active` int(11) NOT NULL DEFAULT 1,
 `created_date` datetime NOT NULL DEFAULT current_timestamp(),
 `updated_date` datetime NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `mail_templates` ADD `deleted` INT NOT NULL DEFAULT '0' AFTER `updated_date`;
ALTER TABLE `mail_templates` ADD `mail_template` INT NOT NULL AFTER `deleted`;



CREATE TABLE `tbeproject_views` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `project_id` int(30) NOT NULL,
 `IP` varchar(250) DEFAULT NULL,
 `created_in` datetime NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;


Change tbeevent_files size  pdffile_name (500) , covering_name(225)

ALTER TABLE `tbevents_data` CHANGE `folder_name` `folder_name` VARCHAR(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;
ALTER TABLE `tbevents_data` CHANGE `uploader_folder` `uploader_folder` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;
ALTER TABLE `tbevents_data` CHANGE `description` `description` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

CREATE TABLE `tbevents_views` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `project_id` int(30) NOT NULL,
 `IP` varchar(250) DEFAULT NULL,
 `created_in` datetime NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;


CREATE TABLE `stories_views` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `stories_id` int(30) NOT NULL,
 `IP` varchar(250) DEFAULT NULL,
 `created_in` datetime NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;


CREATE TABLE `blogs_views` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `blogs_id` int(30) NOT NULL,
 `IP` varchar(250) DEFAULT NULL,
 `created_in` datetime NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;


CREATE TABLE `tbeproject_shares` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `project_id` int(30) NOT NULL,
 `IP` varchar(250) DEFAULT NULL,
 `created_in` datetime NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tbevents_shares` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `userId` int(30) NOT NULL,
 `IP` varchar(250) DEFAULT NULL,
 `created_in` datetime NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;



CREATE TABLE `tbl_cinematography` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `category` text NOT NULL,
 `event_place` text NOT NULL,
 `camera` text NOT NULL,
 `client` text NOT NULL,
 `main_tittle` text NOT NULL,
 `image_story` text NOT NULL,
 `video` text NOT NULL,
 `small_description` text NOT NULL,
 `description` text NOT NULL,
 `active` int(1) NOT NULL,
 `created_by` int(11) NOT NULL,
 `created_date` datetime NOT NULL,
 `updated_by` int(11) NOT NULL,
 `updated_date` datetime NOT NULL,
 `deleted` int(1) NOT NULL,
 `deleted_by` int(11) NOT NULL,
 `deleted_date` datetime NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4



CREATE TABLE `tbl_services` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `category` text NOT NULL,
 `event_place` text NOT NULL,
 `camera` text NOT NULL,
 `client` text NOT NULL,
 `main_tittle` text NOT NULL,
 `small_description` text NOT NULL,
 `description` text NOT NULL,
 `active` int(1) NOT NULL,
 `created_by` int(11) NOT NULL,
 `created_date` datetime NOT NULL,
 `updated_by` int(11) NOT NULL,
 `updated_date` datetime NOT NULL,
 `deleted` int(1) NOT NULL,
 `deleted_by` int(11) NOT NULL,
 `deleted_date` datetime NOT NULL,
 `file_folder` text NOT NULL,
 `cover_image_path` text NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4

CREATE TABLE `tbeservices_folderfiles` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `file_name` varchar(50) DEFAULT NULL,
 `file_size` varchar(30) DEFAULT NULL,
 `services_id` int(11) DEFAULT NULL,
 `file_path` varchar(250) DEFAULT NULL,
 `thumb_image_path` varchar(250) DEFAULT NULL,
 `hide` int(10) NOT NULL DEFAULT 0,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4

create admin/ serviceAlbumUploads



CREATE TABLE `cinematography_views` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `cinematography_id` int(30) NOT NULL,
 `IP` varchar(250) DEFAULT NULL,
 `created_in` datetime NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;



CREATE TABLE `stories_shares` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `stories_id` int(30) NOT NULL,
 `IP` varchar(250) DEFAULT NULL,
 `created_in` datetime NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;


CREATE TABLE `blogs_shares` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `blogs_id` int(30) NOT NULL,
 `IP` varchar(250) DEFAULT NULL,
 `created_in` datetime NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;



ALTER TABLE `tblsignaturealbumsubscription` 
  ADD `payment_status` INT NULL DEFAULT NULL AFTER `online_album_id`,
  ADD `order_id` varchar(255) NULL DEFAULT NULL AFTER `payment_status`,
  ADD `payment_id` varchar(255) NULL DEFAULT NULL AFTER `order_id`,
  ADD `razorpay_signature` varchar(255) NULL DEFAULT NULL AFTER `payment_id`,
  ADD `error_code` varchar(255) NULL DEFAULT NULL AFTER `razorpay_signature`,
  ADD `error_reason` text NULL DEFAULT NULL AFTER `error_code`;





CREATE TABLE `story_imgfiles` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `file_name` varchar(50) DEFAULT NULL,
 `file_size` varchar(30) DEFAULT NULL,
 `story_id` int(11) DEFAULT NULL,
 `file_path` varchar(250) DEFAULT NULL,
 `hide` int(10) NOT NULL DEFAULT 0,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4


CREATE TABLE `tblrecent_activity` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `task` text NOT NULL,
 `created_in` datetime NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `tblrecent_activity` ADD `action` VARCHAR(30) NOT NULL AFTER `created_in`;



ALTER TABLE `tbecomment_reply` ADD `userId` INT NULL DEFAULT NULL AFTER `phone_no`;