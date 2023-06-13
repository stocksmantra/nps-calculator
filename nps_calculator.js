$(document).ready(function(){
    $("#NPSCalculatorForm").validate({
        ignore: [],
        debug: false,
        rules: {
            investment_per_month: {
                required: true,
                digits: true
            },
            age: {
                required: true,
                digits: true,
                min:1,
                max:100
            },
            expected_returns: {
                required: true,
                number: true,
                min:1,
                max:100
            }
        },
        messages: {
            cktext: {
                required: "Please enter Description.",
                minlength: "Please enter 10 minimum characters."
            }
        },
        submitHandler: function(form) {

            let totalInvestmentAmountOutput = document.getElementById("totalInvestment");
            let interestEarnedAmountOutput = document.getElementById("interestEarned");
            let maturityAmountOutput = document.getElementById("maturityAmount");
            let annuityAmountOutput = document.getElementById("annuityInvestment");

            let investmentPerMonth = $('#investment_per_month').val();
            let ageValue = $('#age').val();
            let expectedReturns = $('#expected_returns').val();

            let investmentDuration = 60 - ageValue;
            let roiPerMonth = expectedReturns / 1200;
            let timeInMonths = investmentDuration * 12;

            let totalInvestment = investmentPerMonth * investmentDuration * 12;
            let maturityValue = Math.round((investmentPerMonth * (Math.pow(1 + roiPerMonth, timeInMonths) - 1)) / roiPerMonth);
            let totalInterest = maturityValue - totalInvestment;
            let annuityInvestment = Math.round(maturityValue * nps_defined_worth); //min 40%

            totalInvestmentAmountOutput.innerHTML = "₹ " + totalInvestment.toLocaleString('en-IN');
            interestEarnedAmountOutput.innerHTML = "₹ " + totalInterest.toLocaleString('en-IN');
            maturityAmountOutput.innerHTML = "₹ " + maturityValue.toLocaleString('en-IN');
            annuityAmountOutput.innerHTML = "₹ " + annuityInvestment.toLocaleString('en-IN');

            $("html, body").animate({
              scrollTop: $("#slowDownPage").offset().top - 220
            }, 1000);
            
        }
    });
});