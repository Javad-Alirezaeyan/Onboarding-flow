
<h2>Onboarding Flow</h2>

A simple application to analyze the behavior of users when they have to complete a series of forms to complete their accounts.


<h3>Introduction</h3>
   This application can use different resources as a data source such as files and databases. The solution is maintainable and you can add any convenient format. Now, the application support database and CSV files as data source.
 
   The application creates some charts to analyze data such as the Retention curve and PieChart. Also, it finds the steps 
   that the users usually are stuck there.
   
   
 <hr/>
<h4> Technical</h4>  
Used techniques are presented in the following:

Language:
<ul>
<li>PHP 7.2.*</li>
<li>CSS3</li>
<li>JS</li>
<li>HTML5</li>
</ul>

Framework and Library:
<ul>
<li>Laravel version 6</li>
<li>Vuejs</li>
<li>Jquery</li>
</ul>

tools:
<ul>
<li>Compose</li>
<li>Git</li>
</ul>

Other:
<ul>
<li>PHPUnit</li>
<li>Object orinted</li>
<li>SOLID</li>
<li>Cache</li>
</ul>

<hr />

<h3>description</h3>

As mentioned above, the application uses verity of programming languages, frameworks, and tools, so it is 
explained why they have been chosen in the following:

<h4>Laravel and Vuejs</h4>

 Laravel is one of the popular frameworks among PHP developers because it provides tones of services and facilities to make reliable projects. As well Vue.js is an open-source JavaScript framework for building user interfaces that helps you to create a strong application in front-end. These two frameworks are matching each other well.
 
<h4>SOLID</h4>

The service uses a few different external services to send emails, so there has implemented a structure based on object-oriented 
and SOLID. These files are available in the path: /app/classes/onboarding.

<h4>PHPUnit</h4>

To test API in the back-end, the service uses PHPUnit. The related files are available in the path /test. 

###datasource
The application can use different types of data sources such as files and databases. To do that a variable has been set in the .env file, it is called DATA_DRIVER.
The application decides from where extract the data. The default value is "csv", but if you use a database as a 
data source, you can change it to "database" before installing or running the project

 <hr/>
 
<h3>install</h3> 

 Prerequisites:
  <ul>
    <li>PHP 7.2</li>
    <li>NPM</li>
    <li>Nginx or Apache2</li>
    <li>Mysql (If you want to use database as a data source)</li>
  </ul>
 
 1. Clone the source code from Github repository. To do that open terminal and type the following command:
  
  
 
    git clone https://github.com/Javad-Alirezaeyan/Onboarding-flow.git
    
          
 2. Then, open the Onboarding-flow directory with command: 
 

     cd Onboarding-flow 
     
     
  
  and run the following commands to install the project 
    
  <code>
        php artisan make:install
  </code>
  
  This command checks the php version. It must be larger equal than  7.2. Also, 
  If the DATA_DRIVER has set to 'database', it checks your connection db and suggest you to insert fake data into database
  3. Finally, the application is acceccable on <your-ip>:8080 or 
  <a target="_blank" href="http://127.0.0.1:8080">127.0.0.1:8080</a>
  
  
  <div style="color:red">You can run project by this command as well
    
    
      php artisan serve
  
   You must run the following command  installing node_modules, if you want to modify the vuejs component 
     
       
      npm install
       
   </div>
  
   ![alt text](https://github.com/Javad-Alirezaeyan/Onboarding-flow/blob/master/screenshots/install.png)
   

###screenshots
   ![alt text](https://github.com/Javad-Alirezaeyan/Onboarding-flow/blob/master/screenshots/upload1.png)
   ![alt text](https://github.com/Javad-Alirezaeyan/Onboarding-flow/blob/master/screenshots/upload2.png)
   ![alt text](https://github.com/Javad-Alirezaeyan/Onboarding-flow/blob/master/screenshots/RetentionWeekly.png)
   ![alt text](https://github.com/Javad-Alirezaeyan/Onboarding-flow/blob/master/screenshots/RetentionMonthly.png)
   ![alt text](https://github.com/Javad-Alirezaeyan/Onboarding-flow/blob/master/screenshots/RetentionDaily.png)
   ![alt text](https://github.com/Javad-Alirezaeyan/Onboarding-flow/blob/master/screenshots/Analysis.png)
   ![alt text](https://github.com/Javad-Alirezaeyan/Onboarding-flow/blob/master/screenshots/Piechart.png)
   