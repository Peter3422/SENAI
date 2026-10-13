package sp.senai.br.genius2025;

import androidx.appcompat.app.AppCompatActivity;

import android.graphics.Color;
import android.media.AudioManager;
import android.media.ToneGenerator;
import android.os.Bundle;
import android.os.CountDownTimer;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.List;
import java.util.Random;

public class MainActivity extends AppCompatActivity {

    Button btComecar, btVermelho, btVerde, btAmarelo, btAzul;
    List<Integer> ListaPiscaBotao = new ArrayList<Integer>(); // lista dos botões sorteados
    ToneGenerator geradorSom = new ToneGenerator(AudioManager.STREAM_MUSIC, 100);
    int posicaoListaPiscaBotao;

    int pontuacaoAtual = 0;
    int recorde = 0;
    List<Integer> ranking = new ArrayList<>();

    TextView txtPontuacao, txtRecorde;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        btComecar  = findViewById(R.id.btComecar);
        btAmarelo  = findViewById(R.id.btAmarelo);
        btAzul     = findViewById(R.id.btAzul);
        btVerde    = findViewById(R.id.btVerde);
        btVermelho = findViewById(R.id.btVermelho);

        txtPontuacao = findViewById(R.id.txtPontuacao);
        txtRecorde = findViewById(R.id.txtRecorde);

        iniciar();
    }

    public void iniciar(){
        ListaPiscaBotao.clear();    //reiniciar a posição da ListaPiscaBotao
        posicaoListaPiscaBotao = 0;
        pontuacaoAtual = 0;
        atualizarPlacar();

        btComecar.setEnabled(true);
        btComecar.setBackgroundColor(Color.parseColor("#7F00FF"));
    }

    public void atualizarPlacar() {
        txtPontuacao.setText("Pontuação: " + pontuacaoAtual);
        txtRecorde.setText("Recorde: " + recorde);
    }

    public void clickIniciar(View v){
        comecar();
    }

    public void comecar(){
        // sorteia uma cor
        Random sorteador = new Random();
        int botaoSorteado = sorteador.nextInt(4);
        ListaPiscaBotao.add(botaoSorteado);

        posicaoListaPiscaBotao = 0;

        btComecar.setEnabled(false);
        btComecar.setBackgroundColor(Color.parseColor("#257F00FF"));

        new CountDownTimer(ListaPiscaBotao.size() * 750, 250) {
            int cont;
            int passada = 0;

            @Override
            public void onTick(long l) {
                if(passada < 2) {
                    if(ListaPiscaBotao.get(cont) == 0){
                        btVermelho.setBackgroundColor(Color.parseColor("#50000000"));
                        geradorSom.startTone(ToneGenerator.TONE_CDMA_ABBR_ALERT, 250);
                    }else if(ListaPiscaBotao.get(cont) == 1){
                        btVerde.setBackgroundColor(Color.parseColor("#50000000"));
                        geradorSom.startTone(ToneGenerator.TONE_CDMA_ALERT_INCALL_LITE, 250);
                    }else if(ListaPiscaBotao.get(cont) == 2){
                        btAzul.setBackgroundColor(Color.parseColor("#50000000"));
                        geradorSom.startTone(ToneGenerator.TONE_CDMA_ABBR_INTERCEPT, 250);
                    }else{
                        btAmarelo.setBackgroundColor(Color.parseColor("#50000000"));
                        geradorSom.startTone(ToneGenerator.TONE_CDMA_ABBR_REORDER, 250);
                    }
                    passada++;
                }else{
                    btVermelho.setBackgroundColor(Color.parseColor("#FC0000"));
                    btVerde.setBackgroundColor(Color.parseColor("#2DFF00"));
                    btAzul.setBackgroundColor(Color.parseColor("#0043FF"));
                    btAmarelo.setBackgroundColor(Color.parseColor("#FFDF01"));

                    cont++;
                    passada = 0;
                }
            }

            @Override
            public void onFinish() {
            }
        }.start();
    }

    public void clickCor(View v){
        int numBotao = -1;

        // Botão pisca visualmente
        v.setAlpha(0.5f);
        v.postDelayed(() -> v.setAlpha(1.0f), 200);

        if(v.getId() == R.id.btVermelho){
            geradorSom.startTone(ToneGenerator.TONE_CDMA_ABBR_ALERT, 250);
            numBotao = 0;
        }else if(v.getId() == R.id.btVerde){
            geradorSom.startTone(ToneGenerator.TONE_CDMA_ALERT_INCALL_LITE, 250);
            numBotao = 1;
        }else if(v.getId() == R.id.btAzul){
            geradorSom.startTone(ToneGenerator.TONE_CDMA_ABBR_INTERCEPT, 250);
            numBotao = 2;
        }else if(v.getId() == R.id.btAmarelo){
            geradorSom.startTone(ToneGenerator.TONE_CDMA_ABBR_REORDER, 250);
            numBotao = 3;
        }

        if(posicaoListaPiscaBotao < ListaPiscaBotao.size()){
            if(ListaPiscaBotao.get(posicaoListaPiscaBotao) != numBotao){
                ranking.add(pontuacaoAtual);
                ranking.sort((a, b) -> b - a);

                StringBuilder sb = new StringBuilder();
                sb.append("ERROU! Você conseguiu chegar no nível ").append(pontuacaoAtual);
                sb.append("\n--- RANKING ---");

                for(int i = 0; i < Math.min(5, ranking.size()); i++) {
                    sb.append("\n").append(i + 1).append("º: ").append(ranking.get(i)).append(" pontos");
                }

                Toast.makeText(this, sb.toString(), Toast.LENGTH_LONG).show();
                iniciar();
            }else{
                posicaoListaPiscaBotao++;
                if(posicaoListaPiscaBotao == ListaPiscaBotao.size()){
                    pontuacaoAtual++;
                    if(pontuacaoAtual > recorde){
                        recorde = pontuacaoAtual;
                    }
                    atualizarPlacar();

                    new CountDownTimer(500, 500) {
                        @Override
                        public void onTick(long l) {
                        }
                        @Override
                        public void onFinish() {
                            comecar();
                        }
                    }.start();
                }
            }
        }
    }
}
