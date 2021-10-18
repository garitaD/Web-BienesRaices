document.addEventListener('DOMContentLoaded', function(){

    addEventListener();
    darkMode()
})

function darkMode(){

    const btnDarkMode = document.querySelector('.dark-mode-btn')
    const preferenciaDarkMode = window.matchMedia('(prefers-color-scheme: dark)')

    //console.log(preferenciaDarkMode.matches)//matches es el obj que indica false o true según la conf del sistema operativo
    if (preferenciaDarkMode.matches){
        document.body.classList.add('dark-mode')
    }else{
        document.body.classList.remove('dark-mode')
    }
    preferenciaDarkMode.addEventListener('change', function(){//con esta funcion se leen las preferencias del so del usuario, y el sitio cambia automaticamente(sin recargar)
        if (preferenciaDarkMode.matches){
            document.body.classList.add('dark-mode')
        }else{
            document.body.classList.remove('dark-mode')
        }

    })
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

