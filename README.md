[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](./LICENSE) ![PHP version](https://img.shields.io/badge/php-%3E%3D5.6-blue) ![Awesome](https://camo.githubusercontent.com/fef0a78bf2b1b477ba227914e3eff273d9b9713d/68747470733a2f2f696d672e736869656c64732e696f2f62616467652f617765736f6d652533462d796573212d627269676874677265656e2e737667)

## Description

Taskbook application.

Tasks consist of:
- username;
- e-mail;
- text;


Start page is a task list where user can sort data by user name, email and status. Each unauthorized visitor can see the task list and create the new one. 
Administrator can edit the task text and mark it as completed. Completed tasks are marked correspondingly.

The application is using pure PHP and implements the MVC model. Any PHP frameworks were not used. This application has a simple architecture and a minimal amount of code.	

## Deployment

- Clone the code from this repo.
- Create ```db.php``` in the project root directory from ```db.php.sample```
- Change database connection credentials in db.php to your own
- Import table from migrations/tasks.sql to your database.

### License

Application is [MIT licensed](./LICENSE).