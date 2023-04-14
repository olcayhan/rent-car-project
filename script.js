var carImage = document.querySelector(".car-image");
var leftArrow = document.querySelector(".left-arrow");
var rightArrow = document.querySelector(".right-arrow");


carouselImages = [
    { id: 1, src: "./assets/car1.jpg" },
    { id: 2, src: "./assets/car2.jpg" },
    { id: 3, src: "./assets/car3.jpg" }
]



function carousel(id) {
    carImage.src = carouselImages[id].src;
}


let imageIndex = 0;
carousel(imageIndex)
leftArrow.addEventListener("click", () => {
    if (imageIndex != 0) carousel(--imageIndex);
    console.log(imageIndex)

})

rightArrow.addEventListener("click", () => {
    if (imageIndex != carouselImages.length - 1) carousel(++imageIndex);
    console.log(imageIndex)

})