//this piece of code has been written by JMLMatheo
const images = document.querySelectorAll(".images_projet img");
let current_image = 0;

// init by removing all images from the display except the first
for(let i = 0; i < images.length; i++)
{
    images[i].style.display = "none";
}
images[current_image].style.display = "block";


// start changing images 
function changeImage()
{
    images[current_image].style.display = "none"
    if(current_image >= images.length - 1)
    {
        current_image = 0;
    }
    else
    {
        current_image++;
    }
    images[current_image].style.display = "block";
}

setInterval(changeImage, 5000);