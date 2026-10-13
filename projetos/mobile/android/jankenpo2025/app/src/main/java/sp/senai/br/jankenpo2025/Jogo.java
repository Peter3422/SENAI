package sp.senai.br.jankenpo2025;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.TextView;
import android.widget.Toast;

import java.util.Random;

public class Jogo extends AppCompatActivity {
    RadioButton rbPedra, rbPapel, rbTesoura; //opções que podemos escolher no jogo
    ImageView ivCampo; //campo de batalha onde mostramos o resultado da partida
    int ContaTotal, ContaVitorias, ContaEmpates, ContaDerrotas; // contadores
    TextView txtTotal, txtVitorias, txtEmpates, txtDerrotas; // Mostra os totais
    RadioGroup rgEscolha; // limpar

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_jogo);

        //inicializa todas as variaveis
        rbPedra = findViewById(R.id.rbPedra);
        rbPapel = findViewById(R.id.rbPapel);
        rbTesoura = findViewById(R.id.rbTesoura);
        ivCampo = findViewById(R.id.ivCampo);
        txtTotal = findViewById(R.id.txtTotal);
        txtVitorias = findViewById(R.id.txtVitorias);
        txtEmpates = findViewById(R.id.txtEmpates);
        txtDerrotas = findViewById(R.id.txtDerrotas);
        rgEscolha = findViewById(R.id.rgEscolha);

        ContaTotal = 0;
        ContaVitorias = 0;
        ContaEmpates = 0;
        ContaDerrotas = 0;
    }

    public void instrucoes(View v) {
        Intent chamaTela = new Intent(this, Instrucoes.class);
        startActivity(chamaTela);
    }

    public void Jogar(View v) {
        int escolhaCPU, escolhaJogador;
        // 0 seria não escolhido, 1= pedra, 2= papel, 3= tesoura
        escolhaCPU = 0;
        escolhaJogador = 0;

        //toda vez que clicar no "Faça sua Escolha", conta mais 1 jogada
        ContaTotal++;

        //escolha do jogador
        if (rbPedra.isChecked()) {
            escolhaJogador = 1;
        } else if (rbPapel.isChecked()) {
            escolhaJogador = 2;
        } else if (rbTesoura.isChecked()) {
            escolhaJogador = 3;
        } else {
            Toast.makeText(this, "Escolha entre Pedra, Papel, Tesoura", Toast.LENGTH_SHORT).show();
        }

        if (escolhaJogador > 0) {
            //se o jogador escolheu, a CPU escolherá
            Random rand = new Random();
            escolhaCPU = rand.nextInt(3) + 1;

            //condições do jogo
            // empates
            if (escolhaJogador == 1 && escolhaCPU == 1) {
                ContaEmpates++;
                //troca imagem do campo de batalha
                ivCampo.setImageDrawable(getResources().getDrawable(R.drawable.pedra_pedra));
            } else if (escolhaJogador == 2 && escolhaCPU == 2) {
                ContaEmpates++;
                ivCampo.setImageDrawable(getResources().getDrawable(R.drawable.papel_papel));
            } else if (escolhaJogador == 3 && escolhaCPU == 3) {
                ContaEmpates++;
                ivCampo.setImageDrawable(getResources().getDrawable(R.drawable.tesoura_tesoura));
            }

            //condição de vitoria do jogador
            else if (escolhaJogador == 1 && escolhaCPU == 3) {
                ContaVitorias++;
                ivCampo.setImageDrawable(getResources().getDrawable(R.drawable.pedra_tesoura));
            } else if (escolhaJogador == 2 && escolhaCPU == 1) {
                ContaVitorias++;
                ivCampo.setImageDrawable(getResources().getDrawable(R.drawable.papel_pedra));
            }
            else if (escolhaJogador == 3 && escolhaCPU == 2) {
                ContaVitorias++;
                ivCampo.setImageDrawable(getResources().getDrawable(R.drawable.tesoura_papel));
            }

            //condição de derrota do jogador
            else if (escolhaJogador == 1 && escolhaCPU == 2) {
                ContaDerrotas++;
                ivCampo.setImageDrawable(getResources().getDrawable(R.drawable.pedra_papel));
            }else if (escolhaJogador == 2 && escolhaCPU == 3) {
                ContaDerrotas++;
                ivCampo.setImageDrawable(getResources().getDrawable(R.drawable.papel_tesoura));
            }else if (escolhaJogador == 3 && escolhaCPU == 1) {
                ContaDerrotas++;
                ivCampo.setImageDrawable(getResources().getDrawable(R.drawable.tesoura_pedra));
            }

            //atualiza os contadores de tela
            txtTotal.setText("Total Jogadas: " + ContaTotal);
            txtVitorias.setText("Vitórias: " + ContaVitorias);
            txtEmpates.setText("Empates: " + ContaEmpates);
            txtDerrotas.setText("Derrotas: " + ContaDerrotas);
        }
    }

    public void novo(View v){
        rgEscolha.clearCheck();
        ivCampo.setImageDrawable(getResources().getDrawable(R.drawable.campo_batalha));
    }
}