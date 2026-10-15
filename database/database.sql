-- Classic Hotel Management System database for PHP 8.3
CREATE DATABASE IF NOT EXISTS `hotel` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `hotel`;
SET FOREIGN_KEY_CHECKS=0;
CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_firstname` varchar(50) NOT NULL,
  `customer_lastname` varchar(50) NOT NULL,
  `customer_TCno` varchar(11) NOT NULL,
  `customer_city` varchar(50) DEFAULT NULL,
  `customer_country` varchar(50) DEFAULT NULL,
  `customer_telephone` varchar(50) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 ;

CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(50) NOT NULL,
  `department_budget` float DEFAULT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 ;

CREATE TABLE IF NOT EXISTS `do_sport` (
  `customer_id` int(11) NOT NULL,
  `sportfacility_id` int(11) NOT NULL,
  `dosport_date` varchar(50) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `dosport_details` text,
  `dosport_price` float DEFAULT NULL,
  PRIMARY KEY (`customer_id`,`sportfacility_id`,`dosport_date`),
  KEY `customer` (`customer_id`),
  KEY `sport_facility` (`sportfacility_id`),
  KEY `employee` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_username` varchar(50) NOT NULL,
  `employee_password` varchar(50) CHARACTER SET utf32 NOT NULL,
  `employee_firstname` varchar(50) NOT NULL,
  `employee_lastname` varchar(50) NOT NULL,
  `employee_telephone` varchar(50) DEFAULT NULL,
  `employee_email` varchar(50) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `employee_type` varchar(50) NOT NULL,
  `employee_salary` float DEFAULT NULL,
  `employee_hiring_date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`employee_id`),
  UNIQUE KEY `username` (`employee_username`),
  UNIQUE KEY `email` (`employee_email`),
  KEY `department` (`department_id`),
  KEY `login` (`employee_username`,`employee_password`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 ;

CREATE TABLE IF NOT EXISTS `get_medicalservice` (
  `customer_id` int(11) NOT NULL,
  `medicalservice_id` int(11) NOT NULL,
  `medicalservice_date` varchar(50)  NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `getmedicalservice_details` text ,
  `medicalservice_price` float DEFAULT NULL,
  PRIMARY KEY (`customer_id`,`medicalservice_id`,`medicalservice_date`),
  KEY `customer` (`customer_id`),
  KEY `medical_service` (`medicalservice_id`),
  KEY `employee` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `get_roomservice` (
  `customer_id` int(11) NOT NULL,
  `roomservice_id` int(11) NOT NULL,
  `roomservice_date` varchar(50) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `getroomservice_details` text,
  `roomservice_price` float DEFAULT NULL,
  PRIMARY KEY (`customer_id`,`roomservice_id`,`roomservice_date`),
  KEY `customer` (`customer_id`),
  KEY `room_service` (`roomservice_id`),
  KEY `employee` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `laundry` (
  `laundry_id` int(11) NOT NULL AUTO_INCREMENT,
  `laundry_open_time` varchar(50) DEFAULT NULL,
  `laundry_close_time` varchar(50) DEFAULT NULL,
  `laundry_details` text,
  PRIMARY KEY (`laundry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

