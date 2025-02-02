const slides  = document.querySelectorAll(".slide")
var counter = 0;
slides.forEach(
    (slide,idx)=>{
        slide.style.left = `${idx * 100}%`
    }
)
const goPrev = () => {
    if (counter!=0){    
        counter--
        slideImage()
    }
}
const goNext = () => {
    if (counter!=2){
        counter++
        slideImage()
    }
}
const slideImage = () => {
    slides.forEach(
        (slide) => {
            slide.style.transform = `translateX(-${counter*100}%)`
        }
    )
}
