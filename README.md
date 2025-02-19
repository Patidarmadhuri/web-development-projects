# Spring REST API for Course Management

## Description
This project is a Spring Boot-based REST API for managing courses. It provides endpoints to perform CRUD (Create, Read, Update, Delete) operations on courses using Spring Boot, JPA, and an H2 or MySQL database.

## Features
- Fetch all courses
- Get details of a specific course
- Add a new course
- Update an existing course
- Delete a course

## Technologies Used
- Java  
- Spring Boot  
- Spring Data JPA  
- Hibernate  
- REST API  
- MySQL / H2 Database  
- Maven  

## Installation and Setup
1. Clone the repository:  
   ```sh
   git clone <repository-url>
   cd springrest
Ensure you have Java 17+ and Maven installed.
Update database configuration in application.properties if necessary.
Build and run the application:
sh
Copy
Edit
mvn spring-boot:run
Access the API at:
Home Page: http://localhost:8080/home
Courses API: http://localhost:8080/courses
API Endpoints
Method	Endpoint	Description
GET	/courses	Get all courses
GET	/courses/{courseId}	Get a course by ID
POST	/courses	Add a new course
PUT	/courses	Update an existing course
DELETE	/courses/{courseId}	Delete a course
Contributing
Pull requests are welcome. Please ensure your code follows best practices and is well-documented.

License
This project is open-source and available under the MIT License.

