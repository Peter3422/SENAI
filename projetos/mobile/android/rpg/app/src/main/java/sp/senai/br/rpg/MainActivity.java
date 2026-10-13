package sp.senai.br.rpg;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Spinner;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.List;

public class MainActivity extends AppCompatActivity {

    private EditText txtNomePersonagem, txtAtaque, txtDefesa, txtMana, txtNivel, txtXP;
    private Spinner spinnerClasse;
    private Button btnGravar, btnLimpar;
    private ListView listaPersonagens;

    private CharacterDAO characterDAO;
    private List<RPGCharacter> characterList;
    private ArrayAdapter<RPGCharacter> adapter;

    private long editCharacterId = -1; // Controla edição

    private final String[] classes = {"Guerreiro", "Mago", "Arqueiro", "Paladino", "Ladino",
            "Clérigo", "Bárbaro", "Druida", "Feiticeiro", "Monge"};

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // Inicialização
        txtNomePersonagem = findViewById(R.id.txtNomePersonagem);
        spinnerClasse = findViewById(R.id.spinnerClasse);
        txtAtaque = findViewById(R.id.txtAtaque);
        txtDefesa = findViewById(R.id.txtDefesa);
        txtMana = findViewById(R.id.txtMana);
        txtNivel = findViewById(R.id.txtNivel);
        txtXP = findViewById(R.id.txtXP);
        btnGravar = findViewById(R.id.btnGravar);
        btnLimpar = findViewById(R.id.btnLimpar);
        listaPersonagens = findViewById(R.id.listaPersonagens);

        // Spinner
        ArrayAdapter<String> spinnerAdapter = new ArrayAdapter<>(this,
                android.R.layout.simple_spinner_item,
                classes);
        spinnerAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinnerClasse.setAdapter(spinnerAdapter);

        // DAO
        characterDAO = new CharacterDAO(this);

        // Lista e Adapter
        characterList = new ArrayList<>();
        adapter = new ArrayAdapter<>(this, android.R.layout.simple_list_item_1, characterList);
        listaPersonagens.setAdapter(adapter);

        // Carregar personagens do banco
        loadCharacters();

        // Clique para editar personagem
        listaPersonagens.setOnItemClickListener((adapterView, view, position, id) -> {
            RPGCharacter character = characterList.get(position);
            loadCharacterToForm(character);
        });

        // Clique longo para deletar
        listaPersonagens.setOnItemLongClickListener((adapterView, view, position, id) -> {
            RPGCharacter character = characterList.get(position);
            confirmDelete(character);
            return true;
        });

        btnGravar.setOnClickListener(v -> {
            if (validateInputs()) {
                saveOrUpdateCharacter();
            }
        });

        btnLimpar.setOnClickListener(v -> clearForm());
    }

    private void loadCharacters() {
        characterList.clear();
        characterList.addAll(characterDAO.getAllCharacters());
        adapter.notifyDataSetChanged();
    }

    private void loadCharacterToForm(RPGCharacter character) {
        txtNomePersonagem.setText(character.getNomePersonagem());
        txtAtaque.setText(String.valueOf(character.getAtaque()));
        txtDefesa.setText(String.valueOf(character.getDefesa()));
        txtMana.setText(String.valueOf(character.getMana()));
        txtNivel.setText(String.valueOf(character.getNivel()));
        txtXP.setText(String.valueOf(character.getXp()));

        // Selecionar classe no spinner
        for (int i = 0; i < classes.length; i++) {
            if (classes[i].equals(character.getClasse())) {
                spinnerClasse.setSelection(i);
                break;
            }
        }

        editCharacterId = character.getId();
        btnGravar.setText("Atualizar");
    }

    private void saveOrUpdateCharacter() {
        String nome = txtNomePersonagem.getText().toString().trim();
        String classe = spinnerClasse.getSelectedItem().toString();
        int ataque = Integer.parseInt(txtAtaque.getText().toString());
        int defesa = Integer.parseInt(txtDefesa.getText().toString());
        int mana = Integer.parseInt(txtMana.getText().toString());
        int nivel = Integer.parseInt(txtNivel.getText().toString());
        int xp = Integer.parseInt(txtXP.getText().toString());

        RPGCharacter character = new RPGCharacter(nome, classe, ataque, defesa, mana, nivel, xp);

        if (editCharacterId == -1) {
            // Inserção
            long result = characterDAO.insertCharacter(character);
            if (result != -1) {
                Toast.makeText(this, "Personagem adicionado!", Toast.LENGTH_SHORT).show();
                clearForm();
                loadCharacters();
            } else {
                Toast.makeText(this, "Erro ao adicionar personagem!", Toast.LENGTH_SHORT).show();
            }
        } else {
            // Atualização
            character.setId(editCharacterId);
            int result = characterDAO.updateCharacter(character);
            if (result > 0) {
                Toast.makeText(this, "Personagem atualizado!", Toast.LENGTH_SHORT).show();
                clearForm();
                loadCharacters();
                editCharacterId = -1;
                btnGravar.setText("Gravar");
            } else {
                Toast.makeText(this, "Erro ao atualizar personagem!", Toast.LENGTH_SHORT).show();
            }
        }
    }

    private void confirmDelete(RPGCharacter character) {
        new AlertDialog.Builder(this)
                .setTitle("Excluir Personagem")
                .setMessage("Deseja realmente excluir " + character.getNomePersonagem() + "?")
                .setPositiveButton("Sim", (dialog, which) -> {
                    int result = characterDAO.deleteCharacter(character.getId());
                    if (result > 0) {
                        Toast.makeText(this, "Personagem excluído!", Toast.LENGTH_SHORT).show();
                        loadCharacters();
                    } else {
                        Toast.makeText(this, "Erro ao excluir personagem", Toast.LENGTH_SHORT).show();
                    }
                    dialog.dismiss();
                })
                .setNegativeButton("Não", null)
                .show();
    }

    private boolean validateInputs() {
        if (txtNomePersonagem.getText().toString().trim().isEmpty()) {
            txtNomePersonagem.setError("Campo obrigatório");
            return false;
        }
        if (txtAtaque.getText().toString().trim().isEmpty()) {
            txtAtaque.setError("Campo obrigatório");
            return false;
        }
        if (txtDefesa.getText().toString().trim().isEmpty()) {
            txtDefesa.setError("Campo obrigatório");
            return false;
        }
        if (txtMana.getText().toString().trim().isEmpty()) {
            txtMana.setError("Campo obrigatório");
            return false;
        }
        if (txtNivel.getText().toString().trim().isEmpty()) {
            txtNivel.setError("Campo obrigatório");
            return false;
        }
        if (txtXP.getText().toString().trim().isEmpty()) {
            txtXP.setError("Campo obrigatório");
            return false;
        }
        return true;
    }

    private void clearForm() {
        txtNomePersonagem.setText("");
        txtAtaque.setText("");
        txtDefesa.setText("");
        txtMana.setText("");
        txtNivel.setText("");
        txtXP.setText("");
        spinnerClasse.setSelection(0);
        btnGravar.setText("Gravar");
        editCharacterId = -1;
    }
}
