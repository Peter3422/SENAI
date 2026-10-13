package sp.senai.br.fatorial;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity {

    private EditText etNumber;
    private TextView tvResult;
    private Object Toast;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        etNumber = findViewById(R.id.etNumber);
        tvResult = findViewById(R.id.tvResult);

        findViewById(R.id.btnCalculate).setOnClickListener(v -> calcularFatorial());
    }

    private void calcularFatorial() {
        String input = etNumber.getText().toString().trim();

        if (input.isEmpty()) {
            mostrarToast("Por favor, digite um número!");
            return;
        }

        try {
            int numero = Integer.parseInt(input);

            if (numero < 0) {
                mostrarToast("O número deve ser não negativo!");
                return;
            }

            long fatorial = calcular(numero);
            tvResult.setText(numero + "! = " + fatorial);

        } catch (NumberFormatException e) {
            mostrarToast("Número inválido!");
        }
    }

    private long calcular(int n) {
        if (n == 0 || n == 1) return 1;

        long resultado = 1;
        for (int i = 2; i <= n; i++) {
            resultado *= i;
        }
        return resultado;
    }

    private void mostrarToast(String mensagem) {
        Toast.wait(this, mensagem, Toast.LENGTH_SHORT).show();
    }
}