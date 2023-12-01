
INSERT INTO Applicant(username, password, email) VALUES ('Jonathan Guo', 'password', 'test@gmail.com');
INSERT INTO Applicant(username, password, email) VALUES ('Adam Yao','password', 'test1@gmail.com');
INSERT INTO Applicant(username, password, email)  VALUES ('Yumi Kim', 'password', 'test2@gmail.com');
INSERT INTO Applicant(username, password, email) VALUES ('Greg Cho', 'password', 'test3@gmail.com');


INSERT INTO Company (name) VALUES ('Google');
INSERT INTO Company (name) VALUES ('Microsoft');
INSERT INTO Company (name) VALUES ('Capital One');
INSERT INTO Company (name) VALUES ('Captech');

INSERT INTO Job (title, industry, pay, company) VALUES ('Software Engineer I', 'Engineering', 160000, 'Google');
INSERT INTO Job (title, industry, pay, company) VALUES ('Software Engineer II', 'Engineering', 175000, 'Google');
INSERT INTO Job (title, industry, pay, company) VALUES ('New Graduate Business Analyst', 'Engineering', 400000, 'Deloitte');
INSERT INTO Job (title, industry, pay, company) VALUES ('Project Manager I', 'Engineering', 120000, 'Microsoft');
INSERT INTO Job (title, industry, pay, company) VALUES ('Associate Consultant', 'Consulting', 75000, 'EY');

INSERT INTO Recruiter (companyID, name, contact_email, contact_phone) VALUES (1, 'Lauren Cox', 'laurencox@capitalone.com', '7034567891');
INSERT INTO Recruiter (companyID, name, contact_email, contact_phone) VALUES (2, 'Morgan Quencia', 'morganquencia@bloomberg.com', '5713466738');
INSERT INTO Recruiter (companyID, name, contact_email, contact_phone) VALUES (3, 'Kelly Clarkson', 'kellyclarkson@google.com', '7036567383');

INSERT INTO Career_fair VALUES (1 ,'Engineering', '9/14/2023', 'Newcomb Hall');
INSERT INTO Career_fair VALUES (2 ,'All Industries', '10/25/2023', 'Newcomb Hall');


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

INSERT INTO Attends VALUES (1 ,1, 2);
INSERT INTO Attends VALUES (2 ,1, 1);



