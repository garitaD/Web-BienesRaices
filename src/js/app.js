document.addEventListener('DOMContentLoaded', function(){

    addEventListener();
    darkMode()
})

function darkMode(){
    const btnDarkMode = document.querySelector('.dark-mode-btn')
    btnDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode')// toggle si tiene una clase la agrega y si no la quita
    })
}

function addEventListener(){
    const mobiMenu = document.querySelector('.mobile-menu')//se selecciona el elemento con la clase mobile-menu

    mobiMenu.addEventListener('click', navegacionResponsive)//al dar click en el elemento mobile-menu se registra el evento y se llama a la funsión
}

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion')

    if(navegacion.classList.contains('mostrar')){
        navegacion.classList.remove('mostrar')
    }else{
        navegacion.classList.add('mostrar')
    }
    //toggle -> si tiene una clase la agrega y si no la quita- una sola linea
    //navegacion.classList.toggle('mostrar')
}

