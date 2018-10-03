<?php
namespace Testing;

use \WP_REST_Request;
use KeriganSolutions\KMAMail\Message;
use KeriganSolutions\KMAMail\KMAMail;

class Booking
{
    public $confirmationNumber;
    public $email;
    public $request;

    public function __construct()
    {
        add_action('rest_api_init', [$this, 'bookingEndpoint']);
    }

    public function bookingEndpoint()
    {
        register_rest_route(
            'kerigansolutions/v1',
            '/booking-form',
            [
                'methods' => 'POST',
                'callback' => [$this, 'bookingFormCompleted']
            ]
        );
    }

    public function bookingFormCompleted(WP_REST_Request $request)
    {
        $this->request = $request;
        $this->email = $this->request->get_param('Email');
        $this->confirmationNumber = $this->request->get_param('ConfirmationNumber');
        $this->sendAdminEmail();
        $this->sendBounceback();
    
        return rest_ensure_response(json_encode(['message' => 'Success']));
    }

    public function sendAdminEmail()
    {
        $headers  = 'MIME-Version: 1.0' . PHP_EOL;
        $headers .= 'Content-type: text/html; charset=utf-8' . PHP_EOL;

        $message = new Message();
        $message->setHeadline('New Online Booking')
                ->setBody('You\'ve received a new booking from the website. The Confirmation number is ' . $this->confirmationNumber . '.')
                ->setHeaders($headers)
                ->setSubject('New Online Booking')
                ->setPrimaryColor('#54b2c5')
                ->setSecondaryColor('#f4768e')
                ->to('bryan@kerigan.com');
                //->to('rentals@mexicobeachvacations.com');

        $mail = new KMAMail($message);
        $mail->send();
    }

    public function sendBounceback()
    {
        $headers  = 'MIME-Version: 1.0' . PHP_EOL;
        $headers .= 'Content-type: text/html; charset=utf-8' . PHP_EOL;

        $message = new Message();
        $message->setHeadline('Thank you for booking with Parker Realty')
                ->setBody('We\'ve received your request. One of our friendly reservationists will contact you soon to confirm the dates of your stay and answer any questions you may have. Your Confirmation number is ' . $this->confirmationNumber . '.' )
                ->setHeaders($headers)
                ->setSubject('Thank you for booking your vacation with Parker Realty')
                ->setPrimaryColor('#54b2c5')
                ->setSecondaryColor('#f4768e')
                ->to($this->email);

        $mail = new KMAMail($message);
        $mail->send();
    }

}