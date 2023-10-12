<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../src/vendor/autoload.php';
$app = new \Slim\App;

//ENDPOINT GET GREETING
$app->get('/getName/{fname}/{lname}', function (Request $request, Response $response, array $args) {
    $name = $args['fname'] . " " . $args['lname'];
    $response->getBody()->write("Hello, $name");
    return $response;

});

//ENDPOINT POST GREETING (http://localhost/api/public/postName)
// Define the API endpoint for inserting a name to the database
$app->post('/postName', function (Request $request, Response $response, array $args) {
    $data = json_decode($request->getBody());
    $fname = $data->fname;
    $lname = $data->lname;

    //Database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "demo";
    try {
        $conn = new PDO(
            "mysql:host=$servername;dbname=$dbname",

            $username,
            $password
        );

        //Set the PDO error mode to exception
        $conn->setAttribute(
            PDO::ATTR_ERRMODE,

            PDO::ERRMODE_EXCEPTION
        );

        $sql = "INSERT INTO names (fname, lname) VALUES ('" . $fname . "','" . $lname . "')";

        //Use exec() because no results are returned
        $conn->exec($sql);
        $response->getBody()->write(json_encode(array("status" => "success", "data" => null)));

    } catch (PDOException $e) {
        $response->getBody()->write(
            json_encode(
                array(
                    "status" => "error",
                    "message" => $e->getMessage()
                )
            )
        );
    }
    $conn = null;
    return $response;
});

//ENDPOINT PRINT GREETING (http://localhost/api/public/printName)
// Define the API endpoint for displaying/prompting all names from database
$app->post('/printName', function (Request $request, Response $response, array $args) {

    //Database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "demo";

    //Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM names";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            array_push(
                $data,
                array(
                    "lname" => $row["lname"],
                    "fname" => $row["fname"]
                )
            );
        }
        $data_body = array("status" => "success", "data" => $data);
        $response->getBody()->write(json_encode($data_body));
    } else {
        $response = $response->getBody()->write(json_encode(["status" => "success", "data" => null]));
    }
    $conn->close();
    return $response;
});

//ENDPOINT UPDATE (http://localhost/api/public/updateName)
//Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";

//Create a database connection
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Define the API endpoint for updating a name by ID
$app->post('/updateName', function (Request $request, Response $response) use ($pdo) {

    // Get the JSON content from the request body
    $json = $request->getBody()->getContents();
    $data = json_decode($json, true); // Parse JSON into an associative array

    if (isset($data['id']) && isset($data['lname']) && isset($data['fname'])) {
        $id = $data['id'];
        $lname = $data['lname'];
        $fname = $data['fname'];

        // Update the data in the database
        $stmt = $pdo->prepare("UPDATE names SET lname = ?, fname = ? WHERE id = ?");
        $stmt->execute([$lname, $fname, $id]);

        // Check if the update was successful
        if ($stmt->rowCount() > 0) {
            $response = $response->getBody()->write(json_encode(["status" => "success", "data" => null]));//Update was successful
        } else {
            $response = $response->getBody()->write(json_encode(["status" => "error", "message" => "No record found for the given ID."]));
        }
    } else {
        $response = $response->getBody()->write(json_encode(["status" => "error", "message" => "Invalid JSON payload format."]));
    }

    return $response;
});

//ENDPOINT DELETE (http://localhost/api/public/deleteName)
//Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";

// Create a PDO instance for database connection
$db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// Define the API endpoint for deleting a name by ID
$app->post('/deleteName', function (Request $request, Response $response) use ($db) {
    // Get the JSON payload
    $jsonPayload = json_decode($request->getBody());

    // Check if 'id' is provided in the payload
    if (!isset($jsonPayload->id)) {
        return $response->withStatus(400)->withJson(['status' => 'error', 'message' => 'Missing ID']);
    }

    $id = $jsonPayload->id;

    // Prepare the SQL statement for deleting data by ID
    $stmt = $db->prepare("DELETE FROM names WHERE id = :id");
    $stmt->bindParam(':id', $id);

    // Execute the query
    if ($stmt->execute()) {
        return $response->getBody()->write(json_encode(['status' => 'success', 'data' => null]));//Delete was successful
    } else {
        return $response->withStatus(500)->write(json_encode(['status' => 'error', 'message' => 'Failed to delete data']));
    }
});

$app->run();
?>