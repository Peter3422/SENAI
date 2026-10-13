package sp.senai.br.jankenpo2025;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
    }

    public void Iniciar(View v){
        Intent chamaTela = new Intent(this, Jogo.class);
        startActivity(chamaTela);

        finish();
    }
}