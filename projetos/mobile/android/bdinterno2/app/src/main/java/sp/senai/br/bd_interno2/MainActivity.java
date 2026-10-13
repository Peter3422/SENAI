package sp.senai.br.bd_interno2;

// MainActivity.java
import android.database.Cursor;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.SimpleCursorAdapter;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

public class MainActivity extends AppCompatActivity {

    EditText etNome, etDeficiencia, etDescricao, etNecessidades, etMedicacao;
    Button btnSalvar;
    ListView listView;

    DBHelper dbHelper;
    SimpleCursorAdapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        etNome = findViewById(R.id.etNome);
        etDeficiencia = findViewById(R.id.etDeficiencia);
        etDescricao = findViewById(R.id.etDescricao);
        etNecessidades = findViewById(R.id.etNecessidades);
        etMedicacao = findViewById(R.id.etMedicacao);
        btnSalvar = findViewById(R.id.btnSalvar);
        listView = findViewById(R.id.listViewDeficientes);

        dbHelper = new DBHelper(this);

        btnSalvar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                salvarDeficiente();
            }
        });

        carregarLista();
    }

    private void salvarDeficiente() {
        String nome = etNome.getText().toString().trim();
        String deficiencia = etDeficiencia.getText().toString().trim();
        String descricao = etDescricao.getText().toString().trim();
        String necessidades = etNecessidades.getText().toString().trim();
        String medicacao = etMedicacao.getText().toString().trim();

        if(nome.isEmpty() || deficiencia.isEmpty()) {
            Toast.makeText(this, "Nome e Deficiência são obrigatórios", Toast.LENGTH_SHORT).show();
            return;
        }

        long id = dbHelper.inserirDeficiente(nome, deficiencia, descricao, necessidades, medicacao);
        if (id != -1) {
            Toast.makeText(this, "Deficiente cadastrado com sucesso!", Toast.LENGTH_SHORT).show();
            limparCampos();
            carregarLista();
        } else {
            Toast.makeText(this, "Erro ao salvar.", Toast.LENGTH_SHORT).show();
        }
    }

    private void carregarLista() {
        Cursor cursor = dbHelper.listarDeficientes();
        String[] from = new String[] {DBHelper.COLUMN_NOME, DBHelper.COLUMN_DEFICIENCIA};
        int[] to = new int[] {android.R.id.text1, android.R.id.text2};

        adapter = new SimpleCursorAdapter(this,
                android.R.layout.simple_list_item_2,
                cursor,
                from,
                to,
                0);
        listView.setAdapter(adapter);
    }

    private void limparCampos() {
        etNome.setText("");
        etDeficiencia.setText("");
        etDescricao.setText("");
        etNecessidades.setText("");
        etMedicacao.setText("");
    }
}
