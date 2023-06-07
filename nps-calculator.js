document.getElementById("nps-form").addEventListener("submit", function (event) {
    event.preventDefault();
  
    const monthlyContribution = parseFloat(
      document.getElementById("monthly-contribution").value
    );
    const rateOfReturn = parseFloat(
      document.getElementById("rate-of-return").value
    );
    const age = parseInt(document.getElementById("age").value);
  
    const yearsToRetirement = 60 - age;
    const annualRateOfReturn = rateOfReturn / 100;
    const monthlyRateOfReturn = annualRateOfReturn / 12;
  
    const totalAmountInvested = monthlyContribution * 12 * yearsToRetirement;
    const maturityAmount = calculateMaturityAmount(
      monthlyContribution,
      monthlyRateOfReturn,
      yearsToRetirement
    );
    const annuityInvestmentAmount = (maturityAmount * 40) / 100;
  
    document.getElementById("output").innerHTML = `
     <h5> <p>Total Amount Invested: ${totalAmountInvested.toFixed(2)}</p>
      <p>Maturity Amount: ${maturityAmount.toFixed(2)}</p>
      <p>Annuity Investment Amount: ${annuityInvestmentAmount.toFixed(2)}</p></h5>
    `;
  });
  
  function calculateMaturityAmount(
    monthlyContribution,
    monthlyRateOfReturn,
    yearsToRetirement
  ) {
    const numberOfMonths = yearsToRetirement * 12;
    let maturityAmount = 0;
  
    for (let i = 0; i < numberOfMonths; i++) {
      maturityAmount = (maturityAmount + monthlyContribution) * (1 + monthlyRateOfReturn);
    }
  
    return maturityAmount;
  }