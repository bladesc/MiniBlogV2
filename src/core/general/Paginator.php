<?php


namespace src\core\general;


class Paginator
{
    protected $url;
    protected $paramName;
    protected $amountTotal;
    protected $amountPerPage;
    protected $html;

    public function url(string $url)
    {
        $this->url = $url;
        return $this;
    }

    public function paramName(string $paramName)
    {
        $this->paramName = $paramName;
        return $this;
    }

    public function amountTotal(int $amountTotal)
    {
        $this->amountTotal = $amountTotal;
        return $this;
    }

    public function amountPerPage(string $amountPerPage)
    {
        $this->amountPerPage = $amountPerPage;
        return $this;
    }

    public function getHtml(): string
    {
        $amountPages = floor($this->amountTotal / $this->amountPerPage);
        $this->html .= '<div>';
        for ($i = 0; $i < $amountPages; $i++) {
            $this->html .= '<a href="' . $this->url . $this->paramName . '=' . $i . '">' . $i . '</a>';
        }
        $this->html .= '</div>';
        return $this->html;
    }
}