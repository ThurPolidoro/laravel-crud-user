import './bootstrap';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var table;


$(document).ready(function () {
    table = new DataTable('#tableUser', {
        responsive: true,
        language: {
            url: "/assets/json/ptBr.json"
        },
        columns: [
            {data: 'id', title: 'ID'},
            {data: 'name', title: 'Nome'},
            {data: 'email', title: 'E-mail'},
            {data: 'phone', title: 'Telefone'},
            {data: 'button', title: '', orderable: false },
        ]
    });

    loadCustomers();

    $('#inputPhone').mask('+55 (00) 0 0000-0000');
});


$('#addCustomer').on('click', function(){
    $('#idCustomer').val('');
    $('#methodCustomer').val('POST');
    $('#inputName').val('');
    $('#inputEmail').val('');
    $('#inputPhone').val('');

    $('#screenCustomer h4').text(`Cadastrando novo cliente`);
    $('#screenCustomer button').text('Salvar');

    $('#screenCustomers').hide();
    $('#screenCustomer').show();
});


$('#listCustomer').on('click', function(){
    $('#screenCustomer').hide();
    $('#screenCustomers').show();
});

$('form').on('submit', function (e) {
    e.preventDefault();
    saveCustomer();
});

window.editCustomer = function(id) {
    $.getJSON(`/v1/customers/${id}`, function (response) {
        $('#idCustomer').val(id);
        $('#methodCustomer').val('PUT');
        $('#inputName').val(response.data.name);
        $('#inputEmail').val(response.data.email);
        $('#inputPhone').val(response.data.phone);

        $('#screenCustomer h4').text(`Editando o cliente: ${response.data.name} (${response.data.id})`);
        $('#screenCustomer button').text('Salvar');

        $('#screenCustomers').hide();
        $('#screenCustomer').show();
    });
}

function saveCustomer() {
    let id = $('#idCustomer').val();
    let _token = $('meta[name="csrf-token"]').attr('content');
    let method = $('#methodCustomer').val();
    let name = $('#inputName').val();
    let email = $('#inputEmail').val();
    let phone = $('#inputPhone').val();

    let url = (method === 'POST') ? `/v1/customers` : `/v1/customers/${id}`;
    let data = {
        _token,
        name,
        email,
        phone,
    };

    $.ajax({
        type: method,
        url: url,
        data: data,
        dataType: "json",
        success: function (response) {
            Swal.fire({
                icon: 'success',
                title: 'Successo!',
                text: response.message
            });

            if(method === 'POST')
                createLine(response.data)
            else
                updateLine(response.data)

            $('#listCustomer').click();

        },
        error: function (response) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: response.responseJSON.message
            })
        }
    });
}

function removeLine(id)
{
    table.row(`#client-${id}`).remove().draw();
}

function updateLine(el)
{
    let buttons = makeButtons(el.id);

    var updateRowData = {
        "id": el.id,
        "name": el.name,
        "email": el.email,
        "phone": el.phone,
        "button": buttons
    };

    table.row(`#client-${el.id}`).data(updateRowData).draw(false);
}

function createLine(el)
{
    let buttons = makeButtons(el.id);

    var newRowData = {
        "id": el.id,
        "name": el.name,
        "email": el.email,
        "phone": el.phone,
        "button": buttons
    };

    var newRow = table.row.add(newRowData).draw().node();
    $(newRow).attr('id', `client-${el.id}`);
}

window.deleteCustomer = function(id) {
    Swal.fire({
        title: 'Você tem certeza disso?',
        text: "Após excluir este cliente você não poderá reverter!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, desejo prosseguir!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "DELETE",
                url: `/v1/customers/${id}`,
                dataType: "json",
                success: function (response) {
                   Swal.fire({
                        icon: 'success',
                        title: 'Successo!',
                        text: response.message
                   });

                   removeLine(id);
                },
                error: function(response) {
                   Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: response.responseJSON.message
                   });
                }
            });
        }
    });
}

function loadCustomers()
{
    $.getJSON("/v1/customers", function (response) {
        for (let i = 0; i < response.data.length; i++) {
            const el = response.data[i];
            createLine(el);
        }
    });
}

function makeButtons(id){
    let buttonEdit = `<button type="button" class="btn btn-primary mx-1" onclick="editCustomer(${id})"><i class="bi bi-pencil-fill"></i></button>`;
    let buttonDelete = `<button type="button" class="btn btn-danger mx-1" onclick="deleteCustomer(${id})"><i class="bi bi-trash3-fill"></i></button>`;

    return `<div class="d-flex">${buttonEdit} ${buttonDelete}</div>`;
}
