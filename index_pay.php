
<?php 
include('includes/config.php');
error_reporting(0);
session_start();
$id=$_SESSION['pkgid'];

$pid=intval($_GET['pkgid']);
$sql = "SELECT * from tbltourpackages where PackageId=:pid";
$query = $dbh->prepare($sql);
$query -> bindParam(':pid', $pid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	
    
     $Tour_name=$result->PackageName;
     $price=$result->PackagePrice;
    ?>
<?php  }}?>

<?php 
// Include configuration file 
include_once 'config.php'; 
error_reporting(0);
// Include database connection file 

?>


<body>
    <style>
        .paymenth1{
            text-align:center;
            padding-top: 5px;
            padding-bottom: 5px;
            border:2px solid black;
            background-color:lightblue;
        }
        form{
            border:2px solid black;
            width:50%;
            margin-left:auto;
            margin-right:auto;
            padding-bottom:20px;
        }
        .pay{
            padding: 15px;
            display: block;
            width=50%;
            margin-left:auto;
            margin-right:auto;
            text-align:center;
            font-size: 14px;
        }
            
        
        .btn{
            padding:10px;
            padding-left:35px;
            padding-right:35px;
            border-radius:15px;
           background-color:lightgreen;
        }
        form label{
           
           
        }
    </style>
                        <h1 class="paymenth1">Payment Process</h1>
                <form action="<?php echo PAYPAL_URL; ?>" method="post" name="paypal_form" id="paypal_form">
                    <h1 class="pay">Tour Name</h1>
                    <input class="pay"type="text" name="item_name" id="item" value="<?php echo $Tour_name?>"readonly><br><br>
                    <h1 class="pay">Price </h1>
                    <input class="pay"type="text"  name="amount" id="amount" value="<?php echo $price ?>">
                    <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>"> 
                    <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">
					
                    <!-- Specify a Buy Now button. -->
                    <input type="hidden" name="cmd" value="_xclick">
                    <!-- Specify URLs -->
                    <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
                    <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
					<br><br>
                    <!-- Display the payment button. -->
                   <div style="text-align:center"> <input class="btn" type="submit" name="submit" border="0" value="Pay"></div>
                </form>

<!-- <script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("#paypal_form").submit(function(){
            setData(jQuery("#amount").val(), jQuery("#item").val());
        });
        function setData(amount, item) {
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            
          };
          xhttp.open("GET", "insertData.php?amount="+amount+"&item="+item, true);
          xhttp.send();
        }
    });
</script> -->

<script>
window.onload = function(){
  document.forms['paypal_form'].submit();
}
</script>
</body>