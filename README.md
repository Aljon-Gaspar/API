# API 
This API allows you the insert, read, update, and delete names in a database.

## API Description
This PHP code defines a basic API using the Slim framework. The API provides endpoints for performing CRUD (Create, Read, Update, Delete) for various operations related to names in a MySQL database. Ensure that you have a database named "demo" created and properly configured to support the operations defined in the code.

## API Endpoints
This API consist of four(4) endpoints:

1. postName:    This endpoint allows user to add a new name to the database. The code parses the incoming JSON data (with 'fname' and 'lname') and inserts it into the MySQL database. It returns a JSON response indicating the success or failure of the insertion.

2. printName:   This endpoint retrieves and returns all the names stored in the database. It connects to the MySQL database, fetches the data, and responds with a JSON object containing the list of names. If there are no records, it returns a success message with no data.

3. updateName:  This endpoint enables users to update a name in the database by specifying the 'id', 'fname', and 'lname' in the request. It processes the update operation and returns a JSON response indicating whether the update was successful or if there were any errors.

4. deleteName:  This endpoint allows user to delete a name by providing its 'id'. The code prepares a SQL statement to delete the specified record from the database and returns a JSON response indicating the success or failure of the deletion.

## Request Payloads
1. postName
   {
  "lname":"nico",
   "fname":"robin"
   }

2. printName
   - This endpoint doesn't require a request payload as it will prompts the response payload once you've accessed the endpoint
     (http://localhost/api/public/printName).
  
3. updateName
   {
   "id":7,
   "lname":"nico",
   "fname":"robin"
   }

4. deleteName
   {
   "id":1
   }

## Response Payloads
1. postName
   {
   "status":"success","data":null
   }

2. printName
   {
   "status":"success","data":["lname":"hortizuela","fname":"manny","lname":"licayan","fname":"arnold"]
   }

3. updateName
   {
   "status":"success","data":null
   }

5. deleteName
   {
   "status":"success","data":null
   }

## Usage
In order to run the API, follow this following steps:

Step 1: Launch XAMPP and/or SQLyog.
Step 2: Create a database named 'demo' and a table called 'names' with columns 'id,' 'lname,' and 'fname.' Make sure to set 'id' as the primary key with auto-increment. 
Step 3: Place the 'api' folder in the following directory: C://xampp/htdocs.
Step 4: Install and open Postman, a tool for testing APIs.
Step 5: Choose the appropriate HTTP method, whether it's GET or POST.
Step 6: Enter the following URLs for the respective endpoints:
          1. 'postName' endpoint: http://localhost/api/public/postName
          2. 'printName' endpoint: http://localhost/api/public/printName
          3. 'updateName' endpoint: http://localhost/api/public/updateName
          4. 'deleteName' endpoint: http://localhost/api/public/deleteName
Step 7: In Postman, navigate to the 'Body' tab and input the JSON request payload as needed for your API requests.

## License
No license has been used in this API.

## Contributors
Mr. Manny R. Hortizuela

## Contact
aljongaspar143@gmail.com
