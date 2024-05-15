let refereeName = localStorage.getItem("referee");
let input = document.getElementById("refereeName");
let submitBtn = document.getElementById("submit");
let penjurian = document.getElementById("penjurian");

if (refereeName != null) {
    input.value = refereeName;
}

submitBtn.addEventListener("click", () => {
    if (input.value == "") {
        alert("Please enter your name");
    } else {
        localStorage.setItem("referee", input.value);
        document.getElementById("closeModal").click();
    }
});

// penjurian.addEventListener("click", (e) => {
//     if (refereeName == null) {
//         e.preventDefault();
//         alert("Please enter your name");
//     } else {
//         console.log("go");
//     }
// });
