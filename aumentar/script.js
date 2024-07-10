let starValue = 0;
let disabledBtn = document.getElementById("disabledBtn");
disabledBtn.disabled = true;

function addValueFunction(valuePar) {
    document.getElementById("amount").value;

    if (valuePar.value == 'increase') {
        starValue++;
    } else {
        starValue--;
    }
    document.getElementById("amount").textContent = starValue;

    if (starValue == 0) {
        disabledBtn.disabled = true;
    } else {
        disabledBtn.disabled = false;
    }
}

