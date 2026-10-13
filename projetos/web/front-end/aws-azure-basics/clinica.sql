CREATE DATABASE clinica
SELECT * FROM cds;
SELECT nome, data_compra FROM cds ORDER BY nome;
SELECT nome, data_compra FROM cds ORDER BY data_compra DESC;
SELECT SUM(preco) AS total_gasto FROM cds;
SELECT * FROM musicas WHERE cd_id = 1;
SELECT cds.nome AS nome_cd, musicas.nome AS nome_musica FROM cds JOIN musicas ON cds.id = musicas.cd_id;
SELECT nome, artista FROM musicas;
SELECT SUM(duracao) AS tempo_total FROM musicas;
SELECT numero, nome, duracao FROM musicas WHERE cd_id = 5 ORDER BY numero;
SELECT cd_id, SUM(duracao) AS tempo_total FROM musicas GROUP BY cd_id;
SELECT COUNT(*) AS quantidade_musicas FROM musicas;
SELECT AVG(duracao) AS media_duracao FROM musicas;
SELECT COUNT(*) AS quantidade_cds FROM cds;
SELECT nome FROM musicas WHERE artista = 'José Pedro';
SELECT cd_id, COUNT(*) AS quantidade_musicas FROM musicas GROUP BY cd_id;
SELECT nome FROM cds WHERE loja = 'Submarino';
SELECT cds.nome AS nome_cd, 
       (SELECT nome FROM musicas WHERE cd_id = cds.id ORDER BY numero LIMIT 1) AS primeira_musica 
FROM cds;
SELECT nome FROM musicas ORDER BY nome;
SELECT * FROM cds WHERE tipo = 'album';
SELECT * FROM cds ORDER BY preco DESC LIMIT 1;
