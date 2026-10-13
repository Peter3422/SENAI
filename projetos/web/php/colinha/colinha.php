<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema WMS - Cadastro de Produtos</title>
</head>

<body>
    <!-- o id do usuario usaremos para trabalhar no JS -->
    <form action="" method="POST" id="formulario">
        <input type="hidden" name="tipoBanco" id="tipoBanco">
        <?php
        // sao os 3 campos que vamos guardar no bd
        $codigoProduto = "";
        $nomeProduto = "";
        $descricaoProduto = "";

        // se clicarmos para "editar" um campo, ele libera alterar e excluir
        // a informações. Como o codigoProduto só existe quando vai editar
        // eu edito ele para descobrir se é uma edição
        if (isset($_POST["codigoProduto"])) {
            //puxo a informação do codigo da lista de dados cadastrados
            $codigoProduto = $_POST["codigoProduto"];

            // o tipoBanco C quer dizer que vc está editando a informação.
            // editar significa que vc está liberando a alteração e exclusão dos dados
            if ($_POST["tipoBanco"] == 'C') {
                // conexão com BD
                // Essa conexao é padrao, o que muda é o ip do servidor
                // - IP do servidor, - nome do BD dados, - user, - senha
                // $conexão será a instância (var) que respresentará o BD
                // 127.0.0.1 é seu próprio computador
                // pdo é a classe de conexão com o BD. PDO aceita varios BDs
                // de marcas diferentes, tipo Oracle, Mysql, etc
                $conexao = new PDO("mysql:host=127.0.0.1;dbname=sistemaWMS", "root", "");
                // para mostrar algum erro que pode ter, precisa deixar ativo 
                // o depurrador de erros
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // preenche as informações dos campos de nome do produto e descrição
                // do produto, baseadas no registro que vc quer editar
                $comandoSQL = $conexao->query("SELECT * FROM produto WHERE codigo = " . $codigoProduto);
                while ($linhaBD = $comandoSQL->fetch()) {
                    //cada campo do BD gera 1 coluna no array
                    // nomeProduto e descricaoProduto sao os input text que o usuario
                    // digita, logo , ele preenche os input text
                    $nomeProduto = $linhaBD["nome"];
                    $descricaoProduto = $linhaBD["descricao"];
                }
            }
        }
        ?>
        <input type="hidden" name="codigoProduto" id="codigoProduto">
        <table>
            <tr>
                <!-- criando o campo do nome do produto -->
                <td>Nome: </td>
                <!-- para poder puxar o valor do php, uso o codigo do value abaixo -->
                <!-- ID usarei no JS e name usarei no PHP -->
                <td><input type="text" name="nomeProduto" id="nomeProduto" value="<?php print $nomeProduto ?>"></td>
            </tr>
            <tr>
                <td>Descrição: </td>
                <td><input type="text" name="descricaoProduto" id="descricaoProduto"
                        value="<?php print $descricaoProduto ?>"></td>
            </tr>
            <!-- o botão de cadastrar (inserir) ele aparece quando nao tem codigo
             pois o codigo so aparece na opção do tipoBanco = C.
             As opções A e E (alterar/excluir) aparecem na opção tipoBanco = C -->
            <tr>
                <!-- colspan é mesclar (juntar) célilas na coluna. rowspan é na linha -->
                <td colspan="2">
                    <center>
                        <?php
                        //verifico se a var tipoBanco existe (la vez que rodar, ele não existe)
                        if (isset($_POST["tipoBanco"])) {
                            if ($_POST["tipoBanco"] == 'C') {
                                // nao coloco submit, pois trato os dados no JS
                                // no onclick, defino a chamada do JS
                                // o barra \", faz o PHP interpretar " como um texto comum
                                print "<input type='button' Value='Alterar' ONCLICK=\"banco('A', " . $codigoProduto . ")\"/>";
                                print "<input type='button' Value='Excluir' ONCLICK=\"banco('E', " . $codigoProduto . ")\"/>";
                            } else {
                                print "<input type='button' Value='Cadastrar' ONCLICK=\"banco('I', 0)\"/>";
                            }
                        } else {
                            print "<input type='button' Value='Cadastrar' ONCLICK=\"banco('I', 0)\"/>";
                        }
                        ?>
                    </center>
                </td>
            </tr>
        </table>
        <?php
        // faremos o cadastro, alteração, exclusão e seleção dos dados de produtos  
        // como codigoProduto só existe na alteração/exclusão, vou verificar o nome do produto
        // para vermos se devemos cadastrar aqui
        if (isset($_POST["nomeProduto"])) {
            // PDO é a classe para conectar ao BD. Ela se conecta a varios tipos de BD.
            // o mysql abaixo é p to´p dp BD que ele vai se conectar, o host é o ip do servidor,
            // no caso, 127.0.0.1 é o localhost (seu computador)
            $conexao = new PDO("mysql:host=127.0.0.1;dbname=sistemaWMS", "root", "");

            //pegar os dados do formulario que cadastramos
            $nomeProduto = $_POST["nomeProduto"];
            $descricaoProduto = $_POST["descricaoProduto"];

            // I = inserção, C = consulta, E = exclusão e A = alteração
            $tipoBanco = $_POST["tipoBanco"];

            // tipoBanco para fazer a inclusao dos dados
            if ($tipoBanco == "I") {
                //preparo os dados com o comando prepare
                // coloco os : antes das variaveis do BD, que depois serao substituidas pelo bindvalue
                $comandoSQL = $conexao->prepare("INSERT INTO produto(nome, descricao)" . "VALUES(:vNome, :vDescricao);");

                //acrescento as variaveis do BD atraves do bindvalue
                // com o comando bindvalue, nao terei problemas com sql injection
                $comandoSQL->bindValue(":vNome", $nomeProduto);
                $comandoSQL->bindValue(":vDescricao", $descricaoProduto);
                // executa o comando no banco de dados
                $comandoSQL->execute();
            } else if ($tipoBanco == "A") {
                //na alteração, muda o comando, mas a logica é a mesma
                $comandoSQL = $conexao->prepare("UPDATE produto " . "SET nome = :vNome, " . "descricao = :vDescricao " . "WHERE codigo = " . $codigoProduto);
                //aqui eu vou usar bindParam ao inves do bindvalue, neste caso, ambos fazem as mesmas coisas
                $comandoSQL->bindValue(":vNome", $nomeProduto);
                $comandoSQL->bindValue(":vDescricao", $descricaoProduto);
                $comandoSQL->execute();
            } else if ($tipoBanco == "E") {
                //na exclusao, nao passamos paramentros nem valores
                $comandoSQL = $conexao->prepare("DELETE FROM produto WHERE codigo = " . $codigoProduto);
                $comandoSQL->execute();
            }
        }

        //mostra os dados cadastrados na tabela de produtos e libera opção de consultar os dados
        // para poder alterar e exluir os dados
        $conexao = new PDO("mysql:host=127.0.0.1;dbname=sistemaWMS", "root", "");
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //como vamos realizar uma consulta de dados, nao usamos o prepare, usamos o comando query
        $comandoSQL = $conexao->query("SELECT * FROM produto;");

        //mostraremos os dados cadastrados
        // note que a primeira linha possui a ultima coluna vazia, pois colocaremos o botao de
        // consulta dos dados nesta posição, para posterior alteração e exclusao dos dados
        print "<table>";
        print "<tr><td>Código</td><td>Nome</td><td>Descrição</td><td></td></tr>";
        //para cada linha da tabela produto do banco, eu imprimo uma linha na table do html
        // $comandoSQL->fetch() pega uma linha do BD. Ao chamar novamente o comando, ele pega a proxima linha
        while ($linhaBD = $comandoSQL->fetch()) {
            print "<tr>";
            print "<td>" . $linhaBD["codigo"] . "</td>";
            print "<td>" . $linhaBD["nome"] . "</td>";
            print "<td>" . $linhaBD["descricao"] . "</td>";
            //coloca o botao de consulta para posterior alteração/exclusao dos dados
            print "<td><input type='button' Value='Editar' ONCLICK=\"banco('C'," . $linhaBD["codigo"] . ")\"/></td>";
            print "</tr>";
        }
        print "</table>";
        ?>
    </form>
</body>

</html>
<script>
    //função que faz o submit da pagina, setando as variaveis que utilizarei no codigo
    function banco(operacao, codProduto) {
        //aqui eu passo do php para o html
        document.getElementById("tipoBanco").value = operacao;
        document.getElementById("codigoProduto").value = codProduto;
        //envia a pagina pro php processar
        document.getElementById("formulario").submit();
    }
</script>
