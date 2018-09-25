<?php

namespace Testing;

use \WP_REST_Request;
use KeriganSolutions\KMAMail\KMAMail;
use KeriganSolutions\KMAMail\Message;

class PropertyManagementForm
{
    public $name;
    public $email;
    public $request;
    public $success;
    public $comments;
    public $errorCode;
    public $errorMessage;

    const VALIDATION_ERROR = ['status' => 422];

    public function __construct()
    {
        add_action('rest_api_init', [$this, 'registerRoutes']);
    }

    public function submitPropertyForm(WP_REST_Request $request)
    {
        $this->request = $request;
        if ($this->hasErrors()) {
            return new \WP_Error($this->errorCode, $this->errorMessage, self::VALIDATION_ERROR);
        }
        $this->persistToDashboard();
        /* $this->sendEmail(); */
        /* $this->sendBounceback(); */

        return rest_ensure_response(json_encode(['message' => 'Success']));
    }

    public function sendEmail()
    {
        $headers  = 'MIME-Version: 1.0' . PHP_EOL;
        $headers .= 'Content-type: text/html; charset=utf-8' . PHP_EOL;

        $message = new Message();
        $message->setHeadline('New Property Management Request')
                ->setBody($this->messageBody('You\'ve received a new property management request.'))
                ->setHeaders($headers)
                ->setSubject('New Property Management Request')
                ->setPrimaryColor('#b73838')
                ->setSecondaryColor('#d74f0b')
                ->to('bryan@kerigan.com');

        $mail = new KMAMail($message);
        $mail->send();
    }

    public function sendBounceback()
    {
        $headers  = 'MIME-Version: 1.0' . PHP_EOL;
        $headers .= 'Content-type: text/html; charset=utf-8' . PHP_EOL;

        $message = new Message();
        $message->setHeadline('Thank you for us')
                ->setBody($this->messageBody('We\'ve received your request. Here\'s a copy of what you submitted. We\'ll be in touch soon!' ))
                ->setHeaders($headers)
                ->setSubject('Your Property Management Request')
                ->setPrimaryColor('#b73838')
                ->setSecondaryColor('#d74f0b')
                ->to($this->email);

        $mail = new KMAMail($message);
        $mail->send();
    }

    public function messageBody( $introText )
    {
        return '
        <p>'.$introText.'</p>' .
        $this->formInformation();
    }

    public function formInformation()
    {
        return '
        <table cellspacing="0" cellpadding="0" border="0" class="datatable">
            <tr><td>Name</td><td>' . $this->name . '</td></tr>
            <tr><td>Email</td><td>' . $this->email . '</td></tr>
            <tr><td>Additional Information</td><td>' . $this->comments  . '</td></tr>
        </table>
        ';
    }

    /**
     * Add REST API routes
     */
    public function registerRoutes()
    {
        register_rest_route(
            'kerigansolutions/v1',
            '/submit-property-form',
            [
                'methods' => 'POST',
                'callback' => [$this, 'submitPropertyForm']
            ]
        );
    }

    public function persistToDashboard()
    {
        $defaults = [
            'post_title'  => $this->first_name . ' ' . $this->last_name,
            'post_type'   => 'property_request',
            'menu_order'  => 0,
            'post_status' => 'publish'
        ];

        $id = wp_insert_post($defaults);
        foreach ($this->request->get_params() as $key => $value) {
            update_post_meta($id, $key, $value);
        }
    }

    public function hasErrors()
    {
        $firstName = $this->request->get_param('first_name') !== '' ? $this->request->get_param('first_name') : null;
        $lastName  = $this->request->get_param('last_name') !== '' ? $this->request->get_param('last_name') : null;
        $email     = $this->request->get_param('email') !== '' ? $this->request->get_param('email') : null;
        $phone     = $this->request->get_param('phone') !== '' ? $this->request->get_param('phone') : null;
        $address   = $this->request->get_param('address') !== '' ? $this->request->get_param('address') : null;
        $comments  = $this->request->get_param('comments') !== '' ? $this->request->get_param('comments') : null;

        if ($firstName === null || $lastName === null) {
            $this->errorCode = 'name_required';
            $this->errorMessage = 'The name fields are required';

            return true;
        }
        if ($email === null) {
            $this->errorCode = 'email_required';
            $this->errorMessage = 'The email field is required';

            return true;
        }

        if ($phone === null) {
            $this->errorCode = 'phone_required';
            $this->errorMessage = 'The phone field is required';

            return true;
        }
        if ($address === null) {
            $this->errorCode = 'address_required';
            $this->errorMessage = 'The address field is required';

            return true;
        }

        if ($comments === null) {
            $this->errorCode = 'comments_required';
            $this->errorMessage = 'The comments field is required';

            return true;
        }
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errorCode = 'invalid_email';
            $this->errorMessage = 'The email address you entered is invalid';

            return true;
        }

        $this->first_name = $firstName;
        $this->last_name  = $lastName;
        $this->email      = $email;
        $this->address    = $address;
        $this->phone      = $phone;
        $this->comments   = $comments;

        return false;
    }
}
