<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hellow, word</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
    <style>
        .row{
            margin: 0;
        }
    </style>
<body>

    <div class="row ">
        <div class="col-md-4 container">
            <div class="col-md-12 form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome">
            </div>
            <div class="col-md-12 form-group">
                <label for="login">Login</label>
                <input type="text" class="form-control" name="login" id="login">

            </div>
            <div class="col-md-12 form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" name="senha" id="senha">
            </div>
            <div class="col-md-12 form-group">
                <button class="btn btn-outline-success" onclick="cadastrar()">Salvar</button>

            </div>
        </div>

        <div class="col-md-8 container">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>LOGIN</th>
                        <th>SENHA</th>

                    </tr>
                </thead>
                <tbody id="lista">

                </tbody>
            </table>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        function cadastrar() {
            let nome  = document.querySelector('#nome').value
            let login = document.querySelector('#login').value
            let senha = document.querySelector('#senha').value

            $.ajax({
                url: './cadastrar.php',
                type: 'post',
                async: true,
                data: {
                    nome,
                    login,
                    senha
                },
                success: function(resultado) {
                    console.log(resultado)
                    if (resultado == 1) {
                        Swal.fire('Sucesso', 'Usuario cadastrado', 'success')
                    } else {
                        Swal.fire('Erro', 'Erro ao cadastrar usuario', 'error')
                    }
                },
                error: function(resultado) {
                    console.log(resultado)
                    Swal.fire('Erro', 'Erro ao cadastrar usuario', 'error')
                }
            })
            listarUsuario()
        }

        setInterval(() => {
          listarUsuario()
        }, 20000)

        function listarUsuario() {
                // quando carregar a pagina o javaScript fara  a requisicao ao back-end
                const lista = document.querySelector('#lista')
                lista.innerHTML = ''

                fetch('./listaUsuario.php', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'text/plain;charset=UTF-8'
                    },
                }).then(resultado => {
                    return resultado.json();
                }).then(result => {
                    console.log(result)

                    result.map((f) => {
                        let dados = `<td>${f.idusuario}</td>
                    <td>${f.nome}</td>
                    <td>${f.login}</td>
                    <td>${f.senha}</td>`

                        lista.innerHTML += dados
                    })
                })
            }
            //quando  a pagina carregar
            window.document.onload = listarUsuario()
    </script>
</body>

</html>