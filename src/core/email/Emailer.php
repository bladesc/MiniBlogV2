<?php

namespace src\core\email;

class Emailer
{
    protected $title;
    protected $recipients;
    protected $sender;
    protected $message;
    protected $headers;

    public const DEFAULT_SENDER = 'help@lightblog.pl';

    public function __construct()
    {
        $this->headers = 'From: webmaster@example.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    public function setRecipients(array $recipients)
    {
        $this->recipients = $recipients;
        return $this;
    }
    
    public function setSender(string $sender = null)
    {
        $this->sender = $sender ?? self::DEFAULT_SENDER;
        return $this;
    }
    
    public function setMessage(string $message)
    {
        $this->message = $message;
        return $this;
    }
    
    
    public function send(): bool
    {
        return mail($this->recipients[0], $this->title, $this->message, $this->headers);
    }

    public function sendMulti(): bool
    {
        foreach ($this->recipients as $recipient) {
            if (!mail($recipient, $this->title, $this->message, $this->headers)) {
                return false;
            }
        }
        return true;
    }
}