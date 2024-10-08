
const mas = document.querySelector(".mas");
const menos = document.querySelector(".menos");
const num = document.querySelector(".num");


let a = 0;

mas.addEventListener("click", () => {
    a++; 
    a = (a < 10) ? "0" + a : a; 
    num.innerText = a; 
});

menos.addEventListener("click", () => {
    if (a > 0) { 
        a--;
        a = (a < 10) ? "0" + a : a; 
        num.innerText = a; 
    }
});
