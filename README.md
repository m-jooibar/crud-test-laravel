#Please read me first

Thanks for taking the time to review my code. I pretty much did most of what you asked. But I didn't run this project with CQRS,i just implemented that by Event Sourcing. Because I had no experience in DDD and CQRS. In last three days, I have read many articles about CQRS and DDD and I want to thank you for this challenge and this exam.i know you are a high level company and of course it is my pleasure to be your colleague in future.
I had a hard week and I didn't have enough time, and I spent 4 more hours in traffic every day. Of course, if I had more time, I could give you a more complete project.
I learned a lot of thing by your challenge. I love any challenge.


#just please  in this project comment CustomerStoreRequest.php file in app/virtual directory wheb you want to run the test.i don't know why i got errors when this file was uncomment and i tried run tests.

-----------------------------------------------------


# Laravel CRUD Test Assignment

Please read each note very carefully!
Feel free to add/change project structure to a clean architecture to your view.

Create a simple CRUD application with Laravel that implements the below model:
```
Customer {
	Firstname
	Lastname
	DateOfBirth
	PhoneNumber
	Email
	BankAccountNumber
}
```
## Practices and patterns (Must):

- [TDD](https://en.wikipedia.org/wiki/Test-driven_development)
- [DDD](https://en.wikipedia.org/wiki/Domain-driven_design)
- [BDD](https://en.wikipedia.org/wiki/Behavior-driven_development)
- [Clean architecture](https://github.com/jasontaylordev/CleanArchitecture)
- [CQRS](https://en.wikipedia.org/wiki/Command%E2%80%93query_separation#Command_query_responsibility_separation) pattern ([Event sourcing](https://en.wikipedia.org/wiki/Domain-driven_design#Event_sourcing)).
- Clean git commits that shows your work progress.
- Use PHP 8.2.x only

### Validations (Must)

- During Create; validate the phone number to be a valid *mobile* number only (You can use [Google LibPhoneNumber](https://github.com/google/libphonenumber) to validate number at the backend).

- A Valid email and a valid bank account number must be checked before submitting the form.

- Customers must be unique in database: By `Firstname`, `Lastname` and `DateOfBirth`.

- Email must be unique in the database.

### Storage (Must)

- Store the phone number in a database with minimized space storage (choose `varchar`/`string`, or `bigInt unsigned` whichever store less space).

### Delivery (Must)
- Please clone this repository in a new github repository in private mode and share with ID: `mason-chase` in private mode on github.com, make sure you do not erase my commits and then create a [pull request](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/about-pull-requests) (code review).
- Docker-compose project that loads database service automatically with `docker-compose up`

## Presentation (Must)
- Web UI.
- Swagger

