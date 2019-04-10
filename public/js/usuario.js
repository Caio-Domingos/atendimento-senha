$(document).ready(function() {
  $('#solicita-senha').click(event => {
    event.preventDefault();

    criarNovaSenha();
  });

  $('#gerar-outra-senha').click(event => {
    event.preventDefault();

    gerarOutraSenha();
  });

  $('#print').click(event => {
    event.preventDefault();

    window.print();
  });
});

function criarNovaSenha() {
  const url =
    'http://localhost/atendimento-senha/requests/insereNovoAtendimento.php';

  const date = moment()
    .set({
      hour: 00,
      minute: 00,
      second: 01
    })
    .format('YYYY-MM-DD');

  console.log(date);
  $.post(url, { date: date }, (data, status) => {
    console.log('data', data);
    console.log('status', status);

    $('#senha-gerada').text(data);

    $('#campo-senha-gerada').toggleClass('d-none');
    $('#gerar-senha').toggleClass('d-none');
    $('#gerar-senha').toggleClass('d-flex');
  });
}

function gerarOutraSenha() {
  $('#campo-senha-gerada').toggleClass('d-none');
  $('#gerar-senha').toggleClass('d-none');
  $('#gerar-senha').toggleClass('d-flex');
}
