

//var username = document.getElementById("username");
// var email = document.getElementById("email");
// var password = document.getElementById("password");





//change pass admin :fonction "mdp()" pour vérifier si un mot de passecontient des lettres majuscules, minuscules,des chiffres ,des caracteres spaeciaux et de longueur min =8
function mdp() {
    var form = document.getElementById("formm");
    var password = document.getElementsByName('password')[0].value;

    if ((/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/.test(password)) == false) {



        // //on ajoute ceci pour eviter de faire login meme si le password est invalide 
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // empêche la soumission du formulaire

        });
        document.getElementById('sp-pass').innerHTML = 'Password must be at least 8caracters with contain upper and lower letters, numbers ,spaecial caracters';
    }

}

/*add+update admin*/

function chaine() {
    var name = document.getElementById("adminname");
    var form = document.getElementById('formm');

    if ((/^[a-zA-Z]+$/.test(name.value)) == false) {


        form.addEventListener('submit', function (e) {
            e.preventDefault(); // empêche la soumission du formulaire
        });

        document.getElementById('sp-name').innerHTML = 'Name must only contain letters';
    }
    // form.addEventListener('submit', chaine);
}


function chaine2() {
    var username = document.getElementById("adminusername");
    var form = document.getElementById('formm');

    if ((/^[a-zA-Z]+$/.test(username.value)) == false) {



        form.addEventListener('submit', function (e) {
            e.preventDefault(); // empêche la soumission du formulaire
        });

        document.getElementById('sp-username').innerHTML = 'Username must only contain letters';
    }
}

/*add+update category*/

function categTitle() {
    var category = document.getElementById("cat-title");
    var form = document.getElementById('formm');

    if ((/^[a-zA-Z]/.test(category.value)) == false) {



        form.addEventListener('submit', function (e) {
            e.preventDefault(); // empêche la soumission du formulaire
        });

        document.getElementById('sp-category').innerHTML = 'Category must only contain letters';
    }
}


/*add+update food*/ 

function foodTitle() {
    var food = document.getElementById("food-title");
    var form = document.getElementById('formm');

    if ((/^[a-zA-Z]/.test(food.value)) == false) {



        form.addEventListener('submit', function (e) {
            e.preventDefault(); // empêche la soumission du formulaire
        });

        document.getElementById('sp-food-title').innerHTML = 'Food Title must only contain letters';
    }
}

/*admin_order*/ 
function customerName() {
    var cus_name = document.getElementById("cus-name");
    var form = document.getElementById('formm');

    if ((/^[a-zA-Z]/.test(cus_name.value)) == false) {



        form.addEventListener('submit', function (e) {
            e.preventDefault(); // empêche la soumission du formulaire
        });

        document.getElementById('sp-customer').innerHTML = 'Customer Name must only contain letters';
    }
}

//tester validité du num telephone
function phone() {
    var tel = document.getElementById("tel");
    var form = document.getElementById('formm');

    if ((/^[0-9]{8}$/.test(tel.value)) == false) {



        form.addEventListener('submit', function (e) {
            e.preventDefault(); // empêche la soumission du formulaire
        });

        document.getElementById('sp-tel').innerHTML = ' Must only contain 8 numbers';
    }
}

//Tester un email valide ou non
function testMail() {
    var m = document.getElementById("mail");
    var form = document.getElementById('formm');

    if ((/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{3,}$/i.test(m.value))==false) {
      
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // empêche la soumission du formulaire
        });

        document.getElementById('sp-mail').innerHTML = "Entrer un format valid de mail Ex: xxxxx@gmail.com";
    }

}

// function nbr() {
//     var nbr = document.getElementById("nbr");
//     var form = document.getElementById('formm');

//     if ((/[0-9]{5}/.test(nbr.value)) == false) {



//         form.addEventListener('submit', function (e) {
//             e.preventDefault(); // empêche la soumission du formulaire
//         });

//         document.getElementById('sp-nbr').innerHTML = ' Must only contain numbers';
//     }
// }



