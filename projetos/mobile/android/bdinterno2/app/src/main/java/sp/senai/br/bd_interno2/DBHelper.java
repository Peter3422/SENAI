package sp.senai.br.bd_interno2;
// DBHelper.java
import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.content.ContentValues;
import android.database.Cursor;

public class DBHelper extends SQLiteOpenHelper {
    private static final String DATABASE_NAME = "g1_deficientes.db";
    private static final int DATABASE_VERSION = 1;

    public static final String TABLE_NAME = "deficientes";
    public static final String COLUMN_ID = "_id";
    public static final String COLUMN_NOME = "nome";
    public static final String COLUMN_DEFICIENCIA = "deficiencia";
    public static final String COLUMN_DESCRICAO = "descricao";
    public static final String COLUMN_NECESSIDADES = "necessidades_especiais";
    public static final String COLUMN_MEDICACAO = "medicacao";

    public DBHelper(Context context) {
        super(context, DATABASE_NAME, null, DATABASE_VERSION);
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        String CREATE_TABLE = "CREATE TABLE " + TABLE_NAME + "("
                + COLUMN_ID + " INTEGER PRIMARY KEY AUTOINCREMENT,"
                + COLUMN_NOME + " TEXT,"
                + COLUMN_DEFICIENCIA + " TEXT,"
                + COLUMN_DESCRICAO + " TEXT,"
                + COLUMN_NECESSIDADES + " TEXT,"
                + COLUMN_MEDICACAO + " TEXT"
                + ")";
        db.execSQL(CREATE_TABLE);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_NAME);
        onCreate(db);
    }

    public long inserirDeficiente(String nome, String deficiencia, String descricao, String necessidades, String medicacao) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put(COLUMN_NOME, nome);
        values.put(COLUMN_DEFICIENCIA, deficiencia);
        values.put(COLUMN_DESCRICAO, descricao);
        values.put(COLUMN_NECESSIDADES, necessidades);
        values.put(COLUMN_MEDICACAO, medicacao);

        long id = db.insert(TABLE_NAME, null, values);
        db.close();
        return id;
    }

    public Cursor listarDeficientes() {
        SQLiteDatabase db = this.getReadableDatabase();
        String query = "SELECT * FROM " + TABLE_NAME;
        return db.rawQuery(query, null);
    }
}
