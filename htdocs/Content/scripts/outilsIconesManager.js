/*  This piece of code has been written by JMLMatheo    */

let elements_projets_li = document.querySelectorAll(".outils li");

elements_projets_li.forEach((elem)=>{
    if(elem.querySelector(".icone") != null)
    {
        return;     // l'element a deja une icone
    }
    let new_img = document.createElement('img');
    let outil_link = elem.querySelector("a");

    new_img.classList.add('icone');
    new_img.src = "/Content/images/defaultOutil_icone.png"; // chemin de l'icone d'outil par defaut
    elem.insertBefore(new_img, outil_link);
});