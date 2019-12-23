<?php


namespace src\core\general;


class Paginator
{
    protected $url;
    protected $paramName;
    protected $amountTotal;
    protected $amountPerPage;
    protected $html = '';
    protected $activePage = 0;
    protected $class = '';

    public function setUrl(string $url)
    {
        $this->url = $url;
        return $this;
    }

    public function setParamName(string $paramName)
    {
        $this->paramName = $paramName;
        return $this;
    }

    public function setAmountTotal(int $amountTotal)
    {
        $this->amountTotal = $amountTotal;
        return $this;
    }

    public function setAmountPerPage(string $amountPerPage)
    {
        $this->amountPerPage = $amountPerPage;
        return $this;
    }

    public function setActivePage(int $activePage)
    {
        $this->activePage = $activePage;
        return $this;
    }

    public function getHtml(): string
    {
        $amountPages = ceil($this->amountTotal / $this->amountPerPage);
        if ($amountPages > 1) {
            $this->html .= '<div>';
            for ($i = 0; $i < $amountPages; $i++) {
                $this->html .= '<a href="' . $this->url . $this->paramName . '=' . $i . '" ';
                if ($i === $this->activePage) {
                    $this->html .= 'class="active"';
                }
                $this->html .= '">' . $i . '</a>';
            }
            $this->html .= '</div>';
        }
        return $this->html;
    }
}