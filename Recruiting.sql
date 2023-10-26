--------- APPLICANT -------------
--  applicant(applicantID, name, contact_email, contact_phone, gpa, school, resume)
CREATE TABLE IF NOT EXISTS Applicant (
   applicantID int NOT NULL PRIMARY KEY, 
   name varchar(30) NOT NULL,
   contact_email varchar(50) NOT NULL,
   contact_phone int NOT NULL,
   gpa float NOT NULL,  
   major varchar(10) NOT NULL,
   school varchar(50) NOT NULL,
); 


--------- COMPANY -------------

-- company(companyID, name)

CREATE TABLE IF NOT EXISTS Company (
   companyID ID int NOT NULL PRIMARY KEY, 
   name varchar(30) NOT NULL,
); 


--------- JOB -------------
-- job(jobID, title, industry, pay)

CREATE TABLE IF NOT EXISTS Job (
   jobID int NOT NULL PRIMARY KEY, 
   title varchar(30) NOT NULL,
   industry(30) NOT NULL,
   pay int NOT NULL,
); 


--------- RECRUITER -------------
-- recruiter(recruiterID, companyID, name, contact_email, contact_phone)

CREATE TABLE IF NOT EXISTS Recruiter (
   recruiterID int NOT NULL PRIMARY KEY, 
   companyID int NOT NULL, 
   name varchar(30) NOT NULL,
   contact_email varchar(50) NOT NULL,
   contact_phone int NOT NULL,
   FOREIGN KEY (companyID) REFERENCES Company(companyID)
); 
