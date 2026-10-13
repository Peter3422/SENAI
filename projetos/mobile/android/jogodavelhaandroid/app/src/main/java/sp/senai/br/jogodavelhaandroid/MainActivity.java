package sp.senai.br.jogodavelhaandroid;

import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity {

    Button bt0, bt1, bt2, bt3, bt4, bt5, bt6, bt7, bt8, btReset;
    String jogadorVez;
    int[] jogadas = {-1, -2, -3, -4, -5, -6, -7, -8, -9};

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        bt0 = findViewById(R.id.bt0);
        bt1 = findViewById(R.id.bt1);
        bt2 = findViewById(R.id.bt2);
        bt3 = findViewById(R.id.bt3);
        bt4 = findViewById(R.id.bt4);
        bt5 = findViewById(R.id.bt5);
        bt6 = findViewById(R.id.bt6);
        bt7 = findViewById(R.id.bt7);
        bt8 = findViewById(R.id.bt8);
        btReset = findViewById(R.id.btReset);
        jogadorVez = "X";

        btReset.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                clickReset();
            }
        });
    }

    public void click(View v) {
        Button botaoClicado = findViewById(v.getId());
        botaoClicado.setText(jogadorVez);
        botaoClicado.setTextSize(70);

        int codigoVez = jogadorVez.equals("X") ? 1 : 0;

        // guarda a jogada
        if (v.getId() == R.id.bt0) jogadas[0] = codigoVez;
        else if (v.getId() == R.id.bt1) jogadas[1] = codigoVez;
        else if (v.getId() == R.id.bt2) jogadas[2] = codigoVez;
        else if (v.getId() == R.id.bt3) jogadas[3] = codigoVez;
        else if (v.getId() == R.id.bt4) jogadas[4] = codigoVez;
        else if (v.getId() == R.id.bt5) jogadas[5] = codigoVez;
        else if (v.getId() == R.id.bt6) jogadas[6] = codigoVez;
        else if (v.getId() == R.id.bt7) jogadas[7] = codigoVez;
        else if (v.getId() == R.id.bt8) jogadas[8] = codigoVez;

        botaoClicado.setEnabled(false);

        // condições de vitória
        if ((jogadas[0] == jogadas[1]) && (jogadas[1] == jogadas[2])) ganhou();
        else if ((jogadas[3] == jogadas[4]) && (jogadas[4] == jogadas[5])) ganhou();
        else if ((jogadas[6] == jogadas[7]) && (jogadas[7] == jogadas[8])) ganhou();
        else if ((jogadas[0] == jogadas[3]) && (jogadas[3] == jogadas[6])) ganhou();
        else if ((jogadas[1] == jogadas[4]) && (jogadas[4] == jogadas[7])) ganhou();
        else if ((jogadas[2] == jogadas[5]) && (jogadas[5] == jogadas[8])) ganhou();
        else if ((jogadas[2] == jogadas[4]) && (jogadas[4] == jogadas[6])) ganhou();
        else if ((jogadas[0] == jogadas[4]) && (jogadas[4] == jogadas[8])) ganhou();
        else {
            // troca de jogador
            jogadorVez = jogadorVez.equals("X") ? "0" : "X";
        }
    }

    public void ganhou() {
        // desabilita todos os botões
        bt0.setEnabled(false);
        bt1.setEnabled(false);
        bt2.setEnabled(false);
        bt3.setEnabled(false);
        bt4.setEnabled(false);
        bt5.setEnabled(false);
        bt6.setEnabled(false);
        bt7.setEnabled(false);
        bt8.setEnabled(false);

        Toast.makeText(this, "O jogador " + jogadorVez + " ganhou!", Toast.LENGTH_SHORT).show();
    }

    public void clickReset() {
        bt0.setText("Jogar"); bt0.setEnabled(true); bt0.setTextSize(14);
        bt1.setText("Jogar"); bt1.setEnabled(true); bt1.setTextSize(14);
        bt2.setText("Jogar"); bt2.setEnabled(true); bt2.setTextSize(14);
        bt3.setText("Jogar"); bt3.setEnabled(true); bt3.setTextSize(14);
        bt4.setText("Jogar"); bt4.setEnabled(true); bt4.setTextSize(14);
        bt5.setText("Jogar"); bt5.setEnabled(true); bt5.setTextSize(14);
        bt6.setText("Jogar"); bt6.setEnabled(true); bt6.setTextSize(14);
        bt7.setText("Jogar"); bt7.setEnabled(true); bt7.setTextSize(14);
        bt8.setText("Jogar"); bt8.setEnabled(true); bt8.setTextSize(14);

        jogadorVez = "X";
        jogadas = new int[]{-1, -2, -3, -4, -5, -6, -7, -8, -9};
    }
}
