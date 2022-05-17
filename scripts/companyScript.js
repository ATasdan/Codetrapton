const rad = document.btns.qType;
const nonCoding = document.getElementById("nonCodingDiv");
const coding = document.getElementById("codingDiv");
const createButton = document.getElementById("createButton")
const cancelButton = document.getElementById("cancelButton")
const modal = document.getElementById("modal")
const overlay = document.getElementById("overlay")

rad[0].addEventListener("change", function () {
  nonCoding.style.display = "";
  coding.style.display = "none";
});

rad[1].addEventListener("change", function () {
  nonCoding.style.display = "none";
  coding.style.display = "";
});

createButton.addEventListener('click',function(){
    overlay.style.display = "";
})

cancelButton.addEventListener('click',function(){
    overlay.style.display = "none";
})