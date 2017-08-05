<?php
/**
 * Class ModelExtensionMassiveChangeInPriceBobs
 * @author  Bobs
 * @license GPL
 */
class ModelExtensionMassiveChangeInPriceBobs extends Model
{

    public function setProductPrice($product_id, $price)
    {
        $this->db->query(
            "UPDATE " . DB_PREFIX .
            "product SET price=" . (int)$price .
            " WHERE product_id=" . (int)$product_id
        );
    }

    public function setProductSpecialPrice($product_special_id, $special_price)
    {
        $this->db->query(
            "UPDATE " . DB_PREFIX .
            "product_special SET price=" . (int)$special_price .
            " WHERE product_special_id=" . (int)$product_special_id
        );
    }

    public function setProductDiscountQuantity($product_discount_id, $discount_quantity)
    {
        $this->db->query(
            "UPDATE " . DB_PREFIX .
            "product_discount SET quantity=" . (int)$discount_quantity .
            " WHERE product_discount_id=" . (int)$product_discount_id
        );
    }

    public function setProductDiscountPrice($product_discount_id, $discount_price)
    {
        $this->db->query(
            "UPDATE " . DB_PREFIX .
            "product_discount SET price=" . (int)$discount_price .
            " WHERE product_discount_id=" . (int)$product_discount_id
        );
    }


    public function setProductOptionPrice($product_option_value_id, $price_option)
    {
        $this->db->query(
            "UPDATE " . DB_PREFIX .
            "product_option_value SET price=" . (int)$price_option .
            " WHERE product_option_value_id=" . (int)$product_option_value_id
        );
    }

    public function setProductQuantity($product_id, $quantity)
    {
        $this->db->query(
            "UPDATE " . DB_PREFIX .
            "product SET quantity=" . (int)$quantity .
            " WHERE product_id=" . (int)$product_id
        );
    }

    public function setProductStatus($product_id, $status)
    {
        $this->db->query(
            "UPDATE " . DB_PREFIX .
            "product SET status=" . (int)$status .
            " WHERE product_id=" . (int)$product_id
        );
    }

    public function getProductIdBySpecial($product_special_id)
    {
        $sql = $this->db->query(
            "SELECT product_id FROM " . DB_PREFIX .
            "product_special " .
            " WHERE product_special_id=" . (int)$product_special_id
        );
        return $sql->row['product_id'];
    }

    public function deleteSpecial($product_special_id)
    {
        $this->db->query(
            "DELETE FROM " . DB_PREFIX .
            "product_special " .
            " WHERE product_special_id=" . (int)$product_special_id
        );
    }


    public function getSpecialByProduct($product_id)
    {
        $sql = $this->db->query(
            "SELECT product_special_id, price FROM " . DB_PREFIX .
            "product_special " .
            " WHERE product_id=" . (int)$product_id . " ORDER BY priority LIMIT 1"
        );
        return $sql->row;
    }


    public function getProductIdByDiscount($product_discount_id)
    {
        $sql = $this->db->query(
            "SELECT product_id FROM " . DB_PREFIX .
            "product_discount " .
            " WHERE product_discount_id=" . (int)$product_discount_id
        );
        return $sql->row['product_id'];
    }

    public function deleteDiscount($product_discount_id)
    {
        $this->db->query(
            "DELETE FROM " . DB_PREFIX .
            "product_discount " .
            " WHERE product_discount_id=" . (int)$product_discount_id
        );
    }


    public function getProductDiscount($product_id)
    {

        $query = $this->db->query("SELECT product_discount_id, quantity, priority, price  FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "' AND quantity > 1 AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity ASC, priority ASC, price ASC");

        $discount_norm = Array();
        foreach($query->rows as $discount_table)
        {
            $check = 0;
            foreach($discount_norm as $key => $discount_norm_value)
            {
                if($discount_table['quantity'] == $discount_norm_value['quantity'])
                {
                    if($discount_table['priority'] >= $discount_norm_value['priority'])
                    {
                        $check = 1;
                        continue;
                    } else {
                        $discount_norm[$key] = $discount_norm_value; //Update
                        $check = 1;
                        continue;
                    }
                }
            }
            if($check) {
                continue;
            }
            $discount_norm[] = $discount_table;
        }

        return $discount_norm;
    }

}


?>