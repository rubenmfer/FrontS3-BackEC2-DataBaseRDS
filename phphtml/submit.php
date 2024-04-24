<?php
 
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Access-Control-Max-Age: 86400'); // Cache preflight request for 1 day
    exit;
}
 
// Allow requests from any origin
header("Access-Control-Allow-Origin: *");
 
require 'vendor/autoload.php'; 
 
use Aws\Sns\SnsClient; 
use Aws\Exception\AwsException; 
 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $name = $_POST["name"]; 
    $email = $_POST["email"]; 
    $message = $_POST["message"]; 
 
    // Replace 'your-sns-topic-arn' with the ARN of your SNS topic 
    $snsTopicArn = 'arn:aws:sns:us-east-1:021169157539:S3EC2RDS'; 
 
    // Initialize SNS client 
    $snsClient = new SnsClient([ 
        'version' => 'latest', 
        'region' => 'us-east-1' // Replace with your desired AWS region 
    ]); 
 
    // Create message to send to SNS topic 
    $messageToSend = json_encode([ 
        'email' => $email, 
        'name' => $name, 
        'message' => $message 
    ]); 
 
    try { 
        // Publish message to SNS topic 
        $snsClient->publish([ 
            'TopicArn' => $snsTopicArn, 
            'Message' => $messageToSend 
        ]); 


// CODIGO PARA ENVIAR EL FORMULARIO A LA BD

          // Write data to RDS MySQL database
         $dbHost = 'database-1.cqvj2fur6lmt.us-east-1.rds.amazonaws.com';
         $dbName = 'mibd';
         $dbUser = 'admin';
         $dbPass = 'mysql123';
        $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";
        $pdo = new PDO($dsn, $dbUser, $dbPass);
        // Prepare SQL statement
         $stmt = $pdo->prepare("INSERT INTO datos_contacto (name, email, message) VALUES (:name, :email, :message)");
        // Bind parameters
         $stmt->bindParam(':name', $name);
         $stmt->bindParam(':email', $email);
         $stmt->bindParam(':message', $message);
        // Execute the statement
         $stmt->execute();






 
        echo "Message sent successfully."; 
    } catch (AwsException $e) { 
        echo "Error sending message: " . $e->getMessage(); 
    } 
} else { 
    http_response_code(405); 
    echo "Method Not Allowed"; 
} 
 
?>

