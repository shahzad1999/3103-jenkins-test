<?php

// Use to fetch product data
class Product
{
    public $db = null;

    public function __construct(Connect $db)
    {
        if (!isset($db->con)) {
            exit;
        }
        $this->db = $db;
    }

    // Fetch and return product data from the specified table using the getData method
    public function getData($table = 'mooncakes')
    {
        $sql = "SELECT * FROM mooncakes";
        $result = $this->db->con->query($sql);

        $resultArray = array();

        // Fetch product data one by one
        if ($result->num_rows > 0) {
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resultArray[] = $item;
            }
        }

        return $resultArray;
    }

    // Retrieve both product and ratings data for a specific item by ID using getProductWithRatings
    public function getProductWithRatings($id = 15, $table = 'mooncakes')
    {
        if ($id != null) {
            $sql = "SELECT mooncakes.*, ratings.* FROM mooncakes
                    LEFT JOIN ratings ON mooncakes.MooncakeID = ratings.MooncakeID
                    WHERE mooncakes.MooncakeID = {$id}";
            $result = $this->db->con->query($sql);

            if ($result->num_rows == 1) {
                return $result->fetch_assoc();
            }
        }
        return null;
    }
}
