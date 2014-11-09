CREATE TABLE rdl_doctor_profile (
 id INT NOT NULL AUTO_INCREMENT,
 name VARCHAR(50) NOT NULL ,
 qualification VARCHAR(50) NOT NULL ,
 associated_hospital VARCHAR(50) NULL ,
 years_of_exp INT NULL ,
 photo_id VARCHAR(50) NULL ,
 PRIMARY KEY (id))

CREATE TABLE rdl_patient_personal_profile (
 id INT NOT NULL AUTO_INCREMENT,
 name VARCHAR(50) NULL ,
 photo_ids VARCHAR(100) NULL ,
 date_of_birth DATE NULL ,
 gender VARCHAR(1) NOT NULL ,
 home_location VARCHAR(45) NULL ,
 mother_tongue VARCHAR(25) NULL ,
 current_location VARCHAR(45) NULL ,
 type_of_surgery VARCHAR(45) NULL ,
 annual_family_income INT unsigned NULL ,
 patient_profile_story VARCHAR(250) NULL ,
 last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
 PRIMARY KEY (id))

CREATE TABLE rdl_partner_hospitals (
 id INT NOT NULL AUTO_INCREMENT,
 name VARCHAR(65) NULL ,
 location VARCHAR(200) NULL ,
 PRIMARY KEY (id))

CREATE TABLE users1 (
 id int(4) unsigned NOT NULL AUTO_INCREMENT,
 version int(4) DEFAULT NULL,
 first_name varchar(100) DEFAULT NULL,
 last_name varchar(100) DEFAULT NULL,
 email_address varchar(50) NOT NULL DEFAULT '',
 password1 varchar(100) DEFAULT NULL,
 user_type enum('A','P','I','AC','CA','CI','AP') NOT NULL DEFAULT 'I',
 nationality_id int(4) unsigned NOT NULL DEFAULT '0',
 gender enum('M','F','TG') DEFAULT NULL,
 date_of_birth date DEFAULT NULL,
 city varchar(50) DEFAULT NULL,
 country varchar(50) DEFAULT NULL,
 phone_residence varchar(20) DEFAULT NULL,
 phone_mobile varchar(20) DEFAULT NULL,
 registration_date datetime DEFAULT NULL,
 last_login_timestamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE 
CURRENT_TIMESTAMP,
 PRIMARY KEY (id),
 UNIQUE KEY email_address (email_address),
 KEY cityIndex (city)
) 

CREATE TABLE rdl_suggested_volunteer (
 id INT NOT NULL AUTO_INCREMENT,
 name VARCHAR(55) NULL ,
 location VARCHAR(55) NULL ,
 email_address VARCHAR(45) NULL ,
 phone_number VARCHAR(65) NULL ,
suggested_by_id INT(4) UNSIGNED NOT NULL,
 PRIMARY KEY (id))

CREATE TABLE rdl_patient_case_profile (
 id INT NOT NULL AUTO_INCREMENT,
 patient_id INT NOT NULL ,
 partner_hospital_id INT NULL ,
 doctor_id INT NULL ,
 case_study_video_link VARCHAR(100) NULL ,
 case_files_location VARCHAR(100) NULL ,
 threat_to_life INT NULL DEFAULT 10 ,
 risk_to_livelihood INT NULL ,
case_referred_on DATE NULL ,
 estimated_fundraising_date DATE NULL ,
estimated_admission_date DATE NULL , 
 estimated_surgery_date DATE NULL , 
 estimated_discharge_date DATE NULL ,
 profile_submission_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
 volunteer_id INT(4) unsigned NOT NULL ,
 total_amount_needed INT NOT NULL DEFAULT 0 ,
 total_amount_raised INT NOT NULL DEFAULT 0 ,
 total_pledged_amount INT NOT NULL DEFAULT 0 ,
 PRIMARY KEY (id))

CREATE TABLE rdl_payments (
 id INT NOT NULL AUTO_INCREMENT ,
 case_id INT NULL ,
 investor_id int(4) unsigned NOT NULL ,
 donation_amount INT NULL ,
 payment_mode VARCHAR(10) NULL ,
 transaction_id VARCHAR(100) NULL ,
 bank_id INT NULL ,
 response_code VARCHAR(200) NULL ,
 payment_status VARCHAR(30) NULL ,
 transaction_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
 last_updated TIMESTAMP NULL ,
 is_transaction_anonymous VARCHAR(1) NOT NULL DEFAULT 'N' ,
 is_80G_sent VARCHAR(1) NULL ,
 PRIMARY KEY (id) )

CREATE TABLE investors (
 id int(4) unsigned NOT NULL AUTO_INCREMENT,
 image_id VARCHAR(200) DEFAULT NULL,
 organization varchar(100) DEFAULT NULL,
 occupation varchar(200) DEFAULT NULL,
 nick_name varchar(50) DEFAULT NULL,
 has_invested tinyint(1) NOT NULL DEFAULT '0',
 PRIMARY KEY (id))

CREATE TABLE patient_updates (
 case_id INT NOT NULL ,
 user_id INT NOT NULL ,
 comment varchar(400) DEFAULT NULL ,
 image_url varchar (400) DEFAULT NULL ,
 video_url varchar (400) DEFAULT NULL ,
 update_time TIMESTAMP NULL
)

CREATE TABLE comments_patient (
seq_id INT(5) NOT NULL,
time_comment TIMESTAMP NOT NULL,
comment varchar(1000) DEFAULT NULL,
sType varchar(1),
sId varchar(30) DEFAULT NULL,
patientId INT(20) DEFAULT NULL)