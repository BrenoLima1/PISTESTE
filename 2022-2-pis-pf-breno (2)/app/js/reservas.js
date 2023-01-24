document.addEventListener("DOMContentLoaded", listarReservas);
const tbody = document.querySelector("tbody");

async function listarReservas() {
  const resposta = await fetch(
    "http://localhost/pisp3/2022-2-pis-pf-breno/api/reservas",
    {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    }
  )
    .then(async (resposta) => {
      if (resposta.status == 401) {
        location.href =
          "http://localhost/pisp3/2022-2-pis-pf-breno/app/html/login.html";
      }
      if (!resposta.ok) {
        alert("ERRO: " + resposta.status);
        return;
      }
      return await resposta.json();
    })
    .then(async (reserva) => {
      let dados = await reserva;

      let html = "";
      for (const f of dados) {
        html += `
          <tr>
          <td><b>${f.funcionario}</b></td>
          <td><b>${f.cliente}</td>
          <td><b>${f.mesa}</td>
          <td><b>${f.dia}</td>
          <td><b>${f.hora}</td>
          <td><b>${f.situacao}</td>
          <th><button id="deletar"><b>CANCELAR RESERVA</button></th>
          </tr>
          `;
      }
      tbody.innerHTML = html;
    })
    .then(() => {
      for (const botao of document.querySelectorAll("#deletar")) {
        botao.addEventListener("click", () => {
          deletar(event);
        });
      }
    })
    .catch((e) => {
      alert("Falha ao consultar reservas\n" + e.message);
    });
}

async function deletar(event) {
  let tr = event.target.parentElement.parentElement.parentElement;
  if (confirm(`Deseja cancelar esta reserva?`)) {
    // tr.remove();
    // const mesa = tr.children[2].innerText;
    const dia = tr.children[3].innerText;
    const hora = tr.children[4].innerText;


    await fetch("http://localhost/pisp3/2022-2-pis-pf-breno/api/reserva",
      {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ dia, hora }),
      }
    )
      .then(async (resposta) => {
        if (!resposta.ok) {
          alert("ERRO ao cancelar reserva: " + resposta.status);
          return;
        }

        alert('Reserva cancelada com sucesso!');
      })
      .catch((e) => {
        alert("ERRO ao cancelar reserva: " + e.message);
        return;
      });
  }
}
