<?php


namespace src\model;


class CmsModel extends CommonModel
{
    protected $data = [];
    protected $pages = [];
    protected $replacementHtml = '';
    protected $galleryId;

    public function getCmsPages()
    {
        $pages = $this->db->select(['name'])
            ->from($this->tables->page)
            ->where('status', '=', self::STATUS_ACTIVE)
            ->getAll();
        foreach ($pages as $page) {
            $this->pages[] = $page['name'];
        }
        return $this->pages;
    }

    public function getPage(string $page)
    {
        $page = $this->validate->set($page)->filterValue()->get();
        $this->data[self::DATA_LABEL_PAGE] = $this->db->select(['name', 'url', 'title', 'content', 'tag'])->from($this->tables->page)
            ->leftJoin($this->tables->page, 'page_seo_id', $this->tables->page_seo, 'id')
            ->where('name', '=', $page)
            ->getOne();
        $this->createGalleryFromTag($this->data[self::DATA_LABEL_PAGE]['content']);
        return $this;
    }

    protected function createGalleryFromTag(string $html)
    {
        preg_match(self::GALLERY_PATTERN, $html, $matches, PREG_OFFSET_CAPTURE);
        if (isset($matches[2][0]) && is_numeric($matches[2][0])) {
            $this->getGallery(($matches[2][0]));
            $this->data[self::DATA_LABEL_PAGE]['content'] = preg_replace(self::GALLERY_PATTERN, $this->replacementHtml, $html);
        }

    }

    public function getGallery(int $id): string
    {
        $gallery = $this->db->select('*')->from($this->tables->gallery)->where('id', '=', $id)->getOne();
        $images = $this->db->select('*')->from($this->tables->image)->where('gallery_id', '=', $id)->getAll();

        if(!empty($gallery) && !empty($images)) {
            $this->replacementHtml .= '<div class=gallery-gallery>';
            foreach ($images as $image) {
                $this->replacementHtml .= '<div class="gallery-image">';
                $this->replacementHtml .= '<a href="../' . $this->configContainer['blog']['galleryPath'] . $image['id'] . '.' . $image['ext'] . '">';
                $this->replacementHtml .= '<img src="../' . $this->configContainer['blog']['galleryPath'] . $image['id'] . '.' . $image['ext'] . '">';
                $this->replacementHtml .= '</a></div>';
            }

            $this->replacementHtml .= '</div>';
        }
        return $this->replacementHtml;
    }
}