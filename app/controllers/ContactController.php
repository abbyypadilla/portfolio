<?php
namespace app\controllers;

use app\models\ContactModel;

require_once '../app/models/ContactModel.php';

class ContactController extends Controller {
    public function submitContactForm() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate and sanitize input
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $message = htmlspecialchars($_POST['message']);

            // Save the contact data using the model
            $contactModel = new ContactModel();
            $result = $contactModel->saveContact($name, $email, $message);

            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Thank you for reaching out!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to submit your message. Please try again later.']);
            }
        }
    }
}
