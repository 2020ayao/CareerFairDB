/*--------- APPLICANT -------------
--  applicant(applicantID, name, contact_email, contact_phone, gpa, school, resume)*/
CREATE TABLE IF NOT EXISTS Applicant (
   applicantID int NOT NULL AUTO_INCREMENT,
   username varchar(30) NOT NULL,
   password varchar(61) NOT NULL,
   email varchar(50) NOT NULL,
   gpa float NOT NULL,
   PRIMARY KEY (applicantID)
   -- contact_phone int NOT NULL,
   -- gpa float NOT NULL,  
   -- major varchar(10) NOT NULL,
   -- school varchar(50) NOT NULL
); 

/*-- ------- COMPANY -------------

-- company(companyID, name)*/

CREATE TABLE IF NOT EXISTS Company (
   companyID int NOT NULL AUTO_INCREMENT, 
   name varchar(30) NOT NULL,
   password varchar(61) NOT NULL,
   email varchar(50) NOT NULL,
   PRIMARY KEY (companyID)
); 


/*--------- JOB -------------
-- job(jobID, title, industry, pay)*/

CREATE TABLE IF NOT EXISTS Job (
   jobID int NOT NULL AUTO_INCREMENT, 
   title varchar(30) NOT NULL,
   industry varchar(30) NOT NULL,
   pay int NOT NULL,
   company varchar(30) NOT NULL,
   PRIMARY KEY (jobID)
); 


/*--------- RECRUITER -------------
-- recruiter(recruiterID, companyID, name, contact_email, contact_phone)*/

CREATE TABLE IF NOT EXISTS Recruiter (
   recruiterID int NOT NULL AUTO_INCREMENT, 
   companyID int NOT NULL, 
   name varchar(30) NOT NULL,
   email varchar(50) NOT NULL,
   phone varchar(10) NOT NULL,
   password varchar(61) NOT NULL,
   FOREIGN KEY (companyID) REFERENCES Company(companyID),
   PRIMARY KEY (recruiterID)
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

   -- CONSTRAINT check_applicant_exists CHECK (Applies.applicantID = Hires.applicantID AND Applies.jobID = Hires.jobID)


CREATE TABLE IF NOT EXISTS Reaches_out (
   recruiterID int NOT NULL,
   applicantID int NOT NULL, 
   FOREIGN KEY (recruiterID) REFERENCES Recruiter(recruiterID),
   FOREIGN KEY (applicantID) REFERENCES Applicant(applicantID)
   );


CREATE TABLE IF NOT EXISTS Attends (
   applicantID int NOT NULL,
   careerFairID int NOT NULL, 
   FOREIGN KEY (applicantID) REFERENCES Applicant(applicantID),
   FOREIGN KEY (careerFairID) REFERENCES Career_fair(careerFairID)
   );
