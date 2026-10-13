function liberaStart() {
    if (document.getElementById("nomeJ1").value.length >= 3 && document.getElementById("nomeJ2").value.length >= 3) {
        document.getElementById("btStart").disabled = false;
    } else {
        document.getElementById("btStart").disabled = true;
    }
}
function start(){
    document.getElementById("formulario").style.display = "none";
    document.getElementById("tabuleiro").style.display = "block";
    document.getElementById("placar").style.display = "block";
    document.getElementById("logoSenai").style.width = "15vw";
    
    document.getElementById("PlacarNJ1").innerHTML = ;
    document.getElementById("nomeJ1").value = ;
    
    document.getElementById("PlacarNJ2").innerHTML = ;
    document.getElementById("nomeJ2").value = ;
}