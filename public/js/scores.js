let accuracyText = document.getElementById("accuracyPoint");
let presentationText = document.getElementById("presentationPoint");
let totalText = document.getElementById("totalPoint");

let accuracyMinusOne = document.getElementById("accuracyMinusOne");
let accuracyMinusThree = document.getElementById("accuracyMinusThree");
let accuracyPlusThree = document.getElementById("accuracyPlusThree");
let accuracyPlusOne = document.getElementById("accuracyPlusOne");

let rangeSpeedPower = document.getElementById("speedPower");
let rangeRhythmTempo = document.getElementById("rhythmTempo");
let rangeExpressionOfEnergy = document.getElementById("expressionOfEnergy");

let total = 5.0;
let accuracy = 4.0;

const presentation = {
    speedPower: 1.0,
    rhythmTempo: 1.0,
    expressionOfEnergy: 1.0,
};

function buttonInput(event) {
    const text = event.target.textContent;

    if (text === "-0.1") {
        accuracy -= Number(0.1);
    } else if (text === "-0.3") {
        accuracy -= Number(0.3);
    } else if (text === "+0.1") {
        accuracy += Number(0.1);
    } else if (text === "+0.3") {
        accuracy += Number(0.3);
    } else {
    }

    accuracy = Math.max(0, Math.min(accuracy, 4.0));

    total = (
        accuracy +
        presentation.speedPower +
        presentation.rhythmTempo +
        presentation.expressionOfEnergy
    ).toFixed(1);

    accuracyText.textContent = accuracy.toFixed(1);
    totalText.textContent = total;
}

function rangeInput(event) {
    const id = event.target.id;
    const value = parseFloat(event.target.value);

    if (presentation.hasOwnProperty(id)) {
        presentation[id] = value;
    }

    const presentationSum = (
        presentation.speedPower +
        presentation.rhythmTempo +
        presentation.expressionOfEnergy
    ).toFixed(1);

    total = (accuracy + parseFloat(presentationSum)).toFixed(1);

    document.getElementById(id + "Value").textContent = value;
    presentationText.textContent = presentationSum;
    totalText.textContent = total;
}

accuracyMinusOne.addEventListener("click", buttonInput);
accuracyMinusThree.addEventListener("click", buttonInput);
accuracyPlusThree.addEventListener("click", buttonInput);
accuracyPlusOne.addEventListener("click", buttonInput);

rangeSpeedPower.addEventListener("input", rangeInput);
rangeRhythmTempo.addEventListener("input", rangeInput);
rangeExpressionOfEnergy.addEventListener("input", rangeInput);

// document.onclick = function () {
//     console.log(accuracy.toFixed(1));
// };

document
    .getElementById("modalSubmitBtn")
    .addEventListener("click", function () {
        const finalAccuracy = accuracy.toFixed(1);
        const finalPresentation = (
            presentation.speedPower +
            presentation.rhythmTempo +
            presentation.expressionOfEnergy
        ).toFixed(1);
        const finalTotal = total;

        document.getElementsByName("accuration")[0].value = finalAccuracy;
        document.getElementsByName("presentation")[0].value = finalPresentation;
        document.getElementsByName("total")[0].value = finalTotal;

        // console.log(
        //     `akurasi ${finalAccuracy}, presntasi ${finalPresentation}, total ${finalTotal}`
        // );
    });
