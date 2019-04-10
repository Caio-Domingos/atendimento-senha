$(document).ready(function() {
  const m = moment().format('YYYY-MM-DD');

  checarExistencia(m);
  setInterval(function() {
    checarExistencia(m);
  }, 1000);

  $('#chamar-senha').click(event => {
    event.preventDefault();
    chamarNovaSenha(m);
  });
  $('#btn-finalizar').click(event => {
    event.preventDefault();
    finalizarAtendimento(m);
  });
  $('#btn-outra').click(event => {
    event.preventDefault();
    chamarOutraSenha(m);
  });
});

function checarExistencia(data) {
  const url =
    'http://localhost/atendimento-senha/requests/verificarAtendimentoPendente.php';
  const obj = { date: data };
  $.post(url, obj, (data, status) => {
    const exists = JSON.parse(data);
    if (exists) {
      $('#chamar-senha').attr('disabled', false);
      $('#btn-outra').attr('disabled', false);
      $('#sem-senhas').addClass('d-none');
    } else {
      $('#chamar-senha').attr('disabled', true);
      $('#btn-outra').attr('disabled', true);
      $('#sem-senhas').removeClass('d-none');
    }
  });
}

function chamarSenha(data) {
  return new Promise((response, error) => {
    const url =
      'http://localhost/atendimento-senha/requests/chamarProximaSenha.php';
    const obj = { date: data };
    $.post(url, obj, (data, status) => {
      if (data !== 'n_senhas') {
        const pw = data;
        response(pw);
      } else {
        error();
      }
    });
  });
}

function finalizarSenha(data, senha) {
  return new Promise(response => {
    const url =
      'http://localhost/atendimento-senha/requests/finalizarAtendimento.php';
    const obj = { date: data, senha: senha };
    $.post(url, obj, (data, status) => {
      response();
    });
  });
}

async function chamarNovaSenha(data) {
  try {
    $('#btn-outra').attr('disabled', true);
    const pw = await chamarSenha(data);

    $('#senha-chamada').text(pw);
    $('#modal-chamar-senha').addClass('d-none');
    $('#modal-senha').removeClass('d-none');
    $('#btn-outra').attr('disabled', false);
  } catch (err) {
    alert('Sem senhas disponíveis');
  }
}

async function chamarOutraSenha(data) {
  try {
    $('#btn-outra').attr('disabled', true);
    // Finalizar atendimento atual
    const senha = Number($('#senha-chamada').text());
    await finalizarSenha(data, senha);
    const pw = await chamarSenha(data);

    $('#senha-chamada').text(pw);
    $('#btn-outra').attr('disabled', false);
  } catch (error) {
    alert('Sem senhas disponíveis');
  }
}

async function finalizarAtendimento(data) {
  // Finalizar atendimento atual

  const senha = Number($('#senha-chamada').text());
  await finalizarSenha(data, senha);
  $('#modal-chamar-senha').removeClass('d-none');
  $('#modal-senha').addClass('d-none');
}
