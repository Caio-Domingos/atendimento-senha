$(document).ready(function() {
  const m = moment().format('YYYY-MM-DD');
  console.log('moment', m);

  senhaAtual(m);
  cincoPrimeirasSenhas(m);
    setInterval(function() {
      senhaAtual(m);
      cincoPrimeirasSenhas(m)
    }, 1000);
});

function senhaAtual(data) {
  const url =
    'http://localhost/atendimento-senha/requests/pegarSenhaEmAtendimento.php';
  const obj = { date: data };
  $.post(url, obj, (data, status) => {
    // console.log('data', data);

    $('#senha-atual').text(data);
  });
}

function cincoPrimeirasSenhas(data) {
  const url =
    'http://localhost/atendimento-senha/requests/pegar5ProximasSenhas.php';
  const obj = { date: data };
  $.post(url, obj, (data, status) => {
    console.log('data', data);
    const json = JSON.parse(data);

    $('.proxima-senha').each((index, el) => {
      $(el).text(json[index] ? json[index] : 'Sem senha');
    });
  });
}
