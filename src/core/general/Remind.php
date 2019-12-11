<?php


namespace src\core\general;


class Remind
{
    protected $domain = 'miniblog.pl';
    protected $page = 'remindResponse';
    protected $action = 'remindResponse';
    protected $uniqueId;
    protected $email;

    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    public function setDomain(string $domain)
    {
        $this->domain = $domain;
        return $this;
    }

    public function generateUniqueId(): void
    {
        $this->uniqueId = md5(uniqid(). $this->email);
    }

    public function getRemindData(): array
    {
        $this->generateUniqueId();
        return [
            'link' => $this->domain . 'page=' . $this->page . '&action=' . $this->action . '&code=' . $this->uniqueId,
            'code' => $this->uniqueId
        ];
    }
}