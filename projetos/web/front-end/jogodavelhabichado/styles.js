function liberaStart() {
   if (document.getElementById("nomeJ1").value.length >= 3 && document.getElementById("nomeJ2").value.length >= 3) {
      document.getElementById("btStart").disabled = false;
   } else {
      document.getElementById("btStart").disabled = true;
   }
}
function start() {
   document.getElementById("formulario").style.display = "none";
   document.getElementById("tabuleiro").style.display = "block";
   document.getElementById("placar").style.display = "block";
   document.getElementById("logoSenai").style.width = "15vw";

   document.getElementById("PlacarNJ1").innerHTML = document.getElementById("nomeJ1").value;
   document.getElementById("PlacarNJ2").innerHTML = document.getElementById("nomeJ2").value;
}

function trocaImagemOut(id) {
   if (document.getElementById(id).src.slice(-16) == "img/Aula3_branco.jpg") {
      document.getElementById(id).src = "img/Aula3_cinza.jpg";
   }
}

PontosJ1 = 0; // Inicializa os pontos do jogador 1
PontosJ2 = 0; // Inicializa os pontos do jogador 2
jogadorAtivo = "J1"; // Inicializa o jogador ativo
finalJogo = 0;

 function selecionar(id) {
      if (finalJogo == 0) {
         if (document.getElementById(id).src.slice(-15) == "Aula3_cinza.jpg") {
            if (jogadorAtivo == "J1") {
               document.getElementById(id).src = "Aula3_livro.jpg";
               jogadorAtivo = "J2";
            } else {
               document.getElementById(id).src = "Aula3_monitor.jpg";
               jogadorAtivo = "J1";
            }
         }
      }
   }

function verificaVencedor() {
   if (finalJogo == 0) {
      if (document.getElementById("1").src == document.getElementById("2").src &&
         document.getElementById("1").src == document.getElementById("3").src &&
         document.getElementById("1").src.slice(-15) != "img/Aula3_branco.jpg") {
         if (document.getElementById("1").src.slice(-15) == "img/floppa.jpg") {
            PontosJ1++;
         } else {
            PontosJ2++;
            document.getElementById("PontosJ1").innerHTML = PontosJ1;
            document.getElementById("PontosJ2").innerHTML = PontosJ2;
            finalJogo = 1;
         }
      }
      else if (document.getElementById("3").src == document.getElementById("4").src &&
         document.getElementById("3").src == document.getElementById("5").src &&
         document.getElementById("3").src.slice(-15) != "img/Aula3_branco.jpg") {
         if (document.getElementById("3").src.slice(-15) == "img/floppa.jpg") {
            PontosJ1++;
         } else {
            PontosJ2++;
            document.getElementById("PontosJ1").innerHTML = PontosJ1;
            document.getElementById("PontosJ2").innerHTML = PontosJ2;
            finalJogo = 1;
         }
      }
      else if (document.getElementById("7").src == document.getElementById("8").src &&
         document.getElementById("7").src == document.getElementById("9").src &&
         document.getElementById("7").src.slice(-15) != "img/Aula3_branco.jpg") {
         if (document.getElementById("7").src.slice(-15) == "img/floppa.jpg") {
            PontosJ1++;
         } else {
            PontosJ2++;
            document.getElementById("PontosJ1").innerHTML = PontosJ1;
            document.getElementById("PontosJ2").innerHTML = PontosJ2;
            finalJogo = 1;
         }
      }


      else if (document.getElementById("1").src == document.getElementById("4").src &&
         document.getElementById("1").src == document.getElementById("7").src &&
         document.getElementById("1").src.slice(-15) != "img/Aula3_branco.jpg") {
         if (document.getElementById("1").src.slice(-15) == "img/floppa.jpg") {
            PontosJ1++;
         } else {
            PontosJ2++;
            document.getElementById("PontosJ1").innerHTML = PontosJ1;
            document.getElementById("PontosJ2").innerHTML = PontosJ2;
            finalJogo = 1;
         }
      }
      else if (document.getElementById("2").src == document.getElementById("5").src &&
         document.getElementById("2").src == document.getElementById("8").src &&
         document.getElementById("2").src.slice(-15) != "img/Aula3_branco.jpg") {
         if (document.getElementById("2").src.slice(-15) == "img/floppa.jpg") {
            PontosJ1++;
         } else {
            PontosJ2++;
            document.getElementById("PontosJ1").innerHTML = PontosJ1;
            document.getElementById("PontosJ2").innerHTML = PontosJ2;
            finalJogo = 1;
         }
      }
      else if (document.getElementById("3").src == document.getElementById("6").src &&
         document.getElementById("3").src == document.getElementById("9").src &&
         document.getElementById("3").src.slice(-15) != "img/Aula3_branco.jpg") {
         if (document.getElementById("3").src.slice(-15) == "img/floppa.jpg") {
            PontosJ1++;
         } else {
            PontosJ2++;
            document.getElementById("PontosJ1").innerHTML = PontosJ1;
            document.getElementById("PontosJ2").innerHTML = PontosJ2;
            finalJogo = 1;
         }
      }


      else if (document.getElementById("1").src == document.getElementById("5").src &&
         document.getElementById("1").src == document.getElementById("9").src &&
         document.getElementById("1").src.slice(-15) != "img/Aula3_branco.jpg") {
         if (document.getElementById("1").src.slice(-15) == "img/floppa.jpg") {
            PontosJ1++;
         } else {
            PontosJ2++;
            document.getElementById("PontosJ1").innerHTML = PontosJ1;
            document.getElementById("PontosJ2").innerHTML = PontosJ2;
            finalJogo = 1;
         }
      }
      else if (document.getElementById("3").src == document.getElementById("5").src &&
         document.getElementById("3").src == document.getElementById("7").src &&
         document.getElementById("3").src.slice(-15) != "img/Aula3_branco.jpg") {
         if (document.getElementById("3").src.slice(-15) == "img/floppa.jpg") {
            PontosJ1++;
         } else {
            PontosJ2++;
            document.getElementById("PontosJ1").innerHTML = PontosJ1;
            document.getElementById("PontosJ2").innerHTML = PontosJ2;
            finalJogo = 1;
         }
      }
   }
}

function trocaImagemOver(id) {
   if (document.getElementById(id).src.slice(-15) == "img/Aula3_cinza.jpg") {
      document.getElementById(id).src = "img/Aula3_branco.jpg";
   }
}