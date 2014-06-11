<?php
class Item {
	private $id;
	private $title;
	private $description;
	private $imgPath;
    private $category;
    private $keywords;
    private $postedTimestamp;
    private $updatedTimestamp;
    private $price;
    private $published;
    private $sellerId;

    function __construct($id, $title, $description, $imgPath, $category, $keywords, $postedTS, $updatedTS, $price, $published, $sellerId){
      $this->setId($id);
      $this->setTitle($title);
      $this->setDescription($description);
      $this->setImgPath($imgPath);
      $this->setCategory($category);
      $this->setKeywords($keywords);
      $this->setPostedTimestamp($postedTS);
      $this->setUpdatedTimestamp($updatedTS);
      $this->setPrice($price);
      $this->setPublished($published);
      $this->setSellerID($sellerId);
  }

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of title.
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the value of title.
     *
     * @param mixed $title the title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Gets the value of description.
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the value of description.
     *
     * @param mixed $description the description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
    /**
     * Gets the value of category.
     *
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * Sets the value of category.
     *
     * @param mixed $category
     *
     * @return self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Gets the value of keywords.
     *
     * @return mixed
     */
    public function getKeywords()
    {
        return $this->keywords;
    }
      /**
     * Sets the value of keywords.
     *
     * @param mixed $category
     *
     * @return self
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Gets the value of imgPath.
     *
     * @return mixed
     */

    public function getImgPath()
    {
        return str_replace(' ', '%20', $this->imgPath);
    }

    /**
     * Sets the value of imgPath.
     *
     * @param mixed $imgPath the img path
     *
     * @return self
     */
    public function setImgPath($imgPath)
    {
        $this->imgPath = $imgPath;

        return $this;
    }

    /**
     * Gets the value of postedTimestamp.
     *
     * @return mixed
     */
    public function getPostedTimestamp()
    {
        return $this->postedTimestamp;
    }

    /**
     * Sets the value of postedTimestamp.
     *
     * @param mixed $postedTimestamp the posted timestamp
     *
     * @return self
     */
    public function setPostedTimestamp($postedTimestamp)
    {
        $this->postedTimestamp = $postedTimestamp;

        return $this;
    }

    /**
     * Gets the value of updatedTimestamp.
     *
     * @return mixed
     */
    public function getUpdatedTimestamp()
    {
        return $this->updatedTimestamp;
    }

    /**
     * Sets the value of updatedTimestamp.
     *
     * @param mixed $updatedTimestamp the updated timestamp
     *
     * @return self
     */
    public function setUpdatedTimestamp($updatedTimestamp)
    {
        $this->updatedTimestamp = $updatedTimestamp;

        return $this;
    }

    /**
     * Gets the value of price.
     *
     * @return mixed
     */
    public function getPrice()
    {
        return "\$".number_format($this->price, 2);
    }

    public function getPriceAsNumber(){
        return $this->price;
    }

    /**
     * Sets the value of price.
     *
     * @param mixed $price the price
     *
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Gets the value of published.
     *
     * @return mixed
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Gets the value of published.
     *
     * @return mixed
     */
    public function getPublishedAsInt()
    {
        return ($this->published == true ? 1 : 0);
    }

    /**
     * Sets the value of published.
     *
     * @param mixed $published the published
     *
     * @return self
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

     /**
     * Gets the value of sellerId.
     *
     * @return mixed
     */
    public function getSellerId()
    {
        return $this->sellerId;
    }

    /**
     * Sets the value of sellerId.
     *
     * 
     *
     * @return self
     */
    public function setSellerId($sellerId)
    {
        $this->sellerId = $sellerId;

        return $this;
    }
}
?>
