package sp.senai.br.rpg;

public class RPGCharacter {
    private long id;
    private String nomePersonagem;
    private String classe;
    private int ataque;
    private int defesa;
    private int mana;
    private int nivel;
    private int xp;

    public RPGCharacter() {}

    public RPGCharacter(String nomePersonagem, String classe, int ataque, int defesa,
                        int mana, int nivel, int xp) {
        this.nomePersonagem = nomePersonagem;
        this.classe = classe;
        this.ataque = ataque;
        this.defesa = defesa;
        this.mana = mana;
        this.nivel = nivel;
        this.xp = xp;
    }

    public long getId() { return id; }
    public void setId(long id) { this.id = id; }

    public String getNomePersonagem() { return nomePersonagem; }
    public void setNomePersonagem(String nomePersonagem) { this.nomePersonagem = nomePersonagem; }

    public String getClasse() { return classe; }
    public void setClasse(String classe) { this.classe = classe; }

    public int getAtaque() { return ataque; }
    public void setAtaque(int ataque) { this.ataque = ataque; }

    public int getDefesa() { return defesa; }
    public void setDefesa(int defesa) { this.defesa = defesa; }

    public int getMana() { return mana; }
    public void setMana(int mana) { this.mana = mana; }

    public int getNivel() { return nivel; }
    public void setNivel(int nivel) { this.nivel = nivel; }

    public int getXp() { return xp; }
    public void setXp(int xp) { this.xp = xp; }

    @Override
    public String toString() {
        return nomePersonagem + " (" + classe + ") - Nv. " + nivel;
    }
}
