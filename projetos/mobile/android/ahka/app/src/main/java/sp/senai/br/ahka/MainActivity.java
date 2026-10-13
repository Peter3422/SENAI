package sp.senai.br.ahka;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity {

    EditText txtNasc;
    TextView txtResposta;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        txtNasc = findViewById(R.id.txtNasc);
        txtResposta = findViewById(R.id.txtResposta);
    }

    public void calcularIdade(View V){
        String anoNascTexto = txtNasc.getText().toString();
        int anoNascInt = Integer.parseInt(anoNascTexto);

        int idade = 2025 - anoNascInt;

        txtResposta.setText("sua idade é: " + String.valueOf(idade));

        Toast.makeText(this, "Sua idade é: ", Toast.LENGTH_SHORT).show();
    }
}