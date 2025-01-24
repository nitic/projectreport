-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 31, 2023 at 09:55 AM
-- Server version: 10.0.38-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

USE `projectDB`;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE project(
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_name TEXT NOT NULL,
    project_detail TEXT NULL,
    project_strategic JSON NULL,
    project_type TEXT NULL,
    project_status VARCHAR(50) NULL,
    implement_date DATE NULL,
    project_location TEXT NULL,
    project_person VARCHAR(100) NULL,
    project_objectives TEXT NULL,
    plan_status VARCHAR(20) NULL,
    budget_cash DECIMAL(11) NULL,
    budget_kind DECIMAL(11) NULL,
    budget_source VARCHAR(100) NULL,
    budget_received DECIMAL(11) NULL,
    budget_pay DECIMAL(11) NULL,
    budget_plan VARCHAR(100) NULL,
    budget_output VARCHAR(100) NULL,
    budget_code VARCHAR(50) NULL,
    participants JSON NULL,
    output_type TEXT NULL,
    output_result TEXT NULL,
    output_satisfaction VARCHAR(10) NULL,
    success_indicators TEXT NULL,
    outcomes TEXT NULL,
    impacts TEXT NULL,
    problems TEXT NULL,
    solution TEXT NULL,
    work_continued TEXT NULL,
    report_analysis TEXT NULL,
    report_file TEXT NULL,
    file_upload TEXT NULL,
    created_by VARCHAR(50) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE person(
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(200) NOT NULL,
    position VARCHAR(50) NULL,
    email VARCHAR(50) NULL,
    phone VARCHAR(10) NULL
);

CREATE TABLE plans(
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_fk_id INT(11) NOT NULL,
    no_order INT(2) NOT NULL,
    plan_activity TEXT NULL,
    date_according DATE NULL,
    date_implement DATE NULL,
    note TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE expense(
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_fk_id INT(11) NOT NULL,
    expense_type VARCHAR(200) NOT NULL,
    item_name VARCHAR(200) NOT NULL,
    amount DECIMAL(11) NULL,
    note TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE fileupload(
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_fk_id INT(11) NOT NULL,
    file_name VARCHAR(100) NOT NULL,
    file_path VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);