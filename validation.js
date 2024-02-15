let nom = document.querySelector("#nom");
let divNom = document.querySelector("#divNom");
let prenom = document.querySelector("#prenom");
let divPrenom = document.querySelector("#divPrenom");
let email = document.querySelector("#email");
let divEmail = document.querySelector("#divEmail");
let photo_profil = document.querySelector("#photo_profil");
let description = document.querySelector("#description");


verifyVarchar(nom, divNom);
verifyVarchar(prenom, divPrenom);

email.addEventListener("change", async (e) =>{

    if(document.querySelector("#" + email.id + "Error")){
        document.querySelector("#" + email.id + "Error").remove();
        email.classList.remove("border-red-400");
    }

    if (!email.value.includes('@') || !email.value.includes('.')){
        let para = document.createElement('p');
        para.id = email.id + "Error";
        let paraContent = document.createTextNode("Mail invalid format");
        para.appendChild(paraContent);
        divEmail.appendChild(para);
        email.classList.add("border-red-400");
    } else if (await emailableAddress(email.value)){
        console.log("Address OK");
    } else {
        let para = document.createElement('p');
        para.id = email.id + "Error";
        let paraContent = document.createTextNode("Can't deliver mail to that address");
        para.appendChild(paraContent);
        divEmail.appendChild(para);
        email.classList.add("border-red-400");
    }
})

function verifyVarchar(element, div){
    element.addEventListener("change", (e) =>{

        if(document.querySelector("#" + element.id + "Error")){
            document.querySelector("#" + element.id + "Error").remove();
            element.classList.remove("border-red-400");
        }

        if (element.value.length < 2 || element.value.length >= 255){
            
            let para = document.createElement('p');
            para.id = element.id + "Error";
            let paraContent = document.createTextNode("Must be at least 2 characters");
            para.appendChild(paraContent);
            div.appendChild(para);
            element.classList.add("border-red-400");
           
        }
    })
}

async function emailableAddress(mailAddress){
    try{
        let response = await fetch ("https://api.emailable.com/v1/verify?email=" + mailAddress + "&api_key=test_26341094598b34af2799")
        let emailable = await response.json();
        
        if (emailable.score > 50){
            return true;
        } else {
            return false;
        }

    } catch (error){
        console.log(error);
    }
}
