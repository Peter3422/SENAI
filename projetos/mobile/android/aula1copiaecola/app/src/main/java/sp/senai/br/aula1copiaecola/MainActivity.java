package sp.senai.br.aula1copiaecola;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {

    EditText txtCopia;
    TextView txtCola;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // puxa os campos da tela para cá(Java)
        txtCopia = findViewById(R.id.txtCopia);
        txtCola =findViewById(R.id.txtCola);
    }

    public void clicaBotao(View v){
        txtCola.setText(txtCopia.getText());
    }
}