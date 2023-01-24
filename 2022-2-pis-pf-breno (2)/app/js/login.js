document.getElementById("entrar").addEventListener("click", async (event) => {
  event.preventDefault();
  entrar();
});

function putUserData(userData) {
  localStorage.setItem('userData', JSON.stringify(data));
}

function getUserData(key, defaultValue = null) {
  let data = localStorage.getItem('userData');
  if (!data) {
    return defaultValue ?? null;
  }

  data = JSON.parse(data);

  if (!(key in data)) {
    return defaultValue ?? null;
  }

  return data[key];
}

async function login(payload) {
  fetch("/pisp3/2022-2-pis-pf-breno/api/login", {
    method: "POST",
    headers: {
      "Accept": "application/json",
      "Content-Type": "application/json"
    },
    body: JSON.stringify(payload),
  })
    .then(async (resposta) => {
      if (resposta.status == 401) {
        document.querySelector("output").innerText = "Não autorizado.";
        return
      }
      if (!resposta.ok) {
        document.querySelector("output").innerText =
          "Falha ao realizar login. " + resposta.status;
        return;
      }

      return resposta.json()
    }).then(data => {
        let userData = {
          token: data.token,
          id: data.usuario.id,
          nome: data.usuario.nome,
          login: data.usuario.login,
      };
      putUserData(userData);

      if (!data.token) {
        return
      }

      location.href = "index.html";
    })
    .catch((e) => {
        document.querySelector("form").reset();
      let output = document.querySelector("output");
      output.innerText = "Erro: " + e.message;
    });
}
async function entrar(event) {
  let formData = new FormData(document.querySelector("form"));
  //   formData.append("login", document.getElementById("login").value);
  //   formData.append("senha", document.getElementById("senha").value);

  if (
    !document.getElementById("senha").value &&
    !document.getElementById("login").value
  ) {
    document.querySelector("output").innerText = "Insira login e senha.";
    return;
  }

  if (!document.getElementById("login").value) {
    document.querySelector("output").innerText = "Insira seu login.";
    return;
  }

  if (!document.getElementById("senha").value) {
    document.querySelector("output").innerText = "Insira sua senha.";
    return;
  }

  let payload  = {
    senha : document.getElementById("senha").value,
    login : document.getElementById("login").value,
  }

  return await login(payload)
}
