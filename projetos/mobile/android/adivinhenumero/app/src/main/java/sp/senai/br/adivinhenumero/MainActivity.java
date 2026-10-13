package sp.senai.br.adivinhenumero;


import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import java.util.Random;

public class MainActivity extends AppCompatActivity {

    TextView txtResultado, txtTentativas, txtRestantes;
    EditText txtNumDig;
    int numsort, numDig, numRestantes;
    Button botao, botaoReiniciar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        txtResultado = findViewById(R.id.txtResultado);
        txtTentativas = findViewById(R.id.txtTentativas);
        txtRestantes = findViewById(R.id.txtRestantes);
        txtNumDig = findViewById(R.id.txtNumDig);
        botao = findViewById(R.id.button);
        botaoReiniciar = findViewById(R.id.btreiniciar);

        Random sorteador = new Random();
        numsort = sorteador.nextInt(99) + 1; // para não sortear zeros
        numRestantes = 10;
    }

    public void tentar(View v){
        numDig = Integer.parseInt(txtNumDig.getText().toString());
        txtTentativas.setText(txtTentativas.getText() + String.valueOf(numDig) + " - ");
        if(numsort == numDig){
            txtResultado.setText("Acertou!");
        }else if ((numsort < numDig) && (numsort > numDig-10)){
            txtResultado.setText("Número digitado está um pouco acima do número sorteado!");
        }else if ((numsort > numDig) && (numsort < numDig+10)){
            txtResultado.setText("Número digitado está um pouco abaixo do número sorteado!");
        }else if(numsort < numDig){
            txtResultado.setText("Número digitado está acima do número sorteado!");
        }else{
            txtResultado.setText("Número digitado está abaixo do número sorteado!");
        }



        numRestantes--;

        txtRestantes.setText("Tentativas Restantes: " + String.valueOf(numRestantes));
    }


    public void iniciarJogo(View v) {
        Random sorteador = new Random();
        numsort = sorteador.nextInt(99) + 1; // para não sortear zeros
        numRestantes = 10;
        txtTentativas.setText("");
        txtResultado.setText("");
        txtRestantes.setText("Tentativas Restantes: " + numRestantes);
        txtNumDig.setText("");
    }
}