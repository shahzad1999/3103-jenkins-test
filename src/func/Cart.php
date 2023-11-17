<?php

// php cart class
class Cart
{
    public $db = null;

    public function __construct(Connect $db)
    {
        if (!isset($db->con))
        {
            exit;
        }
        $this->db = $db;
    }

    // get cart using user_id
    public function getCart($userid = null, $table = 'user_cart')
    {
        $sql = "SELECT * FROM {$table} WHERE UserID={$userid}";
        $result = $this->db->con->query($sql);
        $resultArray = array();

        // fetch product data one by one
        if ($result->num_rows > 0) {
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resultArray[] = $item;
            }
        }

        return $resultArray;
    }

    // insert into cart table
    public function insertIntoCart($params = null, $table = "user_cart")
    {
        if ($this->db->con != null) {
            if ($params != null) {
                // "Insert into cart(user_id, item_id) values (0)"
                // get table columns
                $columns = implode(',', array_keys($params));

                $values = implode(',', array_values($params));

                // create sql query
                $sql = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);

                // execute query
                $result = $this->db->con->query($sql);
                return $result;
            }
        }
    }

    // get user_id and item_id and insert into cart table
    public function addToCart($userid, $itemid)
    {
        if (isset($userid) && isset($itemid)) {
            $params = array(
                "UserID" => $userid,
                "OrderID" => $itemid,
            );

            // insert data into cart
            $result = $this->insertIntoCart($params);
            if ($result) {
                // Reload Page
                header('Location: ' . $_SERVER['REQUEST_URI']);
            } else {
                echo '<script>alert("Error")</script>';
            }
        }
    }

    // delete cart item using cart item id
    public function deleteCart($item_id = null, $table = 'user_cart')
    {
        if ($item_id != null) {
            $sql = "DELETE FROM {$table} WHERE OrderID={$item_id}";
           
            $result = $this->db->con->query($sql);
            if ($result) {
                // Reload Page
                header('Location: ' . $_SERVER['REQUEST_URI']);
            } else {
                echo '<script>alert("Error")</script>';
            }
            return $result;
        }
    }

       // delete cart item using cart item id
       public function deleteCartbyID($userid = null, $table = 'user_cart')
       {
           if ($userid != null) {
               $sql = "DELETE FROM {$table} WHERE UserID={$userid}";
              
               $result = $this->db->con->query($sql);
               if ($result) {
                   // Reload Page
                   header('Location: ' . $_SERVER['REQUEST_URI']);
               } else {
                   echo '<script>alert("Error")</script>';
               }
               return $result;
           }
       }

    // calculate sub total
    public function getSum($arr)
    {
        $sum = 0;
        foreach ($arr as $item) {
            $sum += floatval($item);
        }
        return sprintf('%.2f', $sum);
    }

    // get item_id of shopping cart list
    public function getCartId($cartArray = null)
    {
        $cart_id = array();
        if ($cartArray != null) {
            foreach ($cartArray as $item) {
                array_push($cart_id, $item['OrderID']);
            }
            return $cart_id;
        }
    }

    // get multiple order of the same orderID
    public function getGroupedCartItems($userid = null, $table = 'user_cart')
    {
        if ($userid !== null) {
            $sql = "SELECT OrderID, UserID, COUNT(*) as Quantity
                    FROM {$table}
                    WHERE UserID = {$userid}
                    GROUP BY OrderID";
            $result = $this->db->con->query($sql);
            $groupedCartItems = array();
    
            if ($result->num_rows > 0) {
                while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $groupedCartItems[$item['OrderID']] = $item;
                }
            }
            return $groupedCartItems;
        }
        return null;
    }
    

}