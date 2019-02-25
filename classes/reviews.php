<?php

class Reviews{

    

    public static function get_review_by_arguments($category, $subcategory) {

        global $database;
        
        $sql = "SELECT r.id AS review_id, r.full_review_text, p.category, p.subcategory, p.id as product_id
         FROM product_reviews r 
        LEFT JOIN products p ON r.product_id = p.id
        WHERE r.manual_taging= 0 AND manual_in_progress IS NULL AND p.category='$category' AND p.subcategory='$subcategory'
        LIMIT 1";
        $database->run_query($sql);
        if( $database->query_success ) {
            $results = $database->return_results(true);
        }
        //get the review_id 
        $review_id = $results['review_id'];
        //update the manual_in_progress flag to 1
        $updateReviewSql = "UPDATE product_reviews SET manual_in_progress = 1 WHERE id =".$review_id;
        $database->run_query($updateReviewSql);

        return $results;
    }


    public static function get_features_by_category($category, $subcategory){

        global $database;
        
        $sql = "SELECT * FROM product_category_features WHERE 
        category='$category' AND sub_category = '$subcategory'
         ";

        $database->run_query($sql);
        if( $database->query_success ) {
            $results = $database->return_results();
        }

        return $results;

    }


    public function save_sentiments($post_args) {

        global $database;
        $insert_qry = "INSERT INTO `manual_feature_sentiment_collection` 
        (review_id, product_id, features_sentiment, created_by, date_added) 
         VALUES
        (:review_id, :product_id, :features_sentiment, :created_by, :date_added)";

        
        $insert_data_array = array(
            'review_id' => $post_args['review_id'],
            'product_id' => $post_args['product_id'],
            'features_sentiment' => json_encode($post_args),
            'created_by' => $post_args['agent_name'],
            'date_added' => date('Y-m-d')
        );

        $database->run_query($insert_qry, $insert_data_array);
        $database->query_success;
    }
    

    
    public function save_review_flag($review_id) {

        global $database;

        $insert_qry = "
        UPDATE product_reviews SET manual_taging=1 WHERE id='$review_id'
        ";
        $database->run_query($insert_qry);
        return $database->query_success;
    }


        // $url should be an absolute url
    public function redirect($url){
            if (headers_sent()){
              die('<script type="text/javascript">window.location=\''.$url.'\';</script‌​>');
            }else{
              header('Location: ' . $url);
              die();
            }    
        }
}