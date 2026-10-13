<section class="diario">
    <h2>Registrar Sonho</h2>

    <?php if (!empty($message)): ?>
        <div class="alert"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>

        <label for="data">Data:</label>
        <input type="date" id="data" name="data" required>

        <label for="hora">Hora:</label>
        <input type="time" id="hora" name="hora">

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" rows="5"></textarea>

        <label for="emocao">Emoção:</label>
        <input type="text" id="emocao" name="emocao">

        <label for="nivel_clareza">Nível de clareza (1–5):</label>
        <input type="number" id="nivel_clareza" name="nivel_clareza" min="1" max="5" value="3">

        <label for="palavras_chave">Palavras-chave:</label>
        <input type="text" id="palavras_chave" name="palavras_chave">

        <button type="submit">Registrar Sonho</button>
    </form>
</section>
