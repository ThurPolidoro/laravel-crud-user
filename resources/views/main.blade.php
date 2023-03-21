<!doctype html>
<html lang="pt-br" data-them="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Painel de Clientes</title>
        @vite('resources/css/app.css')
    </head>
    <body data-current-page="pageCustomers">
        <nav class="navbar navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('assets/images/user.png') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top"> Painel de Clientes
                </a>
                <div class="d-flex">
                    <button type="button" class="btn btn-primary mx-2" id="listCustomer">Lista de Clientes</button>
                    <button type="button" class="btn btn-primary mx-2" id="addCustomer">Cadastrar Clientes</button>
                </div>
            </div>
        </nav>
        <div class="container py-5" id="screenCustomers">
            <h4 class="text-white">Lista de clientes</h4>
            <hr class="border-light">
            <div class="row">
                <table class="table table-dark table-striped" id="tableUser">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telefone</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container py-5" id="screenCustomer" style="display: none;">
            <h4 class="text-white">Cadastrar novo cliente</h4>
            <hr class="border-light">
            <form class="row g-3 text-white">
                <input type="hidden" name="id" id="idCustomer">
                <input type="hidden" name="_method" id="methodCustomer">
                <div class="col-12">
                    <label for="inputName" class="form-label">Nome</label>
                    <input required type="text" class="form-control" id="inputName" placeholder="Jhon Doe">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input required type="email" class="form-control" id="inputEmail" placeholder="example@mail.com">
                </div>
                <div class="col-md-6">
                    <label for="inputPhone" class="form-label">Telefone</label>
                    <input required type="text" class="form-control" id="inputPhone" maxlength="20" minlength="20" placeholder="+55 (00) 0 0000-0000" pattern="^(\+55\s)?\(\d{2}\)\s\d\s\d{4}-\d{4}$"  title="Por favor, insira um número de telefone válido">
                </div>
                <div class="col-12 d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
        @vite('resources/js/app.js')
    </body>
</html>
