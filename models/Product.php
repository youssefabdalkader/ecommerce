<?php 
include_once __DIR__ . "/../dir.php" ;
include_once $dir . "/app/database/config.php";
include_once $dir . "/app/database/operations.php";

class Product extends Config implements Operations {
    private $id ;
    private $name_ar ;
    private $name_en ;
    private $code ;
    private $price ;
    private $quantity ;
    private $desc_ar ;
    private $desc_en ;
    private $status ;
    private $image ;
    private $Subcategory_id ;
    private $brand_id ;
    private $created_at ;
    private $update_at ;

    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name_ar
     */ 
    public function getName_ar()
    {
        return $this->name_ar;
    }

    /**
     * Set the value of name_ar
     *
     * @return  self
     */ 
    public function setName_ar($name_ar)
    {
        $this->name_ar = $name_ar;

        return $this;
    }

    /**
     * Get the value of name_en
     */ 
    public function getName_en()
    {
        return $this->name_en;
    }

    /**
     * Set the value of name_en
     *
     * @return  self
     */ 
    public function setName_en($name_en)
    {
        $this->name_en = $name_en;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
    
    /**
     * Get the value of code
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of quantity
     */ 
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */ 
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of desc_ar
     */ 
    public function getDesc_ar()
    {
        return $this->desc_ar;
    }

    /**
     * Set the value of desc_ar
     *
     * @return  self
     */ 
    public function setDesc_ar($desc_ar)
    {
        $this->desc_ar = $desc_ar;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    

    /**
     * Get the value of desc_en
     */ 
    public function getDesc_en()
    {
        return $this->desc_en;
    }

    /**
     * Set the value of desc_en
     *
     * @return  self
     */ 
    public function setDesc_en($desc_en)
    {
        $this->desc_en = $desc_en;

        return $this;
    }

    /**
     * Get the value of Subcategory_id
     */ 
    public function getSubcategory_id()
    {
        return $this->Subcategory_id;
    }

    /**
     * Set the value of Subcategory_id
     *
     * @return  self
     */ 
    public function setSubcategory_id($Subcategory_id)
    {
        $this->Subcategory_id = $Subcategory_id;

        return $this;
    }

    /**
     * Get the value of brand_id
     */ 
    public function getBrand_id()
    {
        return $this->brand_id;
    }

    /**
     * Set the value of brand_id
     *
     * @return  self
     */ 
    public function setBrand_id($brand_id)
    {
        $this->brand_id = $brand_id;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of update_at
     */ 
    public function getUpdate_at()
    {
        return $this->update_at;
    }

    /**
     * Set the value of update_at
     *
     * @return  self
     */ 
    public function setUpdate_at($update_at)
    {
        $this->update_at = $update_at;

        return $this;
    }

    public function create(){
    
        
    }

    public function update(){

    }

    public function delete(){

    }

    public function read(){
        $query ="SELECT `id`,`name_en`,`desc_en`,`price`,`image` FROM `products` WHERE `status`=$this->status";
        return $this->runDQL($query);

    }
    public function getbyid(){
        $query ="SELECT `id`,`name_en`,`desc_en`,`price`,`image` FROM `products` WHERE `status`=$this->status AND `subcategory_id`= $this->Subcategory_id ";
        return $this->runDQL($query);

    }
    public function getproductbyid(){
        $query ="SELECT * FROM `product_details` WHERE `id`= $this->id ";
        return $this->runDQL($query);

    }
    public function getspec(){
        $query ="SELECT
        `products_specs`.`product_id` ,
        concat(`specs`.`name_en` , ': ' , `products_specs`.`value_en`) as spec
    FROM
        `specs`
    JOIN `products_specs` ON `products_specs`.`spec_id`= `specs`.`id`
    WHERE `products_specs`.`product_id`= $this->id ";
        return $this->runDQL($query);

    }
    public function getreviw(){
        $query ="SELECT
        `reviews`.*,
        `users`.`frist_name` as frist_name
    FROM
        `reviews`
    JOIN `users` ON `reviews`.`user_id` = `users`.`id`
    WHERE
        `reviews`.`product_id` = $this->id";
        return $this->runDQL($query);

    }
    public function getnewproduct(){
        $query ="SELECT * FROM `products` order BY `created_at` DESC  LIMIT 4 ";
        return $this->runDQL($query);

    }


}