document.getElementById('bmiForm').addEventListener('submit', function(e) {
    e.preventDefault();
  
    const weight = parseFloat(document.getElementById('weight').value);
    const heightCm = parseFloat(document.getElementById('height').value);
    const heightM = heightCm / 100;
  
    const bmi = weight / (heightM * heightM);
    document.getElementById('result').textContent = `Your BMI is ${bmi.toFixed(2)}`;
  });
  