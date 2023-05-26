<!DOCTYPE html>
<html lang="en">
<head>
  <title>NPS Calculator in PHP</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<style>
    body {
        background-image: url('https://nps.kfintech.com/content/darktheme/nps-assets/images/corporate.png');	
}
  .text{
    margin-left:11.5em;
    margin-top:0.3em;
    color:white;
  }
  .form-signin {
    border-radius:7px;
  max-width: 460px;
  padding: 10px 30px 40px;
  margin: 0 auto;
  background-color:	#F8F8FF ;
  border: 1px solid rgba(0,0,0,0.1);}
  .form-control {
	  position: relative;
	  font-size: 16px;
	  height: auto;
	  padding: 4px;
		@include box-sizing(border-box);}
     .font{
        color:#483D8B;
     }
     h5{
      color:#483D8B;
     }
     .button{
        background-color: #483D8B; /* Blue */
  border: none;
  color: white;
  padding: 4px 18px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius:3px ;
     }   
</style>
<body>
<h1 class="text"><b>NPS Calculator</b></h1>
<form action="" method="post" class="form-signin">
 <b class="font"> Enter monthly contribution towards NPS:</b> <input type="number" class="form-control" name="monthly_contribution" step="0.01" required><br>
 <b class="font">Enter expected rate of return on NPS investment (%):</b> <input type="number" class="form-control" name="rate_of_return" step="0.01" required><br>
 <b class="font">% of Pension Wealth to be Invested in Annuity:</b> <input type="number" class="form-control" name="investment_percentage" step="0.01" required><br>
 <b class="font">Enter expected rate of return on annuity investment (%):</b> <input type="number"class="form-control" name="rate_of_return_annuity" step="0.01" required><br>
 <b class="font">Enter period of annuity you wish to receive (years):</b> <input type="number"class="form-control" name="annuity_tenure" step="1" required><br>
  <input type="submit" class="button" value="Calculate"><br>
  <?php
// Retrieve user inputs
// Retrieve user inputs
$monthly_contribution = isset($_POST['monthly_contribution']) ? $_POST['monthly_contribution'] : 0;
$rate_of_return = isset($_POST['rate_of_return']) ? $_POST['rate_of_return'] : 0;
$investment_percentage = isset($_POST['investment_percentage']) ? $_POST['investment_percentage'] : 0;
$rate_of_return_annuity = isset($_POST['rate_of_return_annuity']) ? $_POST['rate_of_return_annuity'] : 0;
$annuity_tenure = isset($_POST['annuity_tenure']) ? $_POST['annuity_tenure'] : 0;


// Calculate the accumulated wealth
$years_to_retirement = 60 - 18; // Assuming retirement age is 60 and minimum investment age is 18

if ($rate_of_return != 0) {
    $accumulated_wealth = $monthly_contribution * ((pow(1 + $rate_of_return / 100 / 12, $years_to_retirement * 12) - 1) / ($rate_of_return / 100 / 12));
} else {
    // echo "Rate of return cannot be zero.";
    exit;
}

// Calculate the annuity investment amount
$annuity_investment = $accumulated_wealth * $investment_percentage / 100;

// Calculate the regular pension amount
$pension_amount = $annuity_investment * (($rate_of_return_annuity / 100 / 12) * pow(1 + $rate_of_return_annuity / 100 / 12, $annuity_tenure * 12)) / (pow(1 + $rate_of_return_annuity / 100 / 12, $annuity_tenure * 12) - 1);

// Display the results
echo "<h5>Accumulated Wealth: " . number_format($accumulated_wealth, 2)."</h5>" . "";
echo "<h5>Regular Pension Amount: " . number_format($pension_amount, 2)."</h5>";
?>
</form>

</body>
</html>


