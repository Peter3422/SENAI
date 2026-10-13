package sp.senai.br.rpg;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

public class DatabaseHelper extends SQLiteOpenHelper {

    private static final String DATABASE_NAME = "rpg_database.db";
    private static final int DATABASE_VERSION = 1;

    public static final String TABLE_NAME = "rpg_character";
    public static final String COLUMN_ID = "_id";
    public static final String COLUMN_NOME = "nome_personagem";
    public static final String COLUMN_CLASSE = "classe";
    public static final String COLUMN_ATAQUE = "ataque";
    public static final String COLUMN_DEFESA = "defesa";
    public static final String COLUMN_MANA = "mana";
    public static final String COLUMN_NIVEL = "nivel";
    public static final String COLUMN_XP = "xp";

    private static final String CREATE_TABLE = "CREATE TABLE " + TABLE_NAME + " (" +
            COLUMN_ID + " INTEGER PRIMARY KEY AUTOINCREMENT, " +
            COLUMN_NOME + " TEXT NOT NULL, " +
            COLUMN_CLASSE + " TEXT NOT NULL, " +
            COLUMN_ATAQUE + " INTEGER NOT NULL, " +
            COLUMN_DEFESA + " INTEGER NOT NULL, " +
            COLUMN_MANA + " INTEGER NOT NULL, " +
            COLUMN_NIVEL + " INTEGER NOT NULL, " +
            COLUMN_XP + " INTEGER NOT NULL);";

    public DatabaseHelper(Context context) {
        super(context, DATABASE_NAME, null, DATABASE_VERSION);
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        db.execSQL(CREATE_TABLE);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        // Para futuras atualizações de esquema
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_NAME);
        onCreate(db);
    }
}

