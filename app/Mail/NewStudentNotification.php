<?php namespace App\Mail; 
use Illuminate\Bus\Queueable; 
use Illuminate\Contracts\Queue\ShouldQueue; 
use Illuminate\Mail\Mailable;
 use Illuminate\Mail\Mailables\Content; 
 use Illuminate\Mail\Mailables\Envelope; 
 use Illuminate\Queue\SerializesModels; 
 class NewStudentNotification extends Mailable { 
    use Queueable, SerializesModels;
    public $username; 

    /** * Create a new message instance. */ 
    public function __construct($username) { $this->username = $username; }

     /** * Get the message envelope. */ 
     public function envelope(): Envelope { return new Envelope( subject: 'New registered user', ); } 

     /** * Get the message content definition. */ 
     public function content(): Content { return new Content( view: 'emails.new_student_notification', with: [ 'username' => $this->username, ], );
     } 
     /** * Get the attachments for the message. * * @return array<int, \Illuminate\Mail\Mailables\Attachment> */
      public function attachments(): array { return []; } } 