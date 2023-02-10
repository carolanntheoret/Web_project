import { createApp, ref } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'

const liste = ref("")
const image_active = ref("potage.jpg")
const nom_actif = ref("Potage du moment")
const page = ref("accueil")

// Aller chercher 3 commentaires de façon aléatoire
fetch("data/commentaires.json").then(resp => {
    resp.json().then(commentaires => {
        liste.value = commentaires
        for (let i = 0; i < 3; i++) {

            let index = Math.floor(Math.random() * liste.value.length)
            liste.value.splice(index, 1)
        }
    })
})

// Changer de page (SPA)
function changerPage(nouvelle_page) {
    page.value = nouvelle_page
}

// Associer une catégorie du menu, et faire défiler le menu au bon endroit
function allerAuMenu(nom_menu, image_plat, nom_plat) {
    let cible = document.querySelector("." + nom_menu)
    let conteneur = document.querySelector(".plats_select")
    image_active.value = image_plat
    nom_actif.value = nom_plat
    conteneur.scrollTop = cible.offsetTop
}

// Toast Bootstrap pour boutons "Réservez"
const toastTriggers = document.querySelectorAll('.liveToastBtn')
const toastLiveExample = document.querySelector('#liveToast')

function reserver(){
    const toast = new bootstrap.Toast(toastLiveExample)
    toast.show()
}
for(let toastTrigger of toastTriggers ) {
    
    if (toastTrigger) {
        toastTrigger.addEventListener('click', (e) => {
        e.preventDefault()
        
        reserver()
      })
    }
}

const root = {
    setup() {
        return {
            // Propriétés
            liste,
            image_active,
            nom_actif,
            page,

            // Méthodes
            allerAuMenu,
            changerPage,
            reserver,
        }
    }
}
createApp(root).mount('#app')

