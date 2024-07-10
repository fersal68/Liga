let starValueV = 0;
let disabledBtnv = document.getElementById("disabledBtnv");
disabledBtnv.disabled = true;

function addValueFunctionv(valuePar) {
    document.getElementById("amountv").value;

    if (valuePar.value == 'increase') {
        starValueV++;
    } else {
        starValueV--;
    }
    document.getElementById("amountv").textContent = starValueV;


    if (starValueV == 0) {
        disabledBtnv.disabled = true;
    } else {
        disabledBtnv.disabled = false;
    }
}
