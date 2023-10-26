/*--------- APPLICANT -------------
--  applicant(applicantID, name, contact_email, contact_phone, gpa, school, resume)*/
CREATE TABLE IF NOT EXISTS Applicant (
   applicantID int NOT NULL PRIMARY KEY, 
   name varchar(30) NOT NULL,
   contact_email varchar(50) NOT NULL,
   contact_phone int NOT NULL,
   gpa float NOT NULL,  
   major varchar(10) NOT NULL,
   school varchar(50) NOT NULL
); 

/*-- ------- COMPANY -------------

-- company(companyID, name)*/

CREATE TABLE IF NOT EXISTS Company (
   companyID int NOT NULL PRIMARY KEY, 
   name varchar(30) NOT NULL
); 


/*--------- JOB -------------
-- job(jobID, title, industry, pay)*/

CREATE TABLE IF NOT EXISTS Job (
   jobID int NOT NULL PRIMARY KEY, 
   title varchar(30) NOT NULL,
   industry varchar(30) NOT NULL,
   pay int NOT NULL
); 


/*--------- RECRUITER -------------
-- recruiter(recruiterID, companyID, name, contact_email, contact_phone)*/

CREATE TABLE IF NOT EXISTS Recruiter (
   recruiterID int NOT NULL PRIMARY KEY, 
   companyID int NOT NULL, 
   name varchar(30) NOT NULL,
   contact_email varchar(50) NOT NULL,
   contact_phone varchar(10) NOT NULL,
   FOREIGN KEY (companyID) REFERENCES Company(companyID)
); 

CREATE TABLE IF NOT EXISTS Career_fair (
   careerFairID int NOT NULL PRIMARY KEY, 
   industry varchar(30) NOT NULL,
   date varchar(30) NOT NULL,
   Location varchar(30) NOT NULL
); 


CREATE TABLE IF NOT EXISTS Applies (
   applicantID int NOT NULL,
   jobID int NOT NULL, 
   FOREIGN KEY (applicantID) REFERENCES Applicant(applicantID),
   FOREIGN KEY (jobID) REFERENCES Job(jobID)
   );

CREATE TABLE IF NOT EXISTS Posts (
   companyID int NOT NULL,
   jobID int NOT NULL, 
   FOREIGN KEY (companyID) REFERENCES Company(companyID),
   FOREIGN KEY (jobID) REFERENCES Job(jobID)
   ); 


CREATE TABLE IF NOT EXISTS Hires (
   companyID int NOT NULL,
   applicantID int NOT NULL, 
   FOREIGN KEY (companyID) REFERENCES Company(companyID),
   FOREIGN KEY (applicantID) REFERENCES Applicant(applicantID)
   );


CREATE TABLE IF NOT EXISTS Reaches_out (
   recruiterID int NOT NULL,
   applicantID int NOT NULL, 
   FOREIGN KEY (recruiterID) REFERENCES Recruiter(recruiterID),
   FOREIGN KEY (applicantID) REFERENCES Applicant(applicantID)
   );


CREATE TABLE IF NOT EXISTS Attends (
   applicantID int NOT NULL,
   jobID int NOT NULL, 
   recruiterID int NOT NULL, 
   FOREIGN KEY (recruiterID) REFERENCES Recruiter(recruiterID),
   FOREIGN KEY (applicantID) REFERENCES Applicant(applicantID),
   FOREIGN KEY (jobID) REFERENCES Job(jobID)
   );
