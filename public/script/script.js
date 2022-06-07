// animation hamburger
const hamburger = document.querySelector("#hamburgerImg")


const hamburgerButton = document.querySelector("#hamburgerButton")

var listeHamburger = document.querySelector('ul')
if (hamburgerButton) {
    hamburgerButton.addEventListener("click", hamburgerMenu)
}


function hamburgerMenu() {
    if (hamburgerButton.value == "close") {
        hamburger.src = "../files/svg/croix.svg"
        hamburgerButton.value = "open"
        listeHamburger.style.visibility = "visible"
    } else {
        hamburger.src = "../files/svg/hamburger.svg"
        hamburgerButton.value = "close"
        listeHamburger.style.visibility = "collapse"
    }

    console.log(1);
}
//fonction recupration image
async function recupImg(articleId, category) {

    var array = []
    var url = "../async/readArticle.php?"
    articleId ? url += "id=" + articleId + "&" : ''
    category ? url += "category=" + category + "&" : ''
    await fetch(url, {
        method: "GET",

    }).then(response => response.json())
        //.then(r=> console.log(r))
        .then(resp => resp.forEach(element => {
            array.push(element.link)
        }))


    return array

}
function test(data) {
    return data
}
window.onload = function () {
    /* recupImg(1, 'sol').then(resp => ChangerImage("test1" , resp))
     recupImg(1 , null).then(resp => ChangerImage("test2" , resp))
     */
    if (imgCarouselArticle !== null) {
        ChangerImage('imgArticle', imgArray.value.split(','))
    }



}
// affichage de l'image en carroussel

async function ChangerImage(id, array) {
    var img = document.querySelector("#" + id);
    var pointeur = 0;
    // console.log(img);
    var table = array
    test1()
    function test1() {
        // console.log(table);
        if (pointeur < table.length - 1) {
            pointeur++;
        }
        else {
            pointeur = 0;
        }

        img.src = table[pointeur];

        img.animate([
            // étapes/keyframes
            { opacity: 0.5 },
            { opacity: 1 }
        ], {
            // temporisation
            duration: 2000,

        })
        setTimeout(test1, 15000)
    }

}

function affiche1(array) {
    console.log(JSON.stringify(array));

}
// test affichage article
var imgArray = document.querySelector('#arrayImg')
var imgCarouselArticle = document.querySelector("#imgArticle")

// connexion
var connex = document.querySelector("#connexionForm")
if (connex) {
    connex.addEventListener('submit', async (event) => {
        event.preventDefault()
        var data = new FormData(connex)

        var mesresponse = document.createElement('p')
        mesresponse.className = 'mesResponse'

        console.log(mesresponse);

        if (data.get('identifiant') && (data.get('password'))) {
            await fetch("../async/connexion.php", {
                method: 'POST',
                body: data,
            })
                .then(response => response.json())
                .then((resp) => {
                    if (resp.success == true) {
                        document.location.reload()
                    } else {
                        mesresponse.innerHTML = 'Identifiant ou mot de passe incorrect'
                        document.querySelector('.connexDiv').appendChild(mesresponse)
                        setTimeout(() => {
                            document.querySelector('.mesResponse').remove()
                        }, 2000)
                    }
                })
                .catch(error => console.log(error.message))
        } else {
            mesresponse.innerHTML = 'Merci de compléter tous les champs'
            document.querySelector('.connexDiv').appendChild(mesresponse)
            setTimeout(() => {
                document.querySelector('.mesResponse').remove()
            }, 2000)
        }
    })
}
// Création de nouveaux chantier

//ajout de nouveau champs files
var addFileButton = document.querySelector("#addFileButton")

addFileButton.addEventListener('click' , newFiles )
var count = 2

const divFile = document.querySelector('#fileInput')
function newFiles() {

    var div = document.createElement('div')
    div.className = 'fileInput'

    var inputFile = document.createElement('input')
    inputFile.type = 'file'
    inputFile.name = count
    inputFile.id = 'file'+count

    var inputReset = document.createElement('input')
    inputReset.type = 'button'
    inputReset.value = 'Reset'
    inputReset.name = 'file'+count
    //inputReset.setAttribute = ( "disable" ,"")
    inputReset.onclick = () => {
        console.log(inputReset.name);
        document.querySelector('#'+inputReset.name).value = ''}

    var opt1 = document.createElement("option")
    var opt2 = document.createElement("option")
    var opt3 = document.createElement("option")
    var opt4 = document.createElement("option")

    opt1.value = "sol"
    opt1.text = "Sol"

    opt2.value = "agencement"
    opt2.text = "Agencement"

    opt3.value = "rangement"
    opt3.text = "Rangement"

    opt4.value = "cuisine"
    opt4.text = "Cuisine"


    var selectForm = document.createElement('select')
    selectForm.name = 'file'+count
    selectForm.add(opt1 , null)
    selectForm.add(opt2 , null)
    selectForm.add(opt3 , null)
    selectForm.add(opt4 , null)

    div.appendChild(inputFile)
    div.appendChild(selectForm)
    div.appendChild(inputReset)
    count ++ 
    
    divFile.before(div)
}
//<input type="button" value="reset" onclick="document.querySelector('#file1').value = ''"></input>
// traitement de l'envoie des données
var addFileForms = document.querySelector("#addArticleForm")



addFileForms.addEventListener('submit' , async (event) => {
    event.preventDefault()
    var data = new FormData(addFileForms)
    
    await fetch("../async/createArticle.php", {
        method: 'POST',
        body: data,
    })
    .then(response => response.json())
                .then((resp) =>{console.log(resp);} )

})
