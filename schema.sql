BEGIN;
--
-- Create model Disease
--
CREATE TABLE `prescription_maker_disease` (`id` integer AUTO_INCREMENT NOT NULL PRIMARY KEY, `name` varchar(256) NOT NULL, `category` varchar(256) NOT NULL, `description` varchar(32768) NOT NULL, `causes` varchar(32768) NULL, `management` varchar(32768) NULL, `prevention` varchar(32768) NULL, `mechanism` varchar(32768) NULL, `epidemiology` varchar(32768) NULL, `diagnosis` varchar(32768) NULL, `prognosis` varchar(32768) NULL);
--
-- Create model Doctor
--
CREATE TABLE `prescription_maker_doctor` (`user_ptr_id` integer NOT NULL PRIMARY KEY, `name` varchar(256) NOT NULL, `age` smallint UNSIGNED NOT NULL, `gender` varchar(1) NOT NULL, `phone` varchar(32) NOT NULL, `specialty` varchar(1024) NULL);
--
-- Create model Medicine
--
CREATE TABLE `prescription_maker_medicine` (`id` integer AUTO_INCREMENT NOT NULL PRIMARY KEY, `name` varchar(256) NOT NULL, `category` varchar(256) NOT NULL, `description` varchar(32768) NOT NULL, `properties` varchar(32768) NULL, `adverse_effect` varchar(32768) NULL, `mechanism` varchar(32768) NULL, `pharmacokinetics` varchar(32768) NULL);
CREATE TABLE `prescription_maker_medicine_diseases` (`id` integer AUTO_INCREMENT NOT NULL PRIMARY KEY, `medicine_id` integer NOT NULL, `disease_id` integer NOT NULL);
CREATE TABLE `prescription_maker_medicine_incompatible_with` (`id` integer AUTO_INCREMENT NOT NULL PRIMARY KEY, `from_medicine_id` integer NOT NULL, `to_medicine_id` integer NOT NULL);
--
-- Create model Patient
--
CREATE TABLE `prescription_maker_patient` (`id` integer AUTO_INCREMENT NOT NULL PRIMARY KEY, `name` varchar(256) NOT NULL, `age` smallint UNSIGNED NOT NULL, `gender` varchar(1) NOT NULL, `phone` varchar(32) NOT NULL);
--
-- Create model Prescription
--
CREATE TABLE `prescription_maker_prescription` (`id` integer AUTO_INCREMENT NOT NULL PRIMARY KEY, `content` varchar(32768) NOT NULL, `date` datetime NOT NULL, `doctor_id_id` integer NOT NULL, `patient_id_id` integer NOT NULL);
CREATE TABLE `prescription_maker_prescription_diseases` (`id` integer AUTO_INCREMENT NOT NULL PRIMARY KEY, `prescription_id` integer NOT NULL, `disease_id` integer NOT NULL);
CREATE TABLE `prescription_maker_prescription_medicine` (`id` integer AUTO_INCREMENT NOT NULL PRIMARY KEY, `prescription_id` integer NOT NULL, `medicine_id` integer NOT NULL);
--
-- Create model Symptom
--
CREATE TABLE `prescription_maker_symptom` (`id` integer AUTO_INCREMENT NOT NULL PRIMARY KEY, `name` varchar(256) NOT NULL, `category` varchar(256) NOT NULL, `description` varchar(32768) NOT NULL, `causes` varchar(32768) NULL);
CREATE TABLE `prescription_maker_symptom_diseases` (`id` integer AUTO_INCREMENT NOT NULL PRIMARY KEY, `symptom_id` integer NOT NULL, `disease_id` integer NOT NULL);
CREATE TABLE `prescription_maker_symptom_relate_medicine` (`id` integer AUTO_INCREMENT NOT NULL PRIMARY KEY, `symptom_id` integer NOT NULL, `medicine_id` integer NOT NULL);
--
-- Add field symptoms to prescription
--
CREATE TABLE `prescription_maker_prescription_symptoms` (`id` integer AUTO_INCREMENT NOT NULL PRIMARY KEY, `prescription_id` integer NOT NULL, `symptom_id` integer NOT NULL);
--
-- Add field prescriptions to patient
--
CREATE TABLE `prescription_maker_patient_prescriptions` (`id` integer AUTO_INCREMENT NOT NULL PRIMARY KEY, `patient_id` integer NOT NULL, `prescription_id` integer NOT NULL);
--
-- Add field symptoms to medicine
--
CREATE TABLE `prescription_maker_medicine_symptoms` (`id` integer AUTO_INCREMENT NOT NULL PRIMARY KEY, `medicine_id` integer NOT NULL, `symptom_id` integer NOT NULL);
--
-- Add field prescriptions to doctor
--
CREATE TABLE `prescription_maker_doctor_prescriptions` (`id` integer AUTO_INCREMENT NOT NULL PRIMARY KEY, `doctor_id` integer NOT NULL, `prescription_id` integer NOT NULL);
--
-- Add field relate_medicine to disease
--
CREATE TABLE `prescription_maker_disease_relate_medicine` (`id` integer AUTO_INCREMENT NOT NULL PRIMARY KEY, `disease_id` integer NOT NULL, `medicine_id` integer NOT NULL);
--
-- Add field symptoms to disease
--
CREATE TABLE `prescription_maker_disease_symptoms` (`id` integer AUTO_INCREMENT NOT NULL PRIMARY KEY, `disease_id` integer NOT NULL, `symptom_id` integer NOT NULL);
ALTER TABLE `prescription_maker_doctor` ADD CONSTRAINT `prescription_maker_doctor_user_ptr_id_f660f944_fk_auth_user_id` FOREIGN KEY (`user_ptr_id`) REFERENCES `auth_user` (`id`);
ALTER TABLE `prescription_maker_medicine_diseases` ADD CONSTRAINT `prescript_medicine_id_33545f47_fk_prescription_maker_medicine_id` FOREIGN KEY (`medicine_id`) REFERENCES `prescription_maker_medicine` (`id`);
ALTER TABLE `prescription_maker_medicine_diseases` ADD CONSTRAINT `prescriptio_disease_id_30a1e9a9_fk_prescription_maker_disease_id` FOREIGN KEY (`disease_id`) REFERENCES `prescription_maker_disease` (`id`);
ALTER TABLE `prescription_maker_medicine_diseases` ADD CONSTRAINT `prescription_maker_medicine_diseases_medicine_id_07085034_uniq` UNIQUE (`medicine_id`, `disease_id`);
ALTER TABLE `prescription_maker_medicine_incompatible_with` ADD CONSTRAINT `pres_from_medicine_id_fd667e0f_fk_prescription_maker_medicine_id` FOREIGN KEY (`from_medicine_id`) REFERENCES `prescription_maker_medicine` (`id`);
ALTER TABLE `prescription_maker_medicine_incompatible_with` ADD CONSTRAINT `prescr_to_medicine_id_b8c6d3ef_fk_prescription_maker_medicine_id` FOREIGN KEY (`to_medicine_id`) REFERENCES `prescription_maker_medicine` (`id`);
ALTER TABLE `prescription_maker_medicine_incompatible_with` ADD CONSTRAINT `prescription_maker_medicine_incom_from_medicine_id_7fe2d826_uniq` UNIQUE (`from_medicine_id`, `to_medicine_id`);
ALTER TABLE `prescription_maker_prescription` ADD CONSTRAINT `p_doctor_id_id_6c78537e_fk_prescription_maker_doctor_user_ptr_id` FOREIGN KEY (`doctor_id_id`) REFERENCES `prescription_maker_doctor` (`user_ptr_id`);
ALTER TABLE `prescription_maker_prescription` ADD CONSTRAINT `prescrip_patient_id_id_99785fb9_fk_prescription_maker_patient_id` FOREIGN KEY (`patient_id_id`) REFERENCES `prescription_maker_patient` (`id`);
ALTER TABLE `prescription_maker_prescription_diseases` ADD CONSTRAINT `p_prescription_id_820e4d3c_fk_prescription_maker_prescription_id` FOREIGN KEY (`prescription_id`) REFERENCES `prescription_maker_prescription` (`id`);
ALTER TABLE `prescription_maker_prescription_diseases` ADD CONSTRAINT `prescriptio_disease_id_61ff8615_fk_prescription_maker_disease_id` FOREIGN KEY (`disease_id`) REFERENCES `prescription_maker_disease` (`id`);
ALTER TABLE `prescription_maker_prescription_diseases` ADD CONSTRAINT `prescription_maker_prescription_di_prescription_id_81515c0e_uniq` UNIQUE (`prescription_id`, `disease_id`);
ALTER TABLE `prescription_maker_prescription_medicine` ADD CONSTRAINT `p_prescription_id_9beb4e78_fk_prescription_maker_prescription_id` FOREIGN KEY (`prescription_id`) REFERENCES `prescription_maker_prescription` (`id`);
ALTER TABLE `prescription_maker_prescription_medicine` ADD CONSTRAINT `prescript_medicine_id_5cb6e316_fk_prescription_maker_medicine_id` FOREIGN KEY (`medicine_id`) REFERENCES `prescription_maker_medicine` (`id`);
ALTER TABLE `prescription_maker_prescription_medicine` ADD CONSTRAINT `prescription_maker_prescription_me_prescription_id_beeed66e_uniq` UNIQUE (`prescription_id`, `medicine_id`);
ALTER TABLE `prescription_maker_symptom_diseases` ADD CONSTRAINT `prescriptio_symptom_id_0c4c9ff6_fk_prescription_maker_symptom_id` FOREIGN KEY (`symptom_id`) REFERENCES `prescription_maker_symptom` (`id`);
ALTER TABLE `prescription_maker_symptom_diseases` ADD CONSTRAINT `prescriptio_disease_id_330b6617_fk_prescription_maker_disease_id` FOREIGN KEY (`disease_id`) REFERENCES `prescription_maker_disease` (`id`);
ALTER TABLE `prescription_maker_symptom_diseases` ADD CONSTRAINT `prescription_maker_symptom_diseases_symptom_id_e68f77fd_uniq` UNIQUE (`symptom_id`, `disease_id`);
ALTER TABLE `prescription_maker_symptom_relate_medicine` ADD CONSTRAINT `prescriptio_symptom_id_a6082d13_fk_prescription_maker_symptom_id` FOREIGN KEY (`symptom_id`) REFERENCES `prescription_maker_symptom` (`id`);
ALTER TABLE `prescription_maker_symptom_relate_medicine` ADD CONSTRAINT `prescript_medicine_id_78640609_fk_prescription_maker_medicine_id` FOREIGN KEY (`medicine_id`) REFERENCES `prescription_maker_medicine` (`id`);
ALTER TABLE `prescription_maker_symptom_relate_medicine` ADD CONSTRAINT `prescription_maker_symptom_relate_medic_symptom_id_508eee10_uniq` UNIQUE (`symptom_id`, `medicine_id`);
ALTER TABLE `prescription_maker_prescription_symptoms` ADD CONSTRAINT `p_prescription_id_28702288_fk_prescription_maker_prescription_id` FOREIGN KEY (`prescription_id`) REFERENCES `prescription_maker_prescription` (`id`);
ALTER TABLE `prescription_maker_prescription_symptoms` ADD CONSTRAINT `prescriptio_symptom_id_df48a0a7_fk_prescription_maker_symptom_id` FOREIGN KEY (`symptom_id`) REFERENCES `prescription_maker_symptom` (`id`);
ALTER TABLE `prescription_maker_prescription_symptoms` ADD CONSTRAINT `prescription_maker_prescription_sy_prescription_id_7c7647a1_uniq` UNIQUE (`prescription_id`, `symptom_id`);
ALTER TABLE `prescription_maker_patient_prescriptions` ADD CONSTRAINT `prescriptio_patient_id_d930d6c1_fk_prescription_maker_patient_id` FOREIGN KEY (`patient_id`) REFERENCES `prescription_maker_patient` (`id`);
ALTER TABLE `prescription_maker_patient_prescriptions` ADD CONSTRAINT `p_prescription_id_dec941f5_fk_prescription_maker_prescription_id` FOREIGN KEY (`prescription_id`) REFERENCES `prescription_maker_prescription` (`id`);
ALTER TABLE `prescription_maker_patient_prescriptions` ADD CONSTRAINT `prescription_maker_patient_prescription_patient_id_28a060a0_uniq` UNIQUE (`patient_id`, `prescription_id`);
ALTER TABLE `prescription_maker_medicine_symptoms` ADD CONSTRAINT `prescript_medicine_id_124d5336_fk_prescription_maker_medicine_id` FOREIGN KEY (`medicine_id`) REFERENCES `prescription_maker_medicine` (`id`);
ALTER TABLE `prescription_maker_medicine_symptoms` ADD CONSTRAINT `prescriptio_symptom_id_594c1dc7_fk_prescription_maker_symptom_id` FOREIGN KEY (`symptom_id`) REFERENCES `prescription_maker_symptom` (`id`);
ALTER TABLE `prescription_maker_medicine_symptoms` ADD CONSTRAINT `prescription_maker_medicine_symptoms_medicine_id_963f4379_uniq` UNIQUE (`medicine_id`, `symptom_id`);
ALTER TABLE `prescription_maker_doctor_prescriptions` ADD CONSTRAINT `pres_doctor_id_eeb815a6_fk_prescription_maker_doctor_user_ptr_id` FOREIGN KEY (`doctor_id`) REFERENCES `prescription_maker_doctor` (`user_ptr_id`);
ALTER TABLE `prescription_maker_doctor_prescriptions` ADD CONSTRAINT `p_prescription_id_c9db1b19_fk_prescription_maker_prescription_id` FOREIGN KEY (`prescription_id`) REFERENCES `prescription_maker_prescription` (`id`);
ALTER TABLE `prescription_maker_doctor_prescriptions` ADD CONSTRAINT `prescription_maker_doctor_prescriptions_doctor_id_843e8878_uniq` UNIQUE (`doctor_id`, `prescription_id`);
ALTER TABLE `prescription_maker_disease_relate_medicine` ADD CONSTRAINT `prescriptio_disease_id_950d3c3e_fk_prescription_maker_disease_id` FOREIGN KEY (`disease_id`) REFERENCES `prescription_maker_disease` (`id`);
ALTER TABLE `prescription_maker_disease_relate_medicine` ADD CONSTRAINT `prescript_medicine_id_21ce2b39_fk_prescription_maker_medicine_id` FOREIGN KEY (`medicine_id`) REFERENCES `prescription_maker_medicine` (`id`);
ALTER TABLE `prescription_maker_disease_relate_medicine` ADD CONSTRAINT `prescription_maker_disease_relate_medic_disease_id_aec30eb4_uniq` UNIQUE (`disease_id`, `medicine_id`);
ALTER TABLE `prescription_maker_disease_symptoms` ADD CONSTRAINT `prescriptio_disease_id_b3bdb4e4_fk_prescription_maker_disease_id` FOREIGN KEY (`disease_id`) REFERENCES `prescription_maker_disease` (`id`);
ALTER TABLE `prescription_maker_disease_symptoms` ADD CONSTRAINT `prescriptio_symptom_id_1452e029_fk_prescription_maker_symptom_id` FOREIGN KEY (`symptom_id`) REFERENCES `prescription_maker_symptom` (`id`);
ALTER TABLE `prescription_maker_disease_symptoms` ADD CONSTRAINT `prescription_maker_disease_symptoms_disease_id_0938d820_uniq` UNIQUE (`disease_id`, `symptom_id`);

COMMIT;
