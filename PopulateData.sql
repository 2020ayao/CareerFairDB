
INSERT INTO Applicant(username, password, email, gpa) VALUES ('Jonathan Guo', 'password', 'test@gmail.com', 4.0);
INSERT INTO Applicant(username, password, email, gpa) VALUES ('Adam Yao','password', 'test1@gmail.com', 3.9);
INSERT INTO Applicant(username, password, email, gpa)  VALUES ('Yumi Kim', 'password', 'test2@gmail.com', 3.8);
INSERT INTO Applicant(username, password, email, gpa) VALUES ('Greg Cho', 'password', 'test3@gmail.com', 3.7);


INSERT INTO Company (name, password, email) VALUES ('Google', 'password', '123@gmail.com');
INSERT INTO Company (name, password, email) VALUES ('Microsoft', 'password', '223@gmail.com');
INSERT INTO Company (name, password, email) VALUES ('Capital One', 'password', '323@gmail.com');
INSERT INTO Company (name, password, email) VALUES ('Captech', 'password', '423@gmail.com');

INSERT INTO Job (title, industry, pay, company, companyID) VALUES ('Software Engineer I', 'Engineering', 160000, 'Google', 1);
INSERT INTO Job (title, industry, pay, company, companyID) VALUES ('Software Engineer II', 'Engineering', 175000, 'Google', 1);
INSERT INTO Job (title, industry, pay, company, companyID) VALUES ('New Graduate Business Analyst', 'Engineering', 400000, 'Deloitte', 2);
INSERT INTO Job (title, industry, pay, company, companyID) VALUES ('Project Manager I', 'Engineering', 120000, 'Microsoft', 3);
INSERT INTO Job (title, industry, pay, company, companyID) VALUES ('Associate Consultant', 'Consulting', 75000, 'EY', 4);

INSERT INTO Recruiter (companyID, name, email, phone, password) VALUES (1, 'Lauren Cox', 'laurencox@capitalone.com', '7034567891', "password");
INSERT INTO Recruiter (companyID, name, email, phone, password) VALUES (2, 'Morgan Quencia', 'morganquencia@bloomberg.com', '5713466738', "password");
INSERT INTO Recruiter (companyID, name, email, phone, password) VALUES (3, 'Kelly Clarkson', 'kellyclarkson@google.com', '7036567383', "password");

INSERT INTO Career_fair(industry, date, Location) VALUES ('Engineering', '9/14/2023', 'Newcomb Hall');
INSERT INTO Career_fair(industry, date, Location) VALUES ('All Industries', '10/25/2023', 'Newcomb Hall');


INSERT INTO Applies VALUES (4 ,1);
INSERT INTO Applies VALUES (4 ,2);
INSERT INTO Applies VALUES (3 ,2);
INSERT INTO Applies VALUES (3 ,4);
INSERT INTO Applies VALUES (1 ,1);
INSERT INTO Applies VALUES (2 ,5);

INSERT INTO Posts VALUES (2 ,3);
INSERT INTO Posts VALUES (3 ,5);
INSERT INTO Posts VALUES (1 ,4);
INSERT INTO Posts VALUES (4 ,3);
INSERT INTO Posts VALUES (4 ,1);


INSERT INTO Hires VALUES (1 ,3);
INSERT INTO Hires VALUES (2 ,2);

INSERT INTO Reaches_out VALUES (1 ,3);
INSERT INTO Reaches_out VALUES (2 ,3);

INSERT INTO Attends VALUES (1 ,1);
INSERT INTO Attends VALUES (2 ,1);



