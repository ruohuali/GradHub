## Gradhub ― An Efficient Search Tool for Graduate School Application 
*I. Brief Description*



GradHub is a project to help undergraduate students who are planning to apply for graduate school gather information about basic information of the schools, majors and programs around the globe. The users could look for programs by major or university. They could also search for professors for information about their affiliation and field of expertise. We also implemented a machine learning algorithm that accepts applicants’ academic records and gives feedback on the school they might be able to get in.   

*II. Usefulness*

During the normal application process of a graduate school applicant, he or she might spend a significant amount of time on mining the information he or she wants from the websites. These efforts may seem harmless from the first glimpse, thanks to the beautiful and structured official websites of each school. However, when the number of target schools starts to build up,   time spent on this “data mining” could easily become a rabbit hole. GradHub aims to save applicants’ time energy by directly providing information such as the recommended GRE bar and GPA bar of their target school, so that they could use their time on something more important. Moreover, GradHub could perform a trivial prediction of the applicant’s results using our algorithm, which is trained based on real data from past applicants.   

*III. Data in the Database*

The data in our database consists of multiple universities’ information relating to admission resources. All the data in our design are String and INT data types. The data type INT are mainly used as indexes and numerical values such as GPA and GRE score. The data type String are mainly used as names and URLs. 









*IV. ER Diagram and Schema*

ER Diagram: 

Schema:

`CREATE TABLE University{`

`UniversityName VARCHAR(255) NOT NULL,`

`PRIMARY KEY(UniversityName)`

`}`

`CREATE TABLE College{`

`CollegeName VARCHAR(255) NOT NULL,`

`UniversityName VARCHAR(255) NOT NULL,`

`PRIMARY KEY(CollegeName, UniversityName),`

`Foreign Key(UniversityName) References University On Delete Cascade On Update Cascade`

`}`

`CREATE TABLE Program{`
`ProgramName VARCHAR(255) NOT NULL,`
`MajorName VARCHAR(255) NOT NULL,`
`URL VARCHAR(255) NOT NULL,`
`GPAbar INT,`
`GREbar INT,`
`FieldName VARCHAR(255),`
`PRIMARY KEY(URL), `
`}`

`CREATE TABLE Master{`
`MasterName VARCHAR(255) NOT NULL,`
`FundingOption BOOLEAN,`
`URL VARCHAR(255) NOT NULL,`
`ProfId INT,`
`PRIMARY KEY(URL),`
`FOREIGN KEY (URL) REFERENCES Program,`
`FOREIGN KEY (ProfId) REFERENCES Professor`
`}`

`CREATE TABLE PhD{`
`PhDName VARCHAR(255) NOT NULL,`
`FundingOption BOOLEAN,`
`URL VARCHAR(255) NOT NULL,`
`ProfId INT,`
`PRIMARY KEY(URL),`
`FOREIGN KEY (URL) REFERENCES Program,`
`FOREIGN KEY (ProfId) REFERENCES Professor`
`}`

`CREATE TABLE Professor{`
`ProfId INT,`
`ProfName VARCHAR(255) NOT NULL,`
`FieldOfExpertise VARCHAR(255),`
`PRIMARY KEY(ProfId),`
`}`


*V. Method for collecting Data*

The information about school is retrieved from the official websites and inserted by the superusers of our website. The information includes faulty names, focused academic areas and URLs. The trained data is inserted by users who are willing to contribute their academic profiles and results. Part of it also comes from GradCafe, a platform in which graduate applicants share their profile and results. That portion of data was inserted by superusers of the website as well. We did not use web crawlers, so the data are all inserted by users and super users of the website.

*VI. Functionality*

A brief description of the functionality of our project would be twofold. First, it presents a platform for contributors to share and query various information about universities and their graduate programs. Second, it enables users, mostly prospective students, to predict which schools they are qualified to apply for and have a great chance of being admitted. 

*VII. Explanation of One Example Function*

One exemplary function among our numerous functions is the professor search function. With this function, students can search professors within our database by their expertise or names. In this way students are enabled to learn the professional resources a university possesses which will aid them to choose the school they are fit to apply for or enter the field they are interested in.

*VIII. SQL snippet*

*IX. Data Flow*



Superuser DB manipulation(i.e Select)

Predict:

Step 1 Enter Personal Specs

Step 2 Prediction Displayed

Search For a Prof.:

Search For a Program:

Contribute:

*X. Advanced Function*

Our advanced functions mainly involves machine learning based inference, which takes user-inputted features regarding their application and qualification, (i.e. GRE scores and # of publications) and try to predict the schools they are mostly likely to be admitted to. The complexity of this function lies in the complicated preprocessing and clustering and classification algorithms. We vectorize the input data both from our database and user input based on prepared ranking for universities. Upon finishing this step, we train two models ― a clustering model (kmeans) and a classification model (decision tree) on our data. Armed with the tools, the user input data is then sent to both models for prediction, resulting in two individual results, which will then be matched for corresponding schools and returned back to the user as the output. 


*XI. Technical Challenge*

We’ve encountered several technical challenges along the way, the major of which being the machine learning algorithm and preprocess of data for our algorithm. Initially we decided to use the decision tree algorithm for our inferring. However, the decision tree algorithm is too trivial and does not always bring the most accurate result. Therefore we decided to use both decision tree and K-means to infer and come up with a broader range of possible results. Since our algorithm is not aiming to perform a super accurate result as sometimes the results of graduate school applications lack interpretability to say the least(let’s admit it, a large factor of your application result will depend on some subjective ones such as recommendation letters or pure luck...), we pretty much aimed for a more comprehensive perspective for the prediction. 

Another technical challenge we met is the preprocessing of the data. We used python to implement the machine learning algorithm. So we decided to input all the inserted data into txt files named samples.txt and input.txt first and use python to read all the data and parse them. We also implemented a dictionary that maps school names to a number ranging from 1 to 5 that reflects its general reputation. In this way, we could also easily convert the numerical result back to strings that could be read by the user as well.       

*XII. Do we follow initial plan*

There are some differences between the final project we deliver and the prototype we had in mind when we were drafting it. One main difference is how the database is structured. The cause for that is as we are more hands-on with the real-world data and applications, we gradually came to the realization that some design we had was either redundant or not the most efficient way of representing the information. Another difference is that as we have multiple models for prediction, we planned to apply a boosting algorithm on them to output a joint single result, but after deliberate consideration we realized that this choice would increase the implementing difficulty dramatically and result in decreased robustness and interpretability of the model. As a result this was abandoned later when we code the system.


*XIII. Division of Labor*

Kehang Chang is in charge of creating the website skeleton, website appearance, website UI.

Ruohua Li and Jialiang Zhang are in charge of advanced function and the interfacing between website and database.

Zhaoxu Deng is in charge of creating data tables and collecting data.

In general, everyone works collaboratively and responsively together.



