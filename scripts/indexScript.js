const welcomeMonkey = document.getElementById("welcomeMonkey").style;
const welcomeText = document.getElementById("welcomeText").style;
const btn1 = document.getElementById("devBtn").style;
const btn2 = document.getElementById("editorBtn").style;
const btn3 = document.getElementById("compBtn").style;
const btn4 = document.getElementById("regBtn").style;
const welcomeContainer = document.querySelector(".welcome").style;
const registerContainer = document.querySelector(".register").style;

if (history.scrollRestoration) {
  history.scrollRestoration = "manual";
} else {
  window.onbeforeunload = function () {
    window.scrollTo(0, 0);
  };
}

const init = () => {
  setTimeout(() => {
    welcomeMonkey.transition = "500ms";
    welcomeMonkey.transform = "translateX(200px)";
  }, 700);

  setTimeout(() => {
    welcomeText.opacity = "1";
  }, 900);

  setTimeout(() => {
    btn1.transition = "500ms";
    btn1.opacity = "1";
  }, 1100);
  setTimeout(() => {
    btn2.transition = "500ms";
    btn2.opacity = "1";
  }, 1250);
  setTimeout(() => {
    btn3.transition = "500ms";
    btn3.opacity = "1";
  }, 1400);
  setTimeout(() => {
    btn4.transition = "500ms";
    btn4.opacity = "1";
  }, 1550);
};

init();

const register = () => {
  console.log("welcomeContainer");
  welcomeContainer.transition = "600ms";
  welcomeContainer.transform = "translateY(-1500px)";
  setTimeout(() => {
    registerContainer.transition = "600ms";
    registerContainer.transform = "none";
  }, 300);
};

const goBack = () => {
  registerContainer.transform = "translateY(1500px)";
  setTimeout((welcomeContainer.transform = "none"), 300);
};
