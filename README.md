# Basic Instruction & guidelines to smoothly run the project

1. Download or clone the git repository in your local machine & run `php artisan serve` to start the server. This will redirect the base(`/`) route to the registration page (`/user/register`) for user registration.

2. There are 3 Databse Seeder for 3 tables: `users`, `vaccine_centers` & `vaccine_slots`. `users` & `vaccine_slots` both are seeded with 50 entries while the `vaccine_centers` is seeded with 20 entries. If you don't want to seed or want selective seeding, please feel free to tinker the `DatabaseSeeder.php` file and comment/uncomment the seeders. All data is stored in the `database.sqlite` file.

3. Once the User is registered, you can see and search the list of users in the `/user/index` route.

4. There are 2 Jobs dispatched in 2 Custom Commands run with Scheduler in the `routes/console.php` file : `AssignVaccineSlotJob` + `AssignVaccineSlotCommand` to assign vaccine slots to users periodically (every 3 hours on weekdays) & `SendMailNotificationToScheduledUserJob` + `SendMailNotificationToScheduledUserCommand` to send mail notifications to users the night before their vaccination date. If you want to immediately test the schedulers, please feel free to change the periods into minutes or seconds, or directly run the `php artisan app:assign-vaccine-slot` to assign vaccine slots or `php artisan app:send-mail-notification-to-scheduled-user` to send mail notifications to users.

# Notes answers Based on the note section of the coding test

1. I tried to ensure that by making `nid` and `email` columns unique/indexed so that no 2 users have the same National ID or Email.

2. Seeded with 20 Vaccine Centers

3. Did that

4. I tried to restrict user registration based on whether a vaccine center is available or not. In terms of the search functionality, I tried to select only specific columns and paginate 10 records per page load. For the 2 scheduled tasks, I tried to optimize query results by querying in chunks and bulk updating chunk results by Id's for chunked `users` and `vaccine_slots`. If I had more time, I'd probably try to lazy load or eager load data(if possible in that context) or try to reduce the number of raw queries executed to reduce database network latency.

5. If an additional requirement of sending SMS notifications is given, I'd create another task scheduler to periodically run the task as per requirements. If there're tens of thousands of users that are required to send SMS notification at a time, I'd probably try set a limit (if possible) or respond to the user for a waiting time. 
