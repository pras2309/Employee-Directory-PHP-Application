<?php include('partials/header.php');

restrict_access();
$category = $_GET['category'];
$subcategory = $_GET['subcategory'];
$review = Reviews::get_review_by_arguments($category,  $subcategory );
$categories = Reviews::get_features_by_category($category, $subcategory);

if($_POST) {
    $reviews_obj = new Reviews();
    $reviews_obj->save_sentiments($_POST);
    $result = $reviews_obj->save_review_flag($_POST['review_id']);
    setcookie('agent_name', $_POST['agent_name'], time() + (86400 * 30), "/");
    echo $result;
    
    if ($result) {
        $reviews_obj->redirect($_SERVER['REQUEST_URI']);
    }

}


if (isset($_COOKIE['agent_name']))
{
    $agent_name=$_COOKIE['agent_name'];
}else{
    $agent_name = "";
}


?>
<form method="post"> 
<input type="hidden" name="review_id" value = "<?=$review['review_id']; ?>" />
<input type="hidden" name="product_id" value = "<?=$review['product_id']; ?>" />

    <div class="row">
        <div class="medium-6 columns">
            
            <table id="tablePreview" class="table">
            <!--Table head-->
            <thead>
            <tr>
                <th scope="row">Agent Name</th>
                <th><input type="text" name = "agent_name" value="<?=$agent_name; ?>" /></th> 
                </tr>
                <tr>
                <th scope="row">Feature</th>
                <th>Feedback</th> 
                </tr>
            </thead>
            <!--Table head-->
            <!--Table body-->
            <tbody>
                <?php
                    foreach ($categories as $feature){
                ?>
                <tr>                
                    <td scope="row"><?=$feature['feature'];?></td>
                    <td><select name="<?php echo preg_replace('/\s+/', '_', $feature['feature']);?>">
                    <option value="Select One">Select One</option>
                    <option value="positive">Positive</option>
                    <option value="negative">Negative</option>
                    <option value="neutral">Neutral</option>
                    <option value="Not discussed">Not discussed</option>
                    </select>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <!--Table body-->
            </table>
            
            <input type="submit" value="Save" id="save_sentiment" style="float:right;size:10px;width:200px;" />
            
            <!--Table-->
        </div>
        <div class="medium-6 columns" style="border:1px solid red;">
        <pre style="white-space: pre-wrap;       /* Since CSS 2.1 */
    white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
    white-space: -pre-wrap;      /* Opera 4-6 */
    white-space: -o-pre-wrap;    /* Opera 7 */
    word-wrap: break-word; ">
        <?=$review['full_review_text']; ?>
</pre>
        </div>
    </div>
    </form>

<script type="text/Javascript">

/*
$("#save_sentiment_asdf").click(function(){
    // Loop through grabbing everything
    var myRows = [];
    var $headers = $("th");
    var $rows = $("tbody tr").each(function(index) {
    $cells = $(this).find("td"); 
    myRows[index] = {};
    $cells.each(function(cellIndex) {
        if(cellIndex ==0){
            checked_value = $(this).html(); 
        }else{

            if($(this).find('input:checked').val()){
                checked_value = $(this).find('input:checked').val();
            }else{
                checked_value = '';
            }
        }

        myRows[index][$($headers[cellIndex]).html()] = checked_value;
        
    });    
    });

    // Let's put this in the object like you want and convert to JSON (Note: jQuery will also do this for you on the Ajax request)
    var myObj = {};
    myObj.article_id = "1";
    myObj.myrows = myRows;
    a = JSON.stringify(myObj);
    $.ajax({
            type: 'post',
            url: 'ajax.php',
            data: JSON.stringify(myObj),            
            success: function (data) {
                console.log(JSON.parse(data));                
            }
        });

  
});
*/

</script>

<?php include('partials/footer.php'); ?>