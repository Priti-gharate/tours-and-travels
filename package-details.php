<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit2']))
{
$pid=intval($_GET['pkgid']);
$useremail=$_SESSION['login'];
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$comment=$_POST['comment'];
$status=0;
$sql="INSERT INTO tblbooking(PackageId,UserEmail,FromDate,ToDate,Comment,status) VALUES(:pid,:useremail,:fromdate,:todate,:comment,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':pid',$pid,PDO::PARAM_STR);
$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':comment',$comment,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Booked Successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

$email_id=$_SESSION['login'];
$amount=$_POST['amount'];
$payerid=$_GET['PayerID'];
$status="Success";
$sql1="INSERT INTO `userpayment`(`useremail`, `payerid`, `amount`, `status`) VALUES (:email_id,:payerid,:amount,:status)";
$query = $dbh->prepare($sql1);
$query->bindParam(':email_id',$email_id,PDO::PARAM_STR);
$query->bindParam(':payerid',$payerid,PDO::PARAM_STR);
$query->bindParam(':amount',$amount,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg1="Payment  Successfull";
}
else 
{
$error="Something went wrong. Please try again";
}


}





?>
<!DOCTYPE HTML>
<html>
<head>
<title>TANDT|PACKAGE DETAILS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />
	<script>
		 new WOW().init();
	</script>
<script src="js/jquery-ui.js"></script>
					<script>
						$(function() {
						$( "#datepicker,#datepicker1" ).datepicker();
						});
					</script>
	  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>	
		<script src="https://www.paypalobjects.com/api/checkout.js"></script>			
</head>
<body>
<!-- top-header -->
<?php include('includes/header.php');?>
<div class="banner-3">
	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> TANDT|PACKAGE DETAILS</h1>
	</div>
</div>
<!--- /banner ---->
<!--- selectroom ---->
<div class="selectroom">
	<div class="container">	
		  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg."And".$msg1); ?> </div><?php }?>





<?php 


$payerid=$_GET['PayerID'];
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
	
	$_SESSION['pkgid']=$_GET['pkgid'];?>




<form name="book" method="post" >
		<div class="selectroom_top">
			<div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
				<img src="admin/pacakgeimages/<?php echo htmlentities($result->PackageImage);?>" class="img-responsive" alt="">
			</div>
			<div class="col-md-8 selectroom_right wow fadeInRight animated" data-wow-delay=".5s">
				<h2><?php echo htmlentities($result->PackageName);?></h2>
				<p class="dow">#PKG-<?php echo htmlentities($result->PackageId);?></p>
				<p><b>Package Type :</b> <?php echo htmlentities($result->PackageType);?></p>
				<p><b>Package Location :</b> <?php echo htmlentities($result->PackageLocation);?></p>
					<p><b>Features</b> <?php echo htmlentities($result->PackageFetures);?></p>
					<div class="ban-bottom">
				<div class="bnr-right">
				<label class="inputLabel">From</label>
				<input class="date" id="datepicker" type="text" placeholder="dd-mm-yyyy"  name="fromdate" required="">
			</div>
			<div class="bnr-right">
			     <input type="hidden" name="amount" >
                <input type="hidden" name="payment_method" value="cod">
                <input type="hidden" name="paid" value="0">
				<input type="hidden" name="amount" id="amount" value="<?php echo htmlentities($result->PackagePrice);?> ">
                
				<label class="inputLabel">To</label>
				<input class="date" id="datepicker1" type="text" placeholder="dd-mm-yyyy" name="todate" required="">
			
			</div>
			</div>
			
			<div>
			<?php if($payerid > 0){?>
						<div align="center">
						Payer_id:<input type="text" style="border-bottom:2px solid black;" name="payerid" value="<?php echo $payerid ?>" disabled>
					</div>
					 <?php 	} ?>
			
			</div>
			<?php if(empty($payerid )){?>
				<div class="clearfix"></div>
				<div class="grand">
					<p>Grand Total</p>
					
					<h3>₹<?php echo htmlentities($result->PackagePrice);?></h3>
					<?php  }?>
		</div> 
		
				
			</div>
		<h3>Package Details</h3>
				<p style="padding-top: 1%"><?php echo htmlentities($result->PackageDetails);?> </p>	
				<div class="clearfix"></div>
		</div>
		<div class="selectroom_top">
			<h2>Travels</h2>
			<div class="selectroom-info animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp; margin-top: -70px">
				<ul>
				
					<li class="spe">
						<label class="inputLabel">Comment</label>
						<input class="special" type="text" name="comment" required="">
					</li>
					<?php if($_SESSION['login'])
					{?>
					<?php if($payerid== ""){?>
						<div align="center">
			         <a  style="margin-top:10px;" href="./index_pay.php?pkgid=<?php echo $pid ;?>"class="btn btn-primary"><h3>PAY</h3></a>
					</div>
					 <?php 	} ?>
						<?php if($payerid>0){?>
								<h3 style="color:Green; text-align:center;">Payment Successfull</h3>
								<h4 style="text-align:center;">your payment is ₹<span style="color:green;"><?php echo htmlentities($result->PackagePrice);?> </span></h4>
						<li class="spe" align="center">
					  <button type="submit" name="submit2" class="btn-primary btn">Book</button>
						</li>
						<?php 	} ?>
						<?php } else {?>
							<li class="sigi" align="center" style="margin-top: 1%">
							
								<a href="#" data-toggle="modal" data-target="#myModal4" class="btn-primary btn" > Book </a></li>
						
							<?php } ?>
					<div class="clearfix"></div>
				</ul>
			</div>
			
		</div>
		</form>
<?php }} ?>


	</div>
</div>

<!--- /selectroom ---->
<<!--- /footer-top ---->
<?php include('includes/footer.php');?>
<!-- signup -->
<?php include('includes/signup.php');?>			
<!-- //signu -->
<!-- signin -->
<?php include('includes/signin.php');?>			
<!-- //signin -->
<!-- write us -->
<?php include('includes/write-us.php');?>
<script>
	 jQuery(document).ready(function(){
	
    });
</script>
</body>
</html>