import axios from 'axios';

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

// URL base da API
const baseURL = 'http://localhost:8000';

const postDados = async (uri, parametros = {}, token = null) => {
  const requestURL = `${baseURL}/${uri}`;

  // Cabeçalhos da requisição
  let headers = {
    'X-Requested-With': 'XMLHttpRequest',
    'Content-Type': 'application/json',
  };

  // Adiciona o token ao cabeçalho se ele for fornecido
  if (token) {
    headers.Authorization = `Bearer ${token}`;
  }

  try {

    // Envia a requisição POST
    const response = await axios.post(requestURL, parametros, { headers });
    console.log(response);
    return response.data;
  } catch (error) {
    if (error.response) {
      return error.response.data;
    } else {
      // Outros erros (por exemplo, problemas de rede)
      return { error: error.message };
    }
  }
}


const getDados = async (uri, parametros = {}, token = null) => {
  const requestURL = `${baseURL}/${uri}`;

  try {
    let headers = {
      'X-Requested-With': 'XMLHttpRequest',
      'Content-Type': 'application/json',
    };

    // Adiciona o token ao cabeçalho se ele for fornecido
    if (token) {
      headers.Authorization = `Bearer ${token}`;
    }

    let response = await axios.get(requestURL, {
      headers: headers,
      params: parametros
    });

    return response.data;
  } catch (error) {
    console.error('Erro na requisição:', error);
    throw error;
  }
}



const deleteDados = async (uri, token) => {
  const requestURL = `${baseURL}/${uri}`;

  // Cabeçalhos da requisição
  let headers = {
    'X-Requested-With': 'XMLHttpRequest',
    'Content-Type': 'application/json',
    'Authorization': `Bearer ${token}`
  };

  try {
    // Envia a requisição DELETE
    const response = await axios.delete(requestURL, { headers });
    console.log(response);
    return response.data; // Retorna apenas os dados da resposta
  } catch (error) {
    // Lida com erros de forma adequada
    if (error.response) {
      // Erros de resposta do servidor
      return error.response.data;
    } else {
      // Outros erros (por exemplo, problemas de rede)
      return { error: error.message };
    }
  }
};





const setCookie = (nomeCookie, value, tempoExpiracaoCookie) => {
  var expires = "";
  var date = new Date();
  /* aqui cria o tempo do cookie*/
  date.setTime(date.getTime() + (tempoExpiracaoCookie * 60 * 1000));
  expires = "; expires=" + date.toUTCString();
  document.cookie = nomeCookie + "=" + (value || "") + expires + "; path=/";
}

const destroyCookie = (nomeCookie) => {
  document.cookie = nomeCookie + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}


// Verifica se o cookie existe 
const cookieExists = (nomeCookie) => {
  let cookie = document.cookie.split(';').some(cookie => cookie.trim().startsWith(nomeCookie + '='));
  return cookie ? true : false;
}


const getCookie = (nomeCookie) => {
  // Separa a string de cookies em uma matriz
  var cookies = document.cookie.split(';');

  // Percorre todos os cookies
  for (var i = 0; i < cookies.length; i++) {
    var cookie = cookies[i].trim();

    // Verifica se o cookie começa com o nome desejado
    if (cookie.startsWith(nomeCookie + '=')) {
      // Retorna o valor do cookie (após o sinal de igual)
      let dados = cookie.substring(nomeCookie.length + 1);
      return dados
      // return JSON.parse(dados)
    }
  }

  return null;
}

const loading = (nome) => {
  Swal.fire({
    html: `<h3 class="text-white">${nome}</h3>`,
    showConfirmButton: false,
    allowOutsideClick: false, // Evita que o modal seja fechado clicando fora dele
    background: '#313a46',
    didOpen: () => {
      Swal.showLoading(); // Mostra o ícone de carregamento
    }
  });
}

const statusAlert = (response) => {
  if (response.status === 'success') {
    return Swal.fire({
      title: "Sucesso",
      text: response.message,
      icon: response.status
    });
  }

  /* Aqui é quando existe multiplos errors */
  if (response.errors) {
    let errorText = '';
    for (const [key, value] of Object.entries(response.errors)) {
      errorText += `${value[0]}\n`; // Adiciona a mensagem de erro ao texto
    }

    return Swal.fire({
      title: "Whoops",
      text: errorText,
      icon: 'error'
    });
  }

  if (response.status === 403) {
    return Swal.fire({
      title: "Whoops",
      text: response.message,
      icon: 'error'
    });
  }

  return Swal.fire({
    title: "Whoops",
    text: response.message,
    icon: response.status
  });

}






export default {
  postDados,
  getDados,
  setCookie,
  destroyCookie,
  cookieExists,
  getCookie,
  deleteDados,
  loading,
  statusAlert
};