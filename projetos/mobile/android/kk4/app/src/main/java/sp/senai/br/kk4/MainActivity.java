package sp.senai.br.kk4;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {

    EditText txtEntrada;
    TextView txtSaida;
    float num1, num2;
    String operacao;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        txtEntrada = findViewById(R.id.txtEntrada);
        txtSaida = findViewById(R.id.txtSaida);
    }
        public void clica(View v){
            if(v.getId() == R.id.btn9){
                txtEntrada.setText(txtEntrada.getText() + "9");
            }else if(v.getId() == R.id.btnmais){
                num1 = Integer.parseInt(txtEntrada.getText().toString());
                operacao = "+";
                txtEntrada.setText("");
            } else if (v.getId() == R.id.btnigual) {
                if(operacao == "+"){
                    txtEntrada.setText(num1 + num2 + "");
                } else if (operacao == "-") {
                    txtEntrada.setText(num1 - num2 + "");
                }
                num1 = 0;
                num2 = 0;
            }
        }
}nnmn