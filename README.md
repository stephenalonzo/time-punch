# Oras

A time punch portal to manage employee timesheets & time-off requests.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

What things you need to install the software and how to install them

```
XAMPP
```

### Installing

A step by step series of examples that tell you how to get a development env running

###### Cloning the repo

```
1) To clone the project, we would FIRST need to download a Git client to access & clone the repo to our local machine.
* For this tutorial, I will be using the GitHub Desktop client to clone this project.

2) Once you have finished downloading a Git client and logging in, go to the repo and click on the green button that says "<> Code".
* This will give you options for you in which way you want to clone the project: HTTPS, SSH or GitHub CLI. In this case, I will use
the HTTPS method and copy the link.

3) In the GitHub Desktop client, I will click on "File" that is located on the top left corner of the client and select "URL". Then,
I will paste the copied HTTPS link and select a Local path to clone the project. Once I select the local path, I will click "Clone".
* The local path is user preference, but since we have downloaded XAMPP together, I will choose the local path that leads
to xampp/htdocs.

After following these steps, you will have access to the project locally.
```

###### Utilizing the project with test data

```
1) To utilize the project, I have included an SQL file with some data for the project for your testing purposes.
* We will now walk through the XAMPP application to run the Oras application locally and setup a database.

2) Open up XAMPP and you will see a couple buttons, but usually, you would only need to click on the Start & Admin buttons
for the Apache & MySQL modules. So let us click the Start buttons for Apache & MySQL.
* We want to make sure that the modules are highlighted green, to indicate that it is successfully running.

3) Once the Apache & MySQL modules are running, you would want to click the Admin buttons for the Apache module. Then, it
will open up your browser with a "Welcome to XAMPP for Windows 8.0.28".
* We want to also do the same for the MySQL module.

4) After clicking the Admin button for the MySQL module, a phpMyAdmin should pop up on your browser.
* Now we want to upload the SQL file that has our testing data on it.

5) Once the page loads, we want to click on the "Import" button on the top of the page. It will then direct us to a page
to import the SQL file. So, let us click the "Choose file" button and we want to select the oras_test_data.sql file. Then,
let us scroll down to the bottom of the page and select import.

After following these steps, you should now have a database called "oras_database".
```
