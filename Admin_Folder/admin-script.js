let form = document.querySelector("form"),
    nxtbtn = form.querySelector(".nxt"),
    bckbtn = form.querySelector(".back"),
    allInput = form.querySelectorAll(".form-first .reg-detail input");

nxtbtn.addEventListener("click", () => {
    let allFilled = true;

    allInput.forEach((input) => {
        if (input.value.trim() === "") {  // Trim spaces and check for empty value
            allFilled = false;
        }
    });

    if (allFilled) {
        form.classList.add("secActive");
    } else {
        alert("Please fill in all fields before proceeding.");
    }
});

// Back button functionality
bckbtn.addEventListener("click", () => {
    form.classList.remove("secActive");
});
