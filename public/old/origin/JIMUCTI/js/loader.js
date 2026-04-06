const timer = (time) =>
  new Promise(resolve => setTimeout(resolve, time));

async function openingAnimation() {
    const openingLogo = document.querySelector(".opening-logo");
    const slide = document.querySelector(".page-slide"); 

    await timer(1000);
    openingLogo.classList.add("opening-logo--visible");

    await timer(2000);
    openingLogo.classList.remove("opening-logo--visible");
    
    await timer(1000);
    
    if (slide) {
        slide.classList.add("is-active");
        await timer(800);
    }
  
    location.replace("index.html");
}

openingAnimation();

window.addEventListener("load", () => {
  document.body.classList.add("page-visible");
});