CREATE TABLE IF NOT EXISTS `laundry_service` (
  `customer_id` int(11) NOT NULL,
  `laundry_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `laundry_date` varchar(50) DEFAULT NULL,
  `laundry_amount` int(11) DEFAULT NULL,
  `laundry_price` float DEFAULT NULL,
  PRIMARY KEY (`customer_id`,`laundry_id`),
  KEY `customer` (`customer_id`),
  KEY `laundry` (`laundry_id`),
  KEY `employee` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `massage_room` (
  `massageroom_id` int(11) NOT NULL AUTO_INCREMENT,
  `massageroom_open_time` varchar(10) DEFAULT NULL,
  `massageroom_close_time` varchar(10) DEFAULT NULL,
  `massageroom_details` text,
  PRIMARY KEY (`massageroom_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 ;

CREATE TABLE IF NOT EXISTS `massage_service` (
  `customer_id` int(11) NOT NULL,
  `massageroom_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `massage_date` varchar(50) DEFAULT NULL,
  `massage_details` text,
  `massage_price` float DEFAULT NULL,
  PRIMARY KEY (`customer_id`,`massageroom_id`),
  KEY `customer` (`customer_id`),
  KEY `massage` (`massageroom_id`),
  KEY `employee` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `medical_service` (
  `medicalservice_id` int(11) NOT NULL AUTO_INCREMENT,
  `medicalservice_open_time` varchar(50)  DEFAULT NULL,
  `medicalservice_close_time` varchar(50)  DEFAULT NULL,
  `medicalservice_details` text ,
  PRIMARY KEY (`medicalservice_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 ;

CREATE TABLE IF NOT EXISTS `reservation` (
  `customer_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `checkin_date` varchar(50) NOT NULL,
  `checkout_date` varchar(50) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `reservation_date` varchar(50) DEFAULT NULL,
  `reservation_price` float DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`customer_id`,`room_id`,`checkin_date`),
  KEY `customer` (`customer_id`),
  KEY `employee` (`employee_id`),
  KEY `room` (`room_id`),
  KEY `availability` (`room_id`,`checkin_date`,`checkout_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `restaurant` (
  `restaurant_name` varchar(50) NOT NULL,
  `restaurant_open_time` varchar(10) DEFAULT NULL,
  `restaurant_close_time` varchar(10) DEFAULT NULL,
  `restaurant_details` text,
  `table_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`restaurant_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `restaurant_booking` (
  `restaurant_name` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `book_date` varchar(50) NOT NULL,
  `table_number` int(11) DEFAULT NULL,
  `book_price` float DEFAULT NULL,
  PRIMARY KEY (`restaurant_name`,`customer_id`,`book_date`),
  KEY `restaurant` (`restaurant_name`),
  KEY `customer` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`room_id`),
  KEY `room_type` (`room_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 ;

CREATE TABLE IF NOT EXISTS `room_sales` (
  `customer_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `checkin_date` varchar(50) NOT NULL,
  `checkout_date` varchar(50) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `room_sales_price` float DEFAULT NULL,
  `total_service_price` float DEFAULT NULL,
  PRIMARY KEY (`customer_id`,`room_id`,`checkin_date`),
  KEY `customer` (`customer_id`),
  KEY `employee` (`employee_id`),
  KEY `room` (`room_id`),
  KEY `availability` (`room_id`,`checkin_date`,`checkout_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `room_service` (
  `roomservice_id` int(11) NOT NULL AUTO_INCREMENT,
  `roomservice_open_time` varchar(50) DEFAULT NULL,
  `roomservice_close_time` varchar(50) DEFAULT NULL,
  `roomservice_floor` varchar(50) DEFAULT NULL,
  `roomservice_details` text,
  PRIMARY KEY (`roomservice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

CREATE TABLE IF NOT EXISTS `room_type` (
  `room_type` varchar(50) NOT NULL,
  `room_price` int(11) DEFAULT NULL,
  `room_details` text,
  `room_quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`room_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `sport_facilities` (
  `sportfacility_id` int(11) NOT NULL AUTO_INCREMENT,
  `sportfacility_open_time` varchar(50)  DEFAULT NULL,
  `sportfacility_close_time` varchar(50)  DEFAULT NULL,
  `sportfacility_details` text ,
  PRIMARY KEY (`sportfacility_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 ;

CREATE TABLE IF NOT EXISTS `settings` (
 `setting_key` varchar(100) NOT NULL,
 `setting_value` text,
 PRIMARY KEY (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `do_sport`
 ADD CONSTRAINT `fk_sport_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `fk_sport_facility` FOREIGN KEY (`sportfacility_id`) REFERENCES `sport_facilities` (`sportfacility_id`) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `fk_sport_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `employee`
 ADD CONSTRAINT `fk_employee_department` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `get_medicalservice`
 ADD CONSTRAINT `fk_med_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `fk_med_service` FOREIGN KEY (`medicalservice_id`) REFERENCES `medical_service` (`medicalservice_id`) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `fk_med_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `get_roomservice`
 ADD CONSTRAINT `fk_roomservice_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `fk_roomservice_service` FOREIGN KEY (`roomservice_id`) REFERENCES `room_service` (`roomservice_id`) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `fk_roomservice_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `laundry_service`
 ADD CONSTRAINT `fk_laundry_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `fk_laundry_laundry` FOREIGN KEY (`laundry_id`) REFERENCES `laundry` (`laundry_id`) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `fk_laundry_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `massage_service`
 ADD CONSTRAINT `fk_massage_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `fk_massage_room` FOREIGN KEY (`massageroom_id`) REFERENCES `massage_room` (`massageroom_id`) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `fk_massage_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `reservation`
 ADD CONSTRAINT `fk_res_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `fk_res_room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `fk_res_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `restaurant_booking`
 ADD CONSTRAINT `fk_restaurant_booking_restaurant` FOREIGN KEY (`restaurant_name`) REFERENCES `restaurant` (`restaurant_name`) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `fk_restaurant_booking_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `room`
 ADD CONSTRAINT `fk_room_type` FOREIGN KEY (`room_type`) REFERENCES `room_type` (`room_type`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `room_sales`
 ADD CONSTRAINT `fk_sales_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `fk_sales_room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `fk_sales_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE SET NULL ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

INSERT INTO settings(setting_key,setting_value) VALUES
('hotel_name','Classic Hotel'),('hotel_phone',''),('hotel_email',''),('hotel_address','')
ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value);
