<?php
header("Access-Control-Allow-Origin: http://localhost:4200");
// Allow specific HTTP methods (e.g., POST)
header("Access-Control-Allow-Methods: POST");
// Allow specific headers
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"));

    $name = $data->name;
    $email = $data->email;
    $message = $data->message;

    $to = "support@penoplasti.ge"; // Replace with your email address
    $subject = "New Contact Form Submission";
    $headers = "From: $email";
    
    if (mail($to, $subject, $message, $headers)) {
        http_response_code(200);
        echo json_encode(array("message" => "Email sent successfully."));
    } else {
        http_response_code(500);
        echo json_encode(array("message" => "Email sending failed."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Invalid request."));
}
?>
