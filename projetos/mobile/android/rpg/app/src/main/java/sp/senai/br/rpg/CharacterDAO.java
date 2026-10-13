package sp.senai.br.rpg;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import java.util.ArrayList;
import java.util.List;

public class CharacterDAO {

    private DatabaseHelper dbHelper;

    public CharacterDAO(Context context) {
        dbHelper = new DatabaseHelper(context);
    }

    public long insertCharacter(RPGCharacter character) {
        SQLiteDatabase db = dbHelper.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put(DatabaseHelper.COLUMN_NOME, character.getNomePersonagem());
        values.put(DatabaseHelper.COLUMN_CLASSE, character.getClasse());
        values.put(DatabaseHelper.COLUMN_ATAQUE, character.getAtaque());
        values.put(DatabaseHelper.COLUMN_DEFESA, character.getDefesa());
        values.put(DatabaseHelper.COLUMN_MANA, character.getMana());
        values.put(DatabaseHelper.COLUMN_NIVEL, character.getNivel());
        values.put(DatabaseHelper.COLUMN_XP, character.getXp());
        long result = db.insert(DatabaseHelper.TABLE_NAME, null, values);
        db.close();
        return result;
    }

    public List<RPGCharacter> getAllCharacters() {
        List<RPGCharacter> list = new ArrayList<>();
        SQLiteDatabase db = dbHelper.getReadableDatabase();

        Cursor cursor = db.query(DatabaseHelper.TABLE_NAME,
                null, null, null, null, null,
                DatabaseHelper.COLUMN_NOME + " ASC");

        if (cursor.moveToFirst()) {
            do {
                RPGCharacter character = new RPGCharacter();
                character.setId(cursor.getLong(cursor.getColumnIndexOrThrow(DatabaseHelper.COLUMN_ID)));
                character.setNomePersonagem(cursor.getString(cursor.getColumnIndexOrThrow(DatabaseHelper.COLUMN_NOME)));
                character.setClasse(cursor.getString(cursor.getColumnIndexOrThrow(DatabaseHelper.COLUMN_CLASSE)));
                character.setAtaque(cursor.getInt(cursor.getColumnIndexOrThrow(DatabaseHelper.COLUMN_ATAQUE)));
                character.setDefesa(cursor.getInt(cursor.getColumnIndexOrThrow(DatabaseHelper.COLUMN_DEFESA)));
                character.setMana(cursor.getInt(cursor.getColumnIndexOrThrow(DatabaseHelper.COLUMN_MANA)));
                character.setNivel(cursor.getInt(cursor.getColumnIndexOrThrow(DatabaseHelper.COLUMN_NIVEL)));
                character.setXp(cursor.getInt(cursor.getColumnIndexOrThrow(DatabaseHelper.COLUMN_XP)));
                list.add(character);
            } while (cursor.moveToNext());
        }

        cursor.close();
        db.close();
        return list;
    }

    public int updateCharacter(RPGCharacter character) {
        SQLiteDatabase db = dbHelper.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put(DatabaseHelper.COLUMN_NOME, character.getNomePersonagem());
        values.put(DatabaseHelper.COLUMN_CLASSE, character.getClasse());
        values.put(DatabaseHelper.COLUMN_ATAQUE, character.getAtaque());
        values.put(DatabaseHelper.COLUMN_DEFESA, character.getDefesa());
        values.put(DatabaseHelper.COLUMN_MANA, character.getMana());
        values.put(DatabaseHelper.COLUMN_NIVEL, character.getNivel());
        values.put(DatabaseHelper.COLUMN_XP, character.getXp());

        String whereClause = DatabaseHelper.COLUMN_ID + " = ?";
        String[] whereArgs = {String.valueOf(character.getId())};
        int result = db.update(DatabaseHelper.TABLE_NAME, values, whereClause, whereArgs);
        db.close();
        return result;
    }

    public int deleteCharacter(long id) {
        SQLiteDatabase db = dbHelper.getWritableDatabase();
        String whereClause = DatabaseHelper.COLUMN_ID + " = ?";
        String[] whereArgs = {String.valueOf(id)};
        int result = db.delete(DatabaseHelper.TABLE_NAME, whereClause, whereArgs);
        db.close();
        return result;
    }
}
